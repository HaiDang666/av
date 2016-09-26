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
use Illuminate\Http\Request;


class ActressesController extends Controller
{
    protected $actressRepository;

    protected $indexOrder = ['order' => ['col' => 'updated_at',
        'dir' => 'desc']];

    public function __construct(ActressRepository $actressRepo)
    {
        $this->actressRepository = $actressRepo;
    }

    public function index(Request $request){
        $perPage = $request->input('perPage', config('custom.default_load_limit'));

        $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);
        return view('actresses.index', [
            'actresses' => $actresses,
        ]);
    }

    public function show(){
        return view('errors.404');
    }

    public function create(){
        return view('studios.partials.create');
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->actressRepository->create($data, ['validation' => TRUE]);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);

            $notification = makeNotification('Add', $data['name']);
            $html = view('actresses.partials.table',[
                'actresses' => $actresses,
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

    public function edit($actressID){
        $actress = $this->actressRepository->find($actressID);

        return response()->json(['actress' => $actress]);
    }

    public function update($actressID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->actressRepository->updateAtID($actressID, $data, ['validation' => TRUE]);
            $notification = makeNotification('Update', $data['name']);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);

            $html['table'] = view('actresses.partials.table',['actresses' => $actresses])->render();

        }catch (\Exception $e){
            $notification = makeNotification('Update', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

    public function destroy($actressID, Request $request){
        try{
            $deleted_actress = $this->actressRepository->delete($actressID);

            $notification = makeNotification('Delete', $deleted_actress->name);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);

            $html = view('actresses.partials.table',['actresses' => $actresses,])->render();
        }catch (\Exception $e){
            $notification = makeNotification('Delete', isset($deleted_actress->name) ? $deleted_actress->name : 'actress with ID '. $actressID, 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

}