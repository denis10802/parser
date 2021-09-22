<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;

class GetApiResponsesController extends Controller
{
    public function get_title()
    {
        return NoticeResource::collection(Notice::query('title')->get());
    }
}
