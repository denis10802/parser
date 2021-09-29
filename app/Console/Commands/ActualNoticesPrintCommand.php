<?php

namespace App\Console\Commands;

use App\Components\ParseNoticeDTO;
use App\Components\Services\FeedReadBashinform;
use App\Contracts\IFeedRead;
use Illuminate\Console\Command;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ActualNoticesPrintCommand extends Command
{

    protected $signature = 'notices:read';

    protected $description = 'Get data from bashInform';

    /**
     * @throws ExceptionInterface
     */
    public function handle(IFeedRead $read)
    {
        $normalizers = [new ObjectNormalizer()];

        /** * @var ParseNoticeDTO[] * */
        $DTO_notices = $read->read();

        $serializer = new Serializer($normalizers, $DTO_notices);
        $notices = $serializer->normalize($DTO_notices);

        $this->table(
            ['Title', 'Link'],
            $notices
        );
    }

}
