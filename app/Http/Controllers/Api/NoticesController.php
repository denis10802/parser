<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function showTitle()
    {
        $notices = Notice::all();

        $titles = $notices->map (function ($dataDB) {
            return $dataDB['title'];
        });

        return response()->json($titles);
    }
}
