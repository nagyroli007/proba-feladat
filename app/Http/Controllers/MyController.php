<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function show() {
        $szoveg = 'Hello';

        return view('welcome')->withCharacters($szoveg);
    }
}
