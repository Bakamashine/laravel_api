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
class UserController extends Controller
{
    use \App\UserTrait;
    use \App\ApiHelper;
    
    /**
     * Вывод всех пользователей
     * @return UserCollection
     */
    public function show()
    {
        return new UserCollection(Cache::remember("users", 60 * 60 * 24, function () {
            return $this->all()->get();
        }));
    }

    /**
     * Вывод одного пользователя по id
     * @param int $id
     * @return UserCollection
     */
    public function detail($id)
    {
        $users = $this->all()->where('users.id', '=', $id)->get();
        return new UserCollection($users);
    }

    
    protected $rules = [
            "name" => 'required',
            'login' => 'required|unique:users,login',
            'password' => 'required|string|min:8|confirmed'
    ];

    
    protected  $message = [
            'unique' => 'Такой логин уже существует!',
            // 'string' => "Поле :attribute должно быть строкой",
            'password.min' => "Пароль должен быть минимум 8 символов",
            'password.confirmed' => "Пароли должны совпадать"
    ];

    /**
     * Регистрация посредством API
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
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



    /**
     * Авторизация посредством API
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
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

    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $user->currentAccessToken()->delete();
            }
        } catch (\Exception $e) {
            return $this->codeAndMessage($e->getMessage(), 500);
        }
    }
}