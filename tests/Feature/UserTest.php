<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;


class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = DatabaseSeeder::class;

    /**
     *  test
     */
    public function create_user(): void
    {
        // Run the DatabaseSeeder...
        // $this->seed();

        $user = User::factory()->create();

        // dd(User::get());
        dd(DB::select('select * from users'));

        $this->assertDatabaseCount('users', 1);
    }
}
