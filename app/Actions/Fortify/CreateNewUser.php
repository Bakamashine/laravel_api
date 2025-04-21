<?php

namespace App\Actions\Fortify;

use App\ApiHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    use ApiHelper;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'login' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();


        $user =  User::create([
            'name' => $input['name'],
            'login' => $input['login'],
            'password' => Hash::make($input['password']),
        ]);
        return $user;

        // return $this->isSuccess(['user' => $user, 'token' => $user->createToken("user_token")->plainTextToken]);
    }
}
