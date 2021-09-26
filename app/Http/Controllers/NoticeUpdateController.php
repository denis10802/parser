<?php

namespace App\Http\Controllers;

use App\Components\FeedReadComponent;
use App\Components\NoticeRefreshComponent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoticeUpdateController extends Controller
{
    public function update(FeedReadComponent $reader, NoticeRefreshComponent $refresher)
    {
        if (!Gate::allows('can_parse_notices')){
            abort(403);
        }
        $notices = $reader->read();
        $refresher->refresh($notices);

       return redirect('/');
    }
}
