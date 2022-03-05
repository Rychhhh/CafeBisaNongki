<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    public function dashboard()
    {
        return view('dashboard');
    }

    public function transaksi()
    {
        return view('Tampilan.transaksi');
    }

    public function menu()
    {
        return view('Tampilan.menu');
    }


    public function user()
    {
        return view('Tampilan.admin');
    }

}
