<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'extension' => ['nullable', 'string', 'max:255'],
            'dob' => ['required', 'date', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            // 'password' => Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        
        ])->validate();

        return User::create([
            // 'name' => $input['name'],
            // 'email' => $input['email'],
            // 'password' => Hash::make($input['password']),
            'name' => $input['name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'extension' => $input['extension'],
            'dob' => $input['dob'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
