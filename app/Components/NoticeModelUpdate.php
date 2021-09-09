<?php

namespace App\Components;

use App\Events\NoticesParsed;
use App\Models\Notice;
use Illuminate\Support\Facades\Log;

class NoticeModelUpdate
{
    public function __invoke(FeedContentParser $feedContent)
    {
        //удаляем все модели из бд
        Notice::truncate();
        //получаем данные из ресурса
        $notices = $feedContent->getNotices();
        //записываем данные в бд
        foreach ($notices as $notice) {
            $model = new Notice();
            $model->create([
                'title'=> $notice['title'],
                'link'=>$notice['link']
               ]);
        }
        NoticesParsed::dispatch($notices);
    }

}
