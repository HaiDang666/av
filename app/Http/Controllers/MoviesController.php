<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/23/2016
 * Time: 11:27 AM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use app\Repositories\ActressRepository;
use app\Repositories\MovieRepository;
use app\Repositories\StudioRepository;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    protected $movieRepository;
    protected $studioRepository;
    protected $actressRepository;

    protected $indexOrder = ['order' => ['col' => 'updated_at',
        'dir' => 'desc']];

    public function __construct(MovieRepository $movieRepo,
                                StudioRepository $studioRepo,
                                ActressRepository $actressRepo)
    {
        $this->movieRepository = $movieRepo;
        $this->studioRepository = $studioRepo;
        $this->actressRepository = $actressRepo;
    }

    public function index(Request $request){
        $perPage = $request->input('perPage', config('custom.default_load_limit'));

        $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);
        return view('movies.index', [
            'movies' => $movies,
        ]);
    }

    public function show(){
        return view('errors.404');
    }

    public function create(){
        $studios = $this->studioRepository->all(['name', 'id']);
        $actresses = $this->actressRepository->all(['name', 'id']);

        return view('movies.create',
            ['studios' => $studios,
            'actresses' => $actresses]);
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->movieRepository->create($data, ['validation' => TRUE]);

            $notification = makeNotification('Add', $data['code']);
        }
        catch (\Exception $e){
            $notification = makeNotification('Add', $data['code'], 0, $e->getMessage());
        }

        return response()->json(
            ['html' => '',
                'notification' => $notification]);
    }

    public function edit($movieID){
        $actress = $this->movieRepository->find($movieID);

        return response()->json(['actress' => $actress]);
    }

    public function update($movieID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->movieRepository->updateAtID($movieID, $data, ['validation' => TRUE]);
            $notification = makeNotification('Update', $data['name']);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

            $html['table'] = view('movies.partials.table',['movies' => $movies])->render();

        }catch (\Exception $e){
            $notification = makeNotification('Update', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

    public function destroy($movieID, Request $request){
        try{
            $deleted_actress = $this->movieRepository->delete($movieID);

            $notification = makeNotification('Delete', $deleted_actress->name);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

            $html = view('movies.partials.table',['movies' => $movies,])->render();
        }catch (\Exception $e){
            $notification = makeNotification('Delete', isset($deleted_actress->name) ? $deleted_actress->name : 'actress with ID '. $movieID, 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

}