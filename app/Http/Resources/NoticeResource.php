<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class NoticeResource extends JsonResource
{

    public function toArray($request)
    {
        return ['title' => $this->title];
    }
}
