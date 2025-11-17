<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Sistem Kelola Data Siswa";

        return view('pages.index', compact('title'));
    }
}
