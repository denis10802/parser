<?php

namespace App\Http\Controllers;

use App\Models\Notice;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showData()
    {
        //   вывод данных из бд на админку
        $notices = Notice::all();

        return view('admin/index', [
            'notices' => $notices,

        ]);
    }




}
