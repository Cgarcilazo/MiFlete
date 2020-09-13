<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponsePackage;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseApi
{
    /**
     * Register one user
     *
     * @param  CreateUserRequest $request
     *
     * @return JsonResponse
     */
    public function register(CreateUserRequest $request)
    {
        $package = new ResponsePackage();

        DB::beginTransaction();

        try {
            $isClient = filter_var($request->is_client, FILTER_VALIDATE_BOOLEAN);
            $type = $isClient ? User::$types['client'] : User::$types['carrier'];

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $type,
                'phone_number' => $request->phone_number ?: null,
            ]);

            $claims = [
                'user_id' => $user->id,
            ];

            $token = auth('api')->claims($claims)->fromUser($user);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $package->setError('Hubo un problema creando el usuario, contacte un administrador', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        DB::commit();

        return $package->setMessage('Usuario Creado')
            ->setData('user', $user)
            ->setData('token', $token)
            ->toResponse();
    }

    /**
     * Login the user
     *
     * @param  LoginUserRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        $package = new ResponsePackage();

        $credentials = $request->only('email', 'password');

        $user = User::findByEmail($credentials['email']);

        if (empty($user)) {
            return $package->setError('El email no está registrado', BaseApi::HTTP_NOT_FOUND)
                ->toResponse();
        }

        $claims = [
            'user_id' => $user->id
        ];
        $token = auth('api')->claims($claims)->attempt($credentials);
        if (empty($token)) {
            return $package->setError('Credenciales inválidas', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        return $package->setMessage('Autenticación exitosa')
            ->setData('user', $user)
            ->setData('token', $token)
            ->toResponse();
    }

    /**
     * Refresh the token for the given user
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        $package = new ResponsePackage();

        try {
            $token = auth('api')->refresh();
        } catch (\Exception $e) {
            return $package->setError('No es posible refrescar el token')
                ->toResponse();
        }

        return $package->setMessage('Nuevo token generado')
            ->setData('token', $token)
            ->toResponse();
    }

    /**
     * Get the logged user from the token
     *
     * @return JsonResponse
     */
    public function getUser()
    {
        $package = new ResponsePackage();

        $user = $this->user();

        return $package
            ->setData('user', $user)
            ->toResponse();
    }
}
