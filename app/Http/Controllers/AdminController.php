<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\User;
use Hash;

class AdminController extends UserController
{
    public function CreateNewUser(AdminRequest $adminRequest) {
        $adminRequest->validated();
            $user = new User();
            $path = null;
            if ($adminRequest->hasFile('photo_file')) {
                $photo_file = $adminRequest->file("photo_file");
                $path = "/storage/" . $photo_file->store("photo_file", 'public');
            }

            $result = $user->create([
                "name" => $adminRequest->name,
                "surname" => $adminRequest->surname,
                "patronymic" => $adminRequest->patronymic,
                'login' => $adminRequest->login,
                'password' => Hash::make($adminRequest->password),
                'photo_file' => $path,
                'role_id' => $adminRequest->role_id
            ]);


            return $this->data([
                "id" => $result->id,
                "status" => "created"
            ]);
    }

}
