<?php

namespace App\Http\Controllers;

use app\Repositories\ActressRepository;
use app\Repositories\TagRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class FeActressesController extends Controller
{
    protected $actressRepository;
    protected $tagRepository;

    protected $indexOrder = ['order' => ['col' => 'created_at',
        'dir' => 'desc']];

    public function __construct(ActressRepository $actressRepo, TagRepository $tagRepo)
    {
        $this->actressRepository = $actressRepo;
        $this->tagRepository = $tagRepo;
    }

    public function index(Request $request){
        $perPage = $request->input('perPage', 24);

        if(isset($request->q)){
            $this->indexOrder['q'] = ['field' => 'name',
                'value' => $request->q];
        }

        $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $actresses->appends(['q' => $request->q]);
        }

        return view('frontend.actresses.index', [
            'actresses' => $actresses,
        ]);
    }

    public function show($name, Request $request){
        $attribute = 'name';
        $value = str_replace('_', ' ', $name);
        if(isset($request->id)){
            $attribute = 'id';
            $value = $request->id;
        }
        try{
            $actress = $this->actressRepository->findBy($attribute,$value);
            $movies = $actress->movies()->paginate(24);
            $tags = $actress->tags;
        }
        catch (\Exception $e){
            return view('frontend.errors.404');
        }

        return view('frontend.actresses.show', ['actress' => $actress, 'movies' => $movies, 'tags' => $tags]);
    }
}
