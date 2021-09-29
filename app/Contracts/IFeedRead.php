<?php

namespace App\Contracts;

use App\Components\ParseNoticeDTO;


interface IFeedRead
{
    /**
     * @return ParseNoticeDTO[]
     */
    public function read(): array;
}
