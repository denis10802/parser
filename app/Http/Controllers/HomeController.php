<?php

namespace App\Http\Controllers;

use App\Models\Notice;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notices = Notice::all();
        return view('admin/index', [
            'notices' => $notices
        ]);
    }
}
