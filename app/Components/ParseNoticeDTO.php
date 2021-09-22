<?php

namespace App\Components;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

final class ParseNoticeDTO implements DecoderInterface
{
    public string $title;
    public string $link;

    public function __construct(string $title, string $link)
    {
        $this->title = $title;
        $this->link = $link;
    }

    public function decode(string $data, string $format, array $context = [])
    {
        // TODO: Implement decode() method.
    }



    public function supportsDecoding(string $format)
    {
        // TODO: Implement supportsDecoding() method.
    }
}
