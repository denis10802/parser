<?php

namespace App\Console\Commands;

use App\Components\FeedContentParser;
use Illuminate\Console\Command;

class ShowTableNotices extends Command
{

    protected $signature = 'gettable:feednotice';

    protected $description = 'Get data from bashInform';

    public function handle(FeedContentParser $content)
    {
        $this->table(
            ['Title', 'Link'],
            $content->getNotices()
        );
    }

}
