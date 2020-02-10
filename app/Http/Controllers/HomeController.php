<?php

namespace App\Http\Controllers;

use App\Blocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'html' => Blocks::getHtml(__METHOD__),
        ]);
    }
}
