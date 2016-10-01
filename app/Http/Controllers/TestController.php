<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function get(){
        $storagePath = storage_path(config('custom.thumbnail_actress_path') . 'test_avatar3_thumbnail.jpg');
        return response()->file($storagePath);
    }

    public function post(){
        $array = ['fuck' => '1',
                  'this' => '2',
                  'shit' => '3'];

        return response()->json(['steam' => 'gaben', 'array1' => $array]);
    }
}