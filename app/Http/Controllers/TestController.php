<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get(){
        return view('frontend.home');
    }

    public function post(){
        $array = ['fuck' => '1',
                  'this' => '2',
                  'shit' => '3'];

        return response()->json(['steam' => 'gaben', 'array1' => $array]);
    }
}