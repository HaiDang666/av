<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use app\Repositories\ActressRepository;
use app\Repositories\MovieRepository;
use Illuminate\Http\Request;

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