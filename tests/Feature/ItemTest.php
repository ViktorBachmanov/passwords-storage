<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GroupSeeder;

use App\Models\User;
use App\Enums\Item as ItemEnum;


class ItemTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    // protected $seeder = DatabaseSeeder::class;

    /**
     *  @test
     */
    public function it_does_not_create_a_group_without_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/pw-storage/' . ItemEnum::Group->value);

        // $response->dumpHeaders();
        // $response->dumpSession();
        // $response->dump();

        // dump('APP_DEBUG: ', env('APP_DEBUG'));

        // dump($response);

        $response->assertStatus(422);
    }

    /**
     *  @test
     */
    public function it_does_not_create_a_group_with_existing_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/pw-storage/' . ItemEnum::Group->value, ['name' => 'root_group']);

        // $response->dumpHeaders();
        // $response->dumpSession();
        // $response->dump();

        // dump('APP_DEBUG: ', env('APP_DEBUG'));

        // dump($response);

        $response->assertStatus(409);
    }

    /**
     *  @test
     */
    public function it_creates_a_group(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/pw-storage/' . ItemEnum::Group->value, ['name' => fake()->name()]);

        // $response->dumpHeaders();
        // $response->dumpSession();
        // $response->dump();

        // dump($response);

        $response->assertStatus(201);
    }

    /**
     *  @test
     */
    public function it_toggles_access_to_group(): void
    {
        $admin = User::firstWhere('email', UserSeeder::ADMIN_1_EMAIL);
        $user = User::firstWhere('email', UserSeeder::USER_1_EMAIL);

        $response = $this->actingAs($admin)
            ->patchJson(
                '/api/pw-storage/' . ItemEnum::Group->value . '/' . GroupSeeder::GROUP_1_ID, 
                [
                    'userId' => $user->id,
                    'currentAccess' => 0
                ]
            );

        // $response->dumpHeaders();
        // $response->dumpSession();
        // $response->dump();

        // dump($response);

        $response->assertStatus(200);
    }
}
