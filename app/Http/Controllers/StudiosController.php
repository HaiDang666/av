<?php

namespace App\Http\Controllers;

use app\Repositories\StudioRepository;
use Illuminate\Http\Request;

class StudiosController extends Controller
{
    protected $studioRepository;

    protected $indexOrder = ['order' => ['col' => 'created_at',
                                         'dir' => 'desc']];

    public function __construct(StudioRepository $studioRepo)
    {
        $this->studioRepository = $studioRepo;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', config('custom.default_load_limit'));

        $studios = $this->studioRepository->paginate($perPage, $this->indexOrder);
        return view('studios.index', [
            'studios' => $studios,
        ]);
    }

    public function show(){
        return view('errors.404');
    }

    public function create(){
        return view('errors.404');
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->studioRepository->create($data, ['validation' => TRUE]);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $studios = $this->studioRepository->paginate($perPage, $this->indexOrder);

            $notification = makeNotification('create', $data['name']);
            $html = view('studios.partials.table',[
                'studios' => $studios,
            ])->render();
        }
        catch (\Exception $e){
            $notification = makeNotification('create', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
            'notification' => $notification]);
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
