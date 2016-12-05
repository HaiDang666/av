<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function get(){
        $res = DB::table('missing')
            ->where('id', 85)
            ->where('type', 1)
            ->limit(1)
            ->count();

        dd($res);
    }

    public function post(){
        $array = ['fuck' => '1',
                  'this' => '2',
                  'shit' => '3'];

        return response()->json(['steam' => 'gaben', 'array1' => $array]);
    }
}