<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(3),
            'birthCertID' => Str::random(3),
            'indexStaffNo' => Str::random(3),
            'role' => '3',
            'primarySchoolID' => Str::random(3),
            'gender' => Str::random(3),
            'dob' => Str::random(3),
            'religion' => Str::random(3),
            'disabled' => Str::random(3),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
