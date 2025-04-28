<?php

namespace App\Http\Controllers;

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
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            Validator::make($request->all(), $this->rules, $this->message)->validate();
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
                'login' => $request->login,
                'photo_file' => $request->photo_file,
                'role_id' => $request->role_id,
                'status' => $request->status,
                'password' => Hash::make($request->password),
            ]);
            return $this->isSuccess(['user' => $user, 'token' => $user->createToken("user_token")->plainTextToken]);
        } catch (ValidationException $e) {
            return $this->ValidateError($e->validator->errors()->all());
        }
    }
}
