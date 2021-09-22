<?php

namespace App\Http\Controllers;

use App\Components\FeedReadComponent;
use App\Components\NoticeRefreshComponent;
use App\Events\NoticesParsed;
use Illuminate\Http\Request;

class RefreshNoticesCommand
{
    public function __invoke(FeedReadComponent $read, NoticeRefreshComponent $refresh)
    {
        /** @void ParseNoticeDTO[] */
        $notices = $read->read();
        $refresh->refresh($notices);
        NoticesParsed::dispatch($notices);
    }
}
