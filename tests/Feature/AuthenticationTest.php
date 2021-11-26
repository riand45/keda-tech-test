<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JWTAuth;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    /**
    * Login as default API user and get token back.
    *
    * @return void
    */
    public function testLogin()
    {
        $email = 'customer@gmail.com';
        $password = 'dummydummy';
        $response = $this->postJson('/api/v1/login', [
            'email' => $email,
            'password' => $password
        ]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status', 'code', 'data'
            ]);
    }

    /**
    * Test logout.
    *
    * @return void
    */
    public function testLogout()
    {
        $user = User::where('email', 'customer@gmail.com')->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson('/api/v1/logout?token=' . $token, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'code' => 200,
                'status' => 'success',
                'data' => [
                    'message' => 'Logout Successfully'
                ]
            ]);
    }
}
