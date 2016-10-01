<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ImagesController extends Controller
{
    public function image(Request $request)
    {
        try{
            $key = 'custom.';
            if(!isset($request->type)){
                throw new \Exception('no image');
            }
            switch ($request->type){
                case 'thumbnail':
                    $key .= 'thumbnail_';
                    break;
                case 'image':
                    $key .= 'image_';
                    break;
                default:
                    throw new \Exception('no image');
            }

            if(!isset($request->category)){
                throw new \Exception('no image');
            }
            switch ($request->category){
                case 'actress':
                    $key .= 'actress_';
                    break;
                case 'movie':
                    $key .= 'movie_';
                    break;
                default:
                    throw new \Exception('no image');
            }

            if(!isset($request->filename)){
                throw new \Exception('no image');
            }

            $key .= 'path';
            $storagePath = storage_path(config($key) . $request->filename);
            return response()->file($storagePath);
        }catch (\Exception $e){
            return response()->file(storage_path(config('custom.no_image_path')));
        }

    }
}
