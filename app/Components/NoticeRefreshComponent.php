<?php

namespace App\Components;

use App\Models\Notice;

final class NoticeRefreshComponent
{
    public function refresh($notices)
    {
        Notice::truncate();

        foreach ($notices as $notice) {
            $modelUpdate = new Notice();
            $modelUpdate->title = $notice->title;
            $modelUpdate->link = $notice->link;
            $modelUpdate->save();
        }
    }
}
