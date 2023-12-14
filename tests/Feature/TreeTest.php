<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Models\User;


class TreeTest extends TestCase
{
    // use WithoutMiddleware;

    /**
     *  @test
     */
    public function it_gets_tree_for_auth_user(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
            ->getJson('/api/pw-storage/tree');

        // $response->dumpHeaders();
        // $response->dump();

        $response->assertStatus(200);
    }
}
