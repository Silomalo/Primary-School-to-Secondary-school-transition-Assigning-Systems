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
            'name' => ['required', 'string', 'max:255'],
            'birthCertID' => ['required', 'string', 'max:255'],
            'indexStaffNo' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'primarySchoolID' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'religion' => ['required', 'string', 'max:255'],
            'disabled' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'birthCertID' => $input['birthCertID'],
            'indexStaffNo' => $input['indexStaffNo'],
            'role' => $input['role'],
            'primarySchoolID' => $input['primarySchoolID'],
            'gender' => $input['gender'],
            'dob' => $input['dob'],
            'religion' => $input['religion'],
            'disabled' => $input['disabled'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
