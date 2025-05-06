<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Exception;
use App\Http\Controllers\UserController;
use App\Models\User;


class RegisterController extends UserController
{
    /**
     * Регистрация посредством API
     * @param RegisterRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $request->validated();
        $user = User::create([
            "name" => $request->name,
            'login' => $request->login,
            "password" => bcrypt($request->password),
            "role_id" => 3
        ]);

        try {
            return $this->isSuccess([
                'user' => $user,
                'token' => $user->createToken("user_token", json_decode($user->role->abilities))->plainTextToken
            ]);
        } catch (Exception $exception) {
            $user->delete();
            return $this->Error($exception->getMessage());
        }
    }
}
