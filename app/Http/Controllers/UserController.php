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


    protected $message = [
        'unique' => 'Такой логин уже существует!',
        // 'string' => "Поле :attribute должно быть строкой",
        'password.min' => "Пароль должен быть минимум 8 символов",
        'password.confirmed' => "Пароли должны совпадать"
    ];





}