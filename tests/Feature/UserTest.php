<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

final class UserTest extends TestCase
{
    /**
     * @test
     */
    public function redirectUserOnAuthTest()
    {
        $response = $this->get('/');
        $response->assertStatus(302)->assertRedirect('login');
    }

    public function authUserTest()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }
}
