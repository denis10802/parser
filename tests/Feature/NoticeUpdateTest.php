<?php

namespace Tests\Feature;

use App\Components\FeedReadComponent;
use App\Components\NoticeRefreshComponent;
use App\Components\ParseNoticeDTO;
use App\Http\Controllers\NoticeUpdateController;
use App\Http\Controllers\RefreshNoticesCommand;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoticeUpdateTest extends TestCase
{
    public function test_if_admin_button_is_visible()
    {
        // Arrange
        $admin = User::factory()->admin()->make();

        // Act
        $response = $this->actingAs($admin);

        //Assert
        $response->get('/')->assertSeeText('Обновить');
    }

    public function test_if_admin_access_by_route_is_allowed()
    {
        // Arrange
        $admin = User::factory()->admin()->make();
        Notice::factory()->create(['title'=>'old notice']);
        $this->actingAs($admin)
            ->get('/')
            ->assertSee('old notice');
        $mock = $this->createMock(FeedReadComponent::class);
        $mock->expects(self::exactly(1))
            ->method('read')
            ->willReturn([new ParseNoticeDTO('new notice','htpps//www.ddw.ww')]);
        $instance = new NoticeUpdateController();
        $refresh = new NoticeRefreshComponent();

        // Act
        $response = $this->post('/update')->assertRedirect('/');
        $instance->update($mock, $refresh);

        // Assert
        $response = $this->followRedirects($response)->assertOk();
        $response->assertSee('new notice');
        $response->assertDontSee('old notice');
    }

    public function test_if_moderator_button_is_hidden_and_not_access_by_route()
    {
        // Arrange
        $moderator = User::factory()->moderator()->make();

        // Act
        $response = $this->actingAs($moderator);

        // Assert
        $response->post('/update')->assertForbidden();
        $response->get('/')->assertDontSee('Обновить');
    }
}
