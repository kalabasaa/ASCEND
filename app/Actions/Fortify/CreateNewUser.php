<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'password' => $this->passwordRules(),
            'g-recaptcha-response' => ['required', new Recaptcha],
        ], [
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA challenge.',
        ])->validate();

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'] ?? null,
            'password' => $input['password'],
        ]);
    }
}