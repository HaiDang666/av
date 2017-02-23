<?php

namespace App\Http\Controllers;

use app\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    protected $seriesRepository;

    protected $indexOrder = ['order' => ['col' => 'created_at',
                                         'dir' => 'desc']];

    public function __construct(SeriesRepository $seriesRepo)
    {
        $this->seriesRepository = $seriesRepo;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', config('custom.default_load_limit'));

        $series = $this->seriesRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $series->appends(['q' => $request->q]);
        }

        return view('backend.series.index', [
            'series' => $series,
        ]);
    }

    public function show($seriesID){
        try{
            $series = $this->seriesRepository->find($seriesID);
            $movies = $series->movies()->paginate(15);
        }
        catch(\Exception $e){
            return view('errors.404');
        }

        return view('backend.series.show', [
            'series' => $series,
            'movies' => $movies]);    
    }

    public function create(){
        return view('backend.series.partials.create');
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->seriesRepository->create($data, ['validation' => TRUE]);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $series = $this->seriesRepository->paginate($perPage, $this->indexOrder);

            $notification = makeNotification('Add', $data['name']);
            $html = view('backend.series.partials.table',[
                'series' => $series,
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

    public function edit($seriesID){
        try{
            $series = $this->seriesRepository->find($seriesID);
        }
        catch(\Exception $e){
            return view('errors.404');
        }

        return view('backend.series.partials.edit',
            ['series' => $series]);
    }

    public function update($seriesID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->seriesRepository->updateAtID($seriesID, $data, ['validation' => TRUE]);
            $notification = makeNotification('Update', $data['name']);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $series = $this->seriesRepository->paginate($perPage, $this->indexOrder);

            $html['table'] = view('backend.series.partials.table',['series' => $series])->render();
            $html['form'] = view('backend.series.partials.create')->render();

        }catch (\Exception $e){
            $notification = makeNotification('Update', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
             'notification' => $notification]);
    }

    public function destroy($seriesID, Request $request){
        try{
            $deleted_series = $this->seriesRepository->delete($seriesID);

            $notification = makeNotification('Delete', $deleted_series->name);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $series = $this->seriesRepository->paginate($perPage, $this->indexOrder);

            $html = view('backend.series.partials.table',['series' => $series])->render();
        }catch (\Exception $e){
            $notification = makeNotification('Delete', isset($deleted_series->name) ? $deleted_series->name : 'series with ID '. $seriesID, 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
             'notification' => $notification]);
    }
}
