<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index(){
        

        return view('landing_page.home', [
            'active' => 'home',
            'title' => 'Home'
        ]);
    }


}
