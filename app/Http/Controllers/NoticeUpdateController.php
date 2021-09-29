<?php

namespace App\Http\Controllers;

use App\Components\Services\FeedReadBashinform;
use App\Components\NoticeRefreshComponent;
use App\Contracts\IFeedRead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NoticeUpdateController extends Controller
{

    public function update(IFeedRead $reader, NoticeRefreshComponent $refresher): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if (!Gate::allows('can_parse_notices')){
            abort(403);
        }
        $notices = $reader->read();
        $refresher->refresh($notices);

       return redirect('/');
    }
}
