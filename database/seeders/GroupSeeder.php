<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Group;


class GroupSeeder extends Seeder
{
    const GROUP_1_ID = 2;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::firstOrCreate(
          ['id' => 1],
          ['name' => 'root_group']
        );

        Group::firstOrCreate(
          ['id' => self::GROUP_1_ID],
          ['name' => 'Test-group-1']
        );
    }
}
