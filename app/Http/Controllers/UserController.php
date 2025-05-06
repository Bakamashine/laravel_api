<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    use \App\ApiHelper;

    /**
     * Вывод всех пользователей
     * @return UserCollection
     */
    public function show()
    {
        return new UserCollection(Cache::remember("users", 60 * 60 * 24, function () {
            return User::all();
        }));
    }

    /**
     * Вывод одного пользователя по id
     * @param int $user
     * @return UserResource
     */
    public function detail(User $user)
    {
        return new UserResource($user);
    }
}