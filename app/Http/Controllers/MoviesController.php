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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

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

        if(isset($request->q)){
            $this->indexOrder['q'] = ['field' => 'code',
                'value' => $request->q];
        }

        $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $movies->appends(['q' => $request->q]);
        }

        return view('movies.index', [
            'movies' => $movies,
        ]);
    }

    public function show($movieID){
        try{
            $movie = $this->movieRepository->find($movieID);
            $actresses = $movie->actresses()->paginate(5);
        }
        catch (\Exception $e){
            return view('errors.404');
        }

        return view('movies.show', ['actresses' => $actresses, 'movie' => $movie]);
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
            // save thumbnail
            if(isset($data['thumbnail'])){
                $imageName = str_replace(' ', '_', $data['code']). '_thumbnail' . '.' .
                    $request->file('thumbnail')->getClientOriginalExtension();

                $request->file('thumbnail')->move(
                    base_path() . '/storage/'. config('custom.thumbnail_movie_path'), $imageName
                );

                $data['thumbnail'] = $imageName;
            }

            // save big image
            if(isset($data['image'])){
                $imageName = str_replace(' ', '_', $data['code']). '_image' . '.' .
                    $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(
                    base_path() . '/storage/'. config('custom.image_movie_path'), $imageName
                );

                $data['image'] = $imageName;
            }

            // check stored field
            $data['stored'] = isset($request->stored) ? 1 : 0;

            $this->movieRepository->create($data, ['validation' => TRUE]);

            Session::flash('message', 'Create successful');
            Session::flash('alert-class', 'alert-success');
        }
        catch (\Exception $e){
            return $e->getMessage();
            //$notification = makeNotification('Add', $data['code'], 0, $e->getMessage());
        }

        return redirect()->back();
        /*return response()->json(
            ['html' => '',
                'notification' => $notification]);*/
    }

    public function edit($movieID){
        $movie = $this->movieRepository->find($movieID);
        $studios = $this->studioRepository->all(['name', 'id']);
        $actresses = $this->actressRepository->all(['name', 'id']);

        return view('movies.edit',[
            'movie' => $movie,
            'studios' => $studios,
            'actresses' => $actresses]);
    }

    public function update($movieID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $movie = $this->movieRepository->find($movieID);

            // check new thumbnail
            if(isset($data['thumbnail'])){
                // remove old thumbnail
                if($movie->thumbnail != ''){
                    $storagePath = storage_path(config('custom.thumbnail_movie_path') . $movie->thumbnail);
                    File::delete($storagePath);
                }

                // save thumbnail
                $imageName = str_replace(' ', '_', $movie->code). '_thumbnail' . '.' .
                    $request->file('thumbnail')->getClientOriginalExtension();

                $request->file('thumbnail')->move(
                    base_path() . '/storage/'. config('custom.thumbnail_movie_path'), $imageName
                );

                $data['thumbnail'] = $imageName;
            }

            // check new image
            if(isset($data['image'])){
                // remove old image
                if($movie->image != ''){
                    $storagePath = storage_path(config('custom.image_movie_path') . $movie->image);
                    File::delete($storagePath);
                }

                // save big image
                $imageName = str_replace(' ', '_', $movie->code). '_image' . '.' .
                    $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(
                    base_path() . '/storage/'. config('custom.image_movie_path'), $imageName
                );

                $data['image'] = $imageName;
            }

            // check stored field
            $data['stored'] = isset($request->stored) ? 1 : 0;

            // update other attribute
            if (!empty($data)){
                $this->movieRepository->updateAtID($movieID, $data, ['validation' => TRUE,
                    'unique' => addExceptionUniqueRule(['code'], $movieID)]);
            }

            Session::flash('message', 'Update successful');
            Session::flash('alert-class', 'alert-success');
        }catch (\Exception $e){
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        return redirect('movies/'.$movieID);
    }

    public function destroy($movieID, Request $request){
        try{
            $deleted_movie = $this->movieRepository->delete($movieID);

            $notification = makeNotification('Delete', $deleted_movie->code);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

            $html = view('movies.partials.table',['movies' => $movies,])->render();
        }catch (\Exception $e){
            $notification = makeNotification('Delete', isset($deleted_movie->code) ? $deleted_movie->code : 'movie with code '. $movieID, 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

}