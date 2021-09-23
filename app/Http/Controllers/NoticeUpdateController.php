<?php

namespace App\Http\Controllers;

use App\Components\FeedReadComponent;
use App\Components\NoticeRefreshComponent;
use Illuminate\Http\Request;

class NoticeUpdateController extends Controller
{
    public function update(FeedReadComponent $reader, NoticeRefreshComponent $refresher)
    {
        $notices = $reader->read();
        $refresher->refresh($notices);

       return redirect('/');
    }
}
