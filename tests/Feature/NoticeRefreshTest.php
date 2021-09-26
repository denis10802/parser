<?php

namespace Tests\Feature;

use App\Components\NoticeRefreshComponent;
use App\Components\ParseNoticeDTO;
use App\Models\Notice;
use Tests\TestCase;


class NoticeRefreshTest extends TestCase
{

    private array $notices;

    protected function setUp(): void
    {
        parent::setUp();

        $this->notices =
            [
            new ParseNoticeDTO('Радий Хабиров параолимпийцам', 'https://www.bashinform.ru/news/1645589-vsekh/'),
            new ParseNoticeDTO('Скорее, это непрерывный процесс','https//www.dllkjkjf.common')
        ];

    }

    public function test_old_notices_deleted_and_new_notices_added()
    {
        // Arrange
        Notice::factory()->create(['title'=>'lorem Ipsum на латинице']);
        $newNotice = $this->notices;
        $oldNotice = Notice::query()->where('title','lorem Ipsum на латинице')->get();
        $this->assertCount(1, $oldNotice);

        // Act
        $instance = new NoticeRefreshComponent();
        $instance->refresh($newNotice);

        // Assert
        $oldNotice = Notice::query()->where('title','lorem Ipsum на латинице')->get();
        $newNotice_1 = Notice::query()->where('title','Радий Хабиров параолимпийцам')->get();
        $newNotice_2 = Notice::query()->where('title','Скорее, это непрерывный процесс')->get();
        $this->assertCount(0, $oldNotice);
        $this->assertCount(1, $newNotice_1);
        $this->assertCount(1, $newNotice_2);
    }
}
