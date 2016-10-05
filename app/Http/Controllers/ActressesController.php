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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


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

        if(isset($request->q)){
            $this->indexOrder['q'] = ['field' => 'name',
                                      'value' => $request->q];
        }

        $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $actresses->appends(['q' => $request->q]);
        }

        return view('actresses.index', [
            'actresses' => $actresses,
        ]);
    }

    public function show($actressID){
        try{
            $actress = $this->actressRepository->find($actressID);
            $movies = $actress->movies()->paginate(5);
        }
        catch (\Exception $e){
            return view('errors.404');
        }

        return view('actresses.show', ['actress' => $actress, 'movies' => $movies]);
    }

    public function create(){
        return view('actresses.create');
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            if($data['dob'] != '')
            {
                $a = explode('-', $data['dob']);
                $data['dob'] = $a[2].'-'.$a[1].'-'.$a[0];
            }
            else $data['dob'] = '1970-01-01';

            $data['debut'] = $data['debut'] == '' ? 0 : $data['debut'];

            // save thumbnail
            if(isset($data['thumbnail'])){
                $imageName = str_replace(' ', '_', $data['name']). '_thumbnail' . '.' .
                    $request->file('thumbnail')->getClientOriginalExtension();

                $request->file('thumbnail')->move(
                    base_path() . '/storage/'. config('custom.thumbnail_actress_path'), $imageName
                );

                $data['thumbnail'] = $imageName;
            }

            // save big image
            if(isset($data['image'])){
                $imageName = str_replace(' ', '_', $data['name']). '_image' . '.' .
                    $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(
                    base_path() . '/storage/'. config('custom.image_actress_path'), $imageName
                );

                $data['image'] = $imageName;
            }

            $this->actressRepository->create($data, ['validation' => TRUE]);

            /*$perPage = $request->input('perPage', config('custom.default_load_limit'));
            $actresses = $this->actressRepository->paginate($perPage, $this->indexOrder);

            $notification = makeNotification('Add', $data['name']);
            $html = view('actresses.partials.table',[
                'actresses' => $actresses,
            ])->render();*/
        }
        catch (\Exception $e){
            return $e->getMessage();
            //$notification = makeNotification('Add', $data['name'], 0, $e->getMessage());
            //$html = '';
        }

        return redirect()->back();
        /*return response()->json(
            ['html' => $html,
                'notification' => $notification]);*/
    }

    public function edit($actressID){
        $actress = $this->actressRepository->find($actressID);

        return view('actresses.edit',['actress' => $actress]);
    }

    public function update($actressID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $actress = $this->actressRepository->find($actressID);

            // check new thumbnail
            if(isset($data['thumbnail'])){
                // remove old thumbnail
                if($actress->thumbnail != ''){
                    $storagePath = storage_path(config('custom.thumbnail_actress_path') . $actress->thumbnail);
                    File::delete($storagePath);
                }

                // save thumbnail
                $imageName = str_replace(' ', '_', $actress->name). '_thumbnail' . '.' .
                    $request->file('thumbnail')->getClientOriginalExtension();

                $request->file('thumbnail')->move(
                    base_path() . '/storage/'. config('custom.thumbnail_actress_path'), $imageName
                );

                $data['thumbnail'] = $imageName;
            }

           // check new image
            if(isset($data['image'])){
                // remove old image
                if($actress->image != ''){
                    $storagePath = storage_path(config('custom.image_actress_path') . $actress->image);
                    File::delete($storagePath);
                }

                // save big image
                $imageName = str_replace(' ', '_', $actress->name). '_image' . '.' .
                    $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(
                    base_path() . '/storage/'. config('custom.image_actress_path'), $imageName
                );

                $data['image'] = $imageName;
            }

            // update other attribute
            if (!empty($data)){
                $this->actressRepository->updateAtID($actressID, $data, ['validation' => TRUE,
                                                                         'unique' => addExceptionUniqueRule(['name'], $actressID)]);
            }

            Session::flash('message', 'Update successful');
            Session::flash('alert-class', 'alert-success');
        }catch (\Exception $e){
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        return redirect('actresses/'.$actressID);
    }

    public function destroy($actressID, Request $request){
        try{
            $deleted_actress = $this->actressRepository->delete($actressID);

            if($deleted_actress->thumbnail != ''){
                $storagePath = storage_path(config('custom.thumbnail_actress_path') . $deleted_actress->thumbnail);
                File::delete($storagePath);
            }
            if($deleted_actress->image != ''){
                $storagePath = storage_path(config('custom.image_actress_path') . $deleted_actress->image);
                File::delete($storagePath);
            }

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