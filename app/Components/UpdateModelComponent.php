<?php

namespace App\Components;

use App\Events\EventParseProcessing;
use App\Models\Notice;
use Illuminate\Support\Facades\Log;

class UpdateModelComponent
{
    public function __invoke(ParseDataClient $parseContent)
    {
        //удаляем все модели из бд
        Notice::truncate();
        //получаем данные из ресурса
        $parseData = $parseContent->parseData();
        //записываем данные в бд
        $notice = new Notice();
        foreach ($parseData as $datum) {
            $notice->create([
                'title'=> $datum['title'],
                'link'=>$datum['link']
               ]);
        }
        EventParseProcessing::dispatch($parseData);
    }

}
