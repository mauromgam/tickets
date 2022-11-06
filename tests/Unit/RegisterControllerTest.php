<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\RegisterController;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    public function test_CreateUser()
    {
        $controller = app(RegisterController::class);
        $user       = $controller->create([
            'name'     => 'Test',
            'email'    => 'test@123.com',
            'password' => '123321',
        ]);

        $this->assertEquals('User', class_basename($user));
    }
}
