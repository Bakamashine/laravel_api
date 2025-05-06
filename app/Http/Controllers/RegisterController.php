<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\UserController;
use App\Models\User;
use Hash;
use Illuminate\Validation\ValidationException;


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
        // $user = User::create([
        //     'name' => $request->name,
        //     'surname' => $request->surname,
        //     'patronymic' => $request->patronymic,
        //     'login' => $request->login,
        //     'photo_file' => $request->photo_file,
        //     'role_id' => $request->role_id,
        //     'status' => $request->status,
        //     'password' => Hash::make($request->password),
        // ]);

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
