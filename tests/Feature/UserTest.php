<?php

namespace Tests\Feature;

use App\Models\Notice;
use App\Models\User;
use Tests\TestCase;

final class UserTest extends TestCase
{
    /**
     * @test
     */
    public function test_redirect_user_on_auth()
    {
        $response = $this->get('/');
        $response->assertStatus(302)->assertRedirect('login');
    }

    /**
     * @test
     */
    public function test_auth_user()
    {
        // Arrange
        $title = 'делать утверждения в отношении определенной части данных';
        Notice::factory()->create(['title'=>$title]);
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertSeeText($title);
    }
}
