<?php

namespace App\Http\Controllers;

use app\Repositories\ActressRepository;
use app\Repositories\MovieRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class FeHomeController extends Controller
{
    protected $movieRepository;
    protected $actressRepository;

    public function __construct(MovieRepository $movieRepo, ActressRepository $actressRepo)
    {
        $this->movieRepository = $movieRepo;
        $this->actressRepository = $actressRepo;
    }

    public function index(){
        $bannerMovies = $this->movieRepository->bannerMovies();
        $latestMovies = $this->movieRepository->latestMovies();
        $topViewedMovies = $this->movieRepository->topViewedMovies();
        $topRatingMovies = null;//$this->movieRepository->topRatingMovies();
        $recentlyAddedMovies = $this->movieRepository->recentlyAddedMovies();

        $recentlyActresses = $this->actressRepository->recentlyActresses();

        $todayMovies = $this->movieRepository->todayMovies();
        foreach ($todayMovies as $index => $movie)
        {
            $todayMovies[$index]->included = $movie->actresses()->select('name', 'id')->get();
            $todayMovies[$index]->contain = $movie->tags()->select('name', 'id')->get();
        }

        return view('frontend.home',[
            'bannerMovies' => $bannerMovies,
            'latestMovies' => $latestMovies,
            'topViewedMovies' => $topViewedMovies,
            'topRatingMovies' => $topRatingMovies,
            'recentlyAddedMovies' => $recentlyAddedMovies,
            'todayMovies' => $todayMovies,
            'recentlyActresses' => $recentlyActresses]);
    }
}
