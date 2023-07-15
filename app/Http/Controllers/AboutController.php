<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        return view('landing_page.about', [
            'active' => 'about',
            'title' => 'About'
        ]);
    }
}
