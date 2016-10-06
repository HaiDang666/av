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

        if(isset($request->q)){
            $studios->appends(['q' => $request->q]);
        }

        return view('studios.index', [
            'studios' => $studios,
        ]);
    }

    public function show($studioID){
        try{
            $studio = $this->studioRepository->find($studioID);
            $movies = $studio->movies()->paginate(15);
        }
        catch(\Exception $e){
            return view('errors.404');
        }

        return view('studios.show', [
            'studio' => $studio,
            'movies' => $movies]);    
    }

    public function create(){
        return view('studios.partials.create');
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->studioRepository->create($data, ['validation' => TRUE]);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $studios = $this->studioRepository->paginate($perPage, $this->indexOrder);

            $notification = makeNotification('Add', $data['name']);
            $html = view('studios.partials.table',[
                'studios' => $studios,
            ])->render();
        }
        catch (\Exception $e){
            $notification = makeNotification('Add', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
            'notification' => $notification]);
    }

    public function edit($studioID){
        try{
            $studio = $this->studioRepository->find($studioID);
        }
        catch(\Exception $e){
            return view('errors.404');
        }

        return view('studios.partials.edit',
            ['studio' => $studio]);
    }

    public function update($studioID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->studioRepository->updateAtID($studioID, $data, ['validation' => TRUE]);
            $notification = makeNotification('Update', $data['name']);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $studios = $this->studioRepository->paginate($perPage, $this->indexOrder);

            $html['table'] = view('studios.partials.table',['studios' => $studios])->render();
            $html['form'] = view('studios.partials.create')->render();

        }catch (\Exception $e){
            $notification = makeNotification('Update', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
             'notification' => $notification]);
    }

    public function destroy($studioID, Request $request){
        try{
            $deleted_studio = $this->studioRepository->delete($studioID);

            $notification = makeNotification('Delete', $deleted_studio->name);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $studios = $this->studioRepository->paginate($perPage, $this->indexOrder);

            $html = view('studios.partials.table',['studios' => $studios])->render();
        }catch (\Exception $e){
            $notification = makeNotification('Delete', isset($deleted_studio->name) ? $deleted_studio->name : 'studio with ID '. $studioID, 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
             'notification' => $notification]);
    }
}
