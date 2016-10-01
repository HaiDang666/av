<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use app\Repositories\ActressRepository;
use app\Repositories\MovieRepository;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    protected $movieRepository;
    protected $actressRepository;

    public function __construct(MovieRepository $movieRepo, ActressRepository $actressRepo)
    {
        $this->movieRepository = $movieRepo;
        $this->actressRepository = $actressRepo;
    }


    public function index()
    {
        $totalMovie = $this->movieRepository->total();
        $totalActress = $this->actressRepository->total();

        return view('home', [
            'totalMovie' => $totalMovie,
            'totalActress' => $totalActress
        ]);
    }
}