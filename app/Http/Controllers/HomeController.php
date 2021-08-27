<?php

namespace App\Http\Controllers;

use App\Components\ParseDataClient;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showData(ParseDataClient $parseContent)
    {

        $data = $parseContent->parseData();

        return view('admin/index',[
            'data'=> $data
        ]);
    }
}
