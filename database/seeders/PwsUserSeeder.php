<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;


class PwsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
          ['name' => 'pws-admin-1'],
          ['email' => 'pws-admin-1@mail.ru', 'is_admin' => 1, 'password' => Hash::make('123')]
        );

        User::firstOrCreate(
          ['name' => 'pws-admin-2'],
          ['email' => 'pws-admin-2@mail.ru', 'is_admin' => 1, 'password' => Hash::make('123')]
        );

        User::firstOrCreate(
          ['name' => 'pws-user-1'],
          ['email' => 'pws-user-1@mail.ru', 'is_admin' => 0, 'password' => Hash::make('123')]
        );

        User::firstOrCreate(
          ['name' => 'pws-user-2'],
          ['email' => 'pws-user-2@mail.ru', 'is_admin' => 0, 'password' => Hash::make('123')]
        );
    }
}
