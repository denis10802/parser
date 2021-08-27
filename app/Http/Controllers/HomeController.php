<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showData(ParseController $parseContent)
    {

        $data = $parseContent->parseData();

        return view('admin/index',[
            'data'=> $data
        ]);
    }
}
