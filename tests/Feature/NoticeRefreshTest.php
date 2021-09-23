<?php

namespace Tests\Feature;

use App\Components\NoticeRefreshComponent;
use App\Components\ParseNoticeDTO;
use App\Models\Notice;
use Tests\TestCase;


class NoticeRefreshTest extends TestCase
{
    private array $arrayToEntry;
    private object $notices;

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

        foreach ($this->arrayToEntry as $notice){
            $this->notices = new ParseNoticeDTO($notice['title'],$notice['link']);
        }
    }

    public function test_old_notices_deleted_and_new_notices_added()
    {
        //arrange
        Notice::factory()->create($this->arrayToEntry[0]);
        $oldNotice = Notice::all()->toArray();
        $notices[] = $this->notices;
        //act
        $instance = new NoticeRefreshComponent();
        $instance->refresh($notices);
        $newNotice = Notice::all()->toArray();
        //assert
        $this->assertNotSame($oldNotice, $newNotice);
    }
}
