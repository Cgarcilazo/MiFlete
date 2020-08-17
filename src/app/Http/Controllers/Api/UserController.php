<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponsePackage;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseApi
{
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
            return $package->setError('There was a problem creating the user, contact one administrator', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        DB::commit();

        return $package->setMessage('User Created')
            ->setData('user', $user)
            ->setData('token', $token)
            ->toResponse();
    }

    public function login(LoginUserRequest $request)
    {
        $package = new ResponsePackage();

        $credentials = $request->only('email', 'password');

        $user = User::findByEmail($credentials['email']);

        if (empty($user)) {
            return $package->setError('The email is not registered', BaseApi::HTTP_NOT_FOUND)
                ->toResponse();
        }

        $claims = [
            'user_id' => $user->id
        ];
        $token = auth('api')->claims($claims)->attempt($credentials);
        if (empty($token)) {
            return $package->setError('Invalid Credentials', BaseApi::HTTP_CONFLICT)
                ->toResponse();
        }

        return $package->setMessage('Auth Success')
            ->setData('user', $user)
            ->setData('token', $token)
            ->toResponse();
    }
}
