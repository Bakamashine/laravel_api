<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserCollection;
use Illuminate\Validation\ValidationException;

class AuthController extends UserController
{
    
    /**
     * Авторизация посредством API
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request) {
        try {
            $user = User::where('login', $request->login)->first();
            if (!$user || !Hash::make($request->password) == $user->password) {
                throw ValidationException::withMessages(['login' => 'Такого пользователя не существует']);
            }
                return $this->isSuccess(['user' => $user, 'token' => $user->createToken("user_token")->plainTextToken]);
        } catch (ValidationException $e) {
            return $this->ValidateError($e->validator->errors()->all());
        }
    }

//     public function logout(Request $request)
//     {
//         try {
//             $user = Auth::user();
//             if ($user) {
//                 $user->currentAccessToken()->delete();
//             }
//         } catch (\Exception $e) {
//             return $this->codeAndMessage($e->getMessage(), 500);
//         }
//     }

}