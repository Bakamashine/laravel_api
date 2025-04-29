<?php

namespace App;
use App\Models\User;
trait UserTrait
{
    /**
     * Получение всех пользователей с их ролями
     * @return User
     */
    function all()
    {
        return User::select()
            ->leftJoin("role", "users.role_id", '=', "role.id");
    }
}
