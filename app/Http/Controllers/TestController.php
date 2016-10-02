<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get(){
        $data['aa'] = 1;
        $data['bb'] = 1;
        unset($data['aa']);
        unset($data['bb']);

        dd(empty($data));
    }

    public function post(){
        $array = ['fuck' => '1',
                  'this' => '2',
                  'shit' => '3'];

        return response()->json(['steam' => 'gaben', 'array1' => $array]);
    }
}