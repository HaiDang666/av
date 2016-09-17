<?php

namespace App\Http\Controllers;

use app\Repositories\StudioRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudiosController extends Controller
{
    protected $studioRepository;

    public function __construct(StudioRepository $studioRepo)
    {
        $this->studioRepository = $studioRepo;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', config('custom.default_load_limit'));

        $studios = $this->studioRepository->paginate($perPage);

        return view('studios.index', [
            'studios' => $studios,
        ]);
    }

    public function show(){

    }

    public function create(){

    }

    public function store(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
