<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Resources\UserCollection;
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
        'password.min' => "Пароль должен быть минимум 8 символов",
        'password.confirmed' => "Пароли должны совпадать"
    ];





}