<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    public function test_UserCannotViewALoginFormWhenAuthenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    /**
     * @return void
     */
    public function test_ShowLoginPage()
    {
        $response = $this->get('/login');

        $response->assertViewIs('auth.login');
        $this->assertStringContainsString(' Login', $response->content());
        $this->assertStringContainsString(
            '<form method="POST" action="http://localhost/login">',
            $response->content()
        );
    }

    /**
     * @return void
     */
    public function test_ShowConfirmPasswordPage()
    {
        $response = $this->get('password/confirm');

        $response->assertRedirectContains('localhost');
        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_ShowRegisterPage()
    {
        $response = $this->get('/register');

        $this->assertStringContainsString('<div class="card-header"> Register</div>', $response->content());
        $this->assertStringContainsString(
            '<form method="POST" action="http://localhost/register">',
            $response->content()
        );
    }
}
