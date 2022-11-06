<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_AccessHomepage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertSuccessful();
    }
}
