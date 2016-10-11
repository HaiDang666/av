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
use app\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MoviesController extends Controller
{
    protected $movieRepository;
    protected $studioRepository;
    protected $actressRepository;
    protected $tagRepository;

    protected $indexOrder = ['order' => ['col' => 'updated_at',
        'dir' => 'desc']];

    public function __construct(MovieRepository $movieRepo,
                                StudioRepository $studioRepo,
                                ActressRepository $actressRepo,
                                TagRepository $tagRepo)
    {
        $this->movieRepository = $movieRepo;
        $this->studioRepository = $studioRepo;
        $this->actressRepository = $actressRepo;
        $this->tagRepository = $tagRepo;
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
            $actresses = $movie->actresses;
            $tags = $movie->tags;
        }
        catch (\Exception $e){
            return view('errors.404');
        }

        return view('movies.show', ['actresses' => $actresses, 'movie' => $movie, 'tags' => $tags]);
    }

    public function create(){
        $studios = $this->studioRepository->allForSelect();
        $actresses = $this->actressRepository->all(['name', 'id']);
        $tags = $this->tagRepository->allForSelect();

        return view('movies.create',
            ['studios' => $studios,
            'actresses' => $actresses,
            'tags' => $tags]);
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);
        try{
            // save thumbnail
            if(isset($data['thumbnail'])){
                $data['thumbnail'] = storeImage($request->file('thumbnail'), $data['code'], 'custom.thumbnail_movie_path');
            }

            // save big image
            if(isset($data['image'])){
                $data['image'] = storeImage($request->file('image'), $data['code'], 'custom.image_movie_path');
            }

            // check stored field
            $data['stored'] = isset($request->stored) ? 1 : 0;
            $data['length'] = $data['length'] == '' ? 0 : $data['length'];

            $movie = $this->movieRepository->create($data, ['validation' => TRUE]);

            Session::flash('message', 'Add <a href='. url('movies/'.$movie->id) .' target="_blank">'.$movie->code.'</a> successful');
            Session::flash('alert-class', 'alert-success');
        }
        catch (\Exception $e){
            return $e->getMessage();
        }

        return redirect()->back();
    }

    public function edit($movieID){
        $movie = $this->movieRepository->find($movieID);
        $studios = $this->studioRepository->allForSelect();
        $actresses = $this->actressRepository->all(['name', 'id']);
        $tags = $this->tagRepository->allForSelect();

        $selectedActresses = [];
        $selected = $movie->actresses()->get(['id']);
        foreach ($selected as $actress){
            $selectedActresses[] = $actress->id;
        }

        $selectedTag = [];
        $selected = $movie->tags()->get(['id']);
        foreach ($selected as $tag){
            $selectedTag[] = $tag->id;
        }

        return view('movies.edit',[
            'movie' => $movie,
            'studios' => $studios,
            'tags' => $tags,
            'actresses' => $actresses,
            'selectedActresses' => $selectedActresses,
            'selectedTag' => $selectedTag]);
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
                $data['thumbnail'] = storeImage($request->file('thumbnail'), $data['code'], 'custom.thumbnail_movie_path');
            }

            // check new image
            if(isset($data['image'])){
                // remove old image
                if($movie->image != ''){
                    $storagePath = storage_path(config('custom.image_movie_path') . $movie->image);
                    File::delete($storagePath);
                }

                // save big image
                $data['image'] = storeImage($request->file('image'), $data['code'], 'custom.image_movie_path');
            }

            // check stored field
            $data['stored'] = isset($request->stored) ? 1 : 0;
            $data['length'] = $data['length'] == '' ? 0 : $data['length'];

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

    public function castout($movieID, $actressID){
        try {
            $this->actressRepository->removeMovie($actressID, $movieID);
            
            $notification = makeNotification('Remove', 'actress ' . $actressID . ' from movie' . $movieID);
        } catch (\Exception $e) {
            $notification = makeNotification('Remove', 'actress ' . $actressID . ' from movie' . $movieID, 0, $e->getMessage());
        }
        return response()->json(
            ['html' => '',
                'notification' => $notification]);
    }
}