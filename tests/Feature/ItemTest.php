<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Database\Seeders\DatabaseSeeder;

use App\Models\User;
use App\Enums\Item as ItemEnum;


class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = DatabaseSeeder::class;

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
            ->postJson('/api/pw-storage/' . ItemEnum::Group->value, ['name' => 'Group-1']);

        // $response->dumpHeaders();
        // $response->dumpSession();
        // $response->dump();

        // dump($response);

        $response->assertStatus(201);
    }
}
