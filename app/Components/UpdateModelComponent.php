<?php

namespace App\Components;

use App\Models\Notice;

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
    }

}
