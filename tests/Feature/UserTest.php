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
    public function redirectUserOnAuth()
    {
        $response = $this->get('/');
        $response->assertStatus(302)->assertRedirect('login');
    }

    /**
     * @test
     */
    public function authUserTest()
    {
        //arrange
        Notice::factory()->create([
            'title'=>'делать утверждения в отношении определенной части данных',
            'link'=>'https//hhhgnhi.kkjghg.kkkkk'
        ]);
        $user = User::factory()->create();
        //act
        $response = $this->actingAs($user)->get('/');
        //assert
        $response->assertStatus(200);
        $response->assertSeeText('делать утверждения');
    }
}
