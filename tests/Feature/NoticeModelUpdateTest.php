<?php

namespace Tests\Feature;

use App\Components\FeedContentParser;
use App\Components\NoticeModelUpdate;
use App\Models\Notice;
use Tests\TestCase;

class NoticeModelUpdateTest extends TestCase
{
    private array $arrayToEntry;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->arrayToEntry = [
            [
                "title" => "Радий Хабиров параолимпийцам",
                "link" => "https://www.bashinform.ru/news/1645589-vsekh/"
            ],
            [
                "title" => "ВТБ и ДОМ.РФ запускают первую",
                "link" => "https://www.bashinform.ru/news/1645581-ipoteku/"
            ]
        ];
    }

    public function test_old_notices_faded()
    {
        Notice::factory()->create($this->arrayToEntry[0]);
        $instance = new NoticeModelUpdate();
        $mock = $this->createMock(FeedContentParser::class);
        $instance($mock);
        $newNotice = Notice::all()->count();
        $this->assertSame(0, $newNotice);
    }

    public function test_new_notices_added()
    {
        $inst = new NoticeModelUpdate();
        $mock = $this->createMock(FeedContentParser::class);
        $mock->expects($this->exactly(1))->method('getNotices')->willReturn($this->arrayToEntry);
        $inst($mock);
        $noticeExists = Notice::query()->where('title','Радий Хабиров параолимпийцам')->exists();
        $getNewNotice= Notice::query()->first('title');
        $this->assertTrue($noticeExists);
        $this->assertSame($getNewNotice->title, $this->arrayToEntry[0]['title']);
    }
}
