<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'alamat' => ['required','string'],
            'no_hp' => ['required','string','max:20'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'alamat' =>$input['alamat'],
                'no_hp' =>$input['no_hp'],
                'password' => Hash::make($input['password']),
                'role' => 'peminjam',
                ]);
    }
}
