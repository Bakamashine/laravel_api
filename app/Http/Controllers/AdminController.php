<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Hash;

class AdminController extends UserController
{
    #[\Override]
    protected $rules = [
        "name" => 'required',
        'login' => 'required|unique:users,login',
        'password' => 'required|string|min:8',
        'surname' => 'string|min:5',
        'patronymic' => "string|min:5",
        'photo_file' => "image|mimetypes:image/jpeg,image/png",
        "role_id" => "required|numeric"
    ];


    public function CreateNewUser(Request $request)
    {

        try {
            Validator::make($request->all(), $this->rules, $this->message)->validate();

            $user = new User();
            $path = null;
            if ($request->hasFile('photo_file')) {
                $photo_file = $request->file("photo_file");
                $path = "/storage/" . $photo_file->store("photo_file", 'public');
            }

            $result = $user->create([
                "name" => $request->name,
                "surname" => $request->surname,
                "patronymic" => $request->patronymic,
                'login' => $request->login,
                'password' => Hash::make($request->password),
                'photo_file' => $path,
                'role_id' => $request->role_id
            ]);


            return $this->data([
                "id" => $result->id,
                "status" => "created"
            ]);
        } catch (ValidationException $e) {
            return $this->ValidateError($e->validator->errors()->all());
        }
    }

}
