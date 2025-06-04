<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Administrator',
            'email' => 'admin@castorsoft.localhost',
            'email_verified_at' => new DateTime(),
            'password' => Hash::make('yametekudasai'),
        ]);

        UserRole::insert([
            'user_id' => User::first()->id,
            'role' => 'admin'
        ]);

        Artisan::call('passport:client --password -q');
    }
}
