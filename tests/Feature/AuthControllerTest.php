<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * Should return 401 status and error message when credential is invalid.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        $response = $this->post('/api/login', [
            'email' => 'anyrandom@email.com',
            'password' => 'password'
        ]);
        $response->assertStatus(401)->assertJson([
            'message' => 'Email & Password does not match with our record.'
        ]);
    }

    /**
     * Should return 422 for incomplete input
     *
     * @return void
     */
    public function testShouldReturn422()
    {
        $response = $this->post('/api/login', [
            'password' => 'password'
        ]);
        $response->assertStatus(422);
    }

    public function testLoginSuccessful()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(201)->assertJSON([
            'email' => true,
            'name' => true,
            'id' => true
        ]);
    }
}
