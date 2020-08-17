<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponsePackage;
use App\Http\Requests\CreateUserRequest;
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
                'phone_number' => 'string',
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
}
