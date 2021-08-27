<?php

namespace App\Console\Commands;

use App\Components\ParseDataClient;
use Illuminate\Console\Command;

class ImportParseDataCommand extends Command
{

    protected $signature = 'import:feednotice';

    protected $description = 'Get data from bashInform';

    public function handle(ParseDataClient $parseContent)
    {
        dd($parseContent->parseData());
    }

}
