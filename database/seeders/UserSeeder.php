<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserSeeder extends Seeder
{
    const ADMIN_1_EMAIL = 'admin-1@mail.ru';
    const ADMIN_1_PASSWORD = '123';

    const USER_1_EMAIL = 'user-1@mail.ru';
    const USER_1_PASSWORD = '123';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
          ['name' => 'admin-1'],
          ['email' => self::ADMIN_1_EMAIL, 'is_admin' => 1, 'password' => Hash::make(self::ADMIN_1_PASSWORD)]
        );

        User::firstOrCreate(
          ['name' => 'admin-2'],
          ['email' => 'admin-2@mail.ru', 'is_admin' => 1, 'password' => Hash::make('123')]
        );

        User::firstOrCreate(
          ['name' => 'user-1'],
          ['email' => self::USER_1_EMAIL, 'is_admin' => 0, 'password' => Hash::make(self::USER_1_PASSWORD)]
        );

        User::firstOrCreate(
          ['name' => 'user-2'],
          ['email' => 'user-2@mail.ru', 'is_admin' => 0, 'password' => Hash::make('123')]
        );

        User::firstOrCreate(
          ['name' => 'user-3'],
          ['email' => 'user-3@mail.ru', 'is_admin' => 0, 'password' => Hash::make('123')]
        );
    }
}
