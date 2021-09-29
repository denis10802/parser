<?php

namespace App\Http\Controllers;

use App\Components\Services\FeedReadBashinform;
use App\Components\NoticeRefreshComponent;
use App\Contracts\IFeedRead;
use App\Events\NoticesParsed;
use Illuminate\Http\Request;

class RefreshNoticesCommand
{
    public function __invoke(IFeedRead $read, NoticeRefreshComponent $refresh)
    {
        /** @void ParseNoticeDTO[] */
        $notices = $read->read();
        $refresh->refresh($notices);
        NoticesParsed::dispatch($notices);
    }
}
