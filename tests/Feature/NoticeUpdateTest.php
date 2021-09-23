<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoticeUpdateTest extends TestCase
{
    public function test_if_user_is_not_admin_no_button()
    {
        //arrange
        $user = User::factory()->create(['roles'=>'user']);
        //act
        $response = $this->actingAs($user)->get('/');
        //assert
        $response->assertDontSeeText('Обновить');
    }
}
