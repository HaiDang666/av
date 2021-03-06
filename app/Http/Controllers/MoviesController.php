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
use app\Repositories\SeriesRepository;
use app\Repositories\StudioRepository;
use app\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Kurt\Imgur\Imgur;


class MoviesController extends Controller
{
    protected $movieRepository;
    protected $studioRepository;
    protected $seriesRepository;
    protected $actressRepository;
    protected $tagRepository;

    protected $imgurService;
    protected $imgurAllow;

    protected $heyLink = 'http://www.heyzo.com/contents/3000/';
    protected $heyImage = '/images/player_thumbnail.jpg';
    protected $heyThumbnail = '/images/thumbnail.jpg';

    protected $ponLink = 'http://www.1pondo.tv/assets/sample/';
    protected $ponImage = '/str.jpg';
    protected $ponThumbnail = '/thum_b.jpg';

    protected $crbLink = 'http://www.caribbeancom.com/moviepages/';
    protected $crbThumbnail = '/images/jacket.jpg';

    protected $crbPrLink = 'http://www.caribbeancompr.com/moviepages/';
    protected $crbPrThumbnail = '/images/main_b.jpg';

    protected $crbImage = '/images/l_l.jpg';

    protected $indexOrder = ['order' => ['col' => 'updated_at',
        'dir' => 'desc'],
        'select' => ['code', 'id', 'thumbnail', 'name', 'studio_id', 'stored']
    ];

    public function __construct(MovieRepository $movieRepo,
                                StudioRepository $studioRepo,
                                SeriesRepository $seriesRepo,
                                ActressRepository $actressRepo,
                                TagRepository $tagRepo,
                                Imgur $imgur)
    {
        $this->movieRepository = $movieRepo;
        $this->studioRepository = $studioRepo;
        $this->seriesRepository = $seriesRepo;
        $this->actressRepository = $actressRepo;
        $this->tagRepository = $tagRepo;
        $this->imgurService = $imgur;
        $this->imgurAllow = config('setting.imgurService', false);
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

        return view('backend.movies.index', [
            'movies' => $movies,
        ]);
    }

    public function show($movieID){
        try{
            $movie = $this->movieRepository->find($movieID);
            $actresses = $movie->actresses;
            $tags = $movie->tags;

            $flaged = $this->movieRepository->checkMissing($movie->id, 1);
        }
        catch (\Exception $e){
            return view('errors.404');
        }

        return view('backend.movies.show', ['actresses' => $actresses, 'movie' => $movie, 'tags' => $tags, 'flaged' => $flaged]);
    }

    public function create(){
        $studios = $this->studioRepository->allForSelect();
        $actresses = $this->actressRepository->all(['name', 'id']);
        $tags = $this->tagRepository->allForSelect();
        $series = $this->seriesRepository->allForSelect();

        return view('backend.movies.create',
            ['studios' => $studios,
            'actresses' => $actresses,
            'series' => $series,
            'tags' => $tags]);
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);
        try{
            $code = $data['code'];
            switch ($data['studio_id']){
                case '1':
                    $code = str_replace('_', '-', $code);
                    break;
                case '4':
                case '5':
                    $code = str_replace('-', '_', $code);
                    break;
            }
            $data['code'] = $code;
            if($data['release'] != '')
            {

            }
            elseif (strlen($code) > 6){
                $date = str_split(substr($code, 0, 6),2);
                $data['release'] = '20'. $date[2] .'-'. $date[0] .'-'. $date[1];
            }
            else $data['release'] = '1970-01-01';

            // save thumbnail
            if($data['thumbnaillink'] == '') {
                if (isset($data['thumbnail'])) {
                    if ($this->imgurAllow) {
                        $imageModel = $this->imgurService->upload($request->file('thumbnail'));
                        $data['thumbnail'] = $imageModel->getLink();
                    } else {
                        $data['thumbnail'] = storeImage($request->file('thumbnail'), $data['code'], 'custom.thumbnail_movie_path');
                    }
                }else {
                    switch ($data['studio_id']){
                        case '1':
                            $data['thumbnail'] = $this->crbLink . $code . $this->crbThumbnail;
                            break;
                        case '2':
                            $data['thumbnail'] = $this->heyLink . $code . $this->heyThumbnail;
                            break;
                        case '4':
                            $data['thumbnail'] = $this->ponLink . $code . $this->ponThumbnail;
                            break;
                        case '5':
                            $data['thumbnail'] = $this->crbPrLink . $code . $this->crbPrThumbnail;
                            break;
                    }
                }
            }else{
                $data['thumbnail'] = $data['thumbnaillink'];
            }
            unset($data['thumbnaillink']);

            // save big image
            if($data['imagelink'] == ''){
                if(isset($data['image'])){
                    if ($this->imgurAllow){
                        $imageModel = $this->imgurService->upload($request->file('image'));
                        $data['image'] = $imageModel->getLink();
                    }
                    else {
                        $data['image'] = storeImage($request->file('image'), $data['code'], 'custom.image_movie_path');
                    }
                }else {
                    switch ($data['studio_id']){
                        case '1':
                            $data['image'] = $this->crbLink . $code . $this->crbImage;
                            break;
                        case '2':
                            $data['image'] = $this->heyLink . $code . $this->heyImage;
                            break;
                        case '4':
                            $data['image'] = $this->ponLink . $code . $this->ponImage;
                            break;
                        case '5':
                            $data['image'] = $this->crbPrLink . $code . $this->crbImage;
                            break;
                    }
                }
            }else{
                $data['image'] = $data['imagelink'];
            }
            unset($data['imagelink']);

            // check stored field
            $data['stored'] = isset($request->stored) ? 1 : 0;
            $data['length'] = $data['length'] == '' ? 61 : $data['length'];

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
        $series = $this->seriesRepository->allForSelect();

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

        //change release format
        if ($movie->release == '1970-01-01'){
            $movie->release = '';
        }
        else if($movie->release != '')
        {
            $a = explode('-', $movie->release);
            $movie->release = $a[2].'-'.$a[1].'-'.$a[0];
        }

        return view('backend.movies.edit',[
            'movie' => $movie,
            'studios' => $studios,
            'tags' => $tags,
            'series' => $series,
            'actresses' => $actresses,
            'selectedActresses' => $selectedActresses,
            'selectedTag' => $selectedTag]);
    }

    public function update($movieID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            if($data['release'] != '')
            {
                $a = explode('-', $data['release']);
                $data['release'] = $a[2].'-'.$a[1].'-'.$a[0];
            }
            else $data['release'] = '1970-01-01';

            $movie = $this->movieRepository->find($movieID);

            if(isset($data['series_id'])){
                if ($data['series_id'] == $movie->series){
                    unset($data['series_id']);
                }
            }

            // check new thumbnail
            if($data['thumbnaillink'] == '') {
                if (isset($data['thumbnail'])) {
                    if ($this->imgurAllow) {
                        $imageModel = $this->imgurService->upload($request->file('thumbnail'));
                        $data['thumbnail'] = $imageModel->getLink();
                    } else {
                        // remove old thumbnail
                        if ($movie->thumbnail != '') {
                            $storagePath = storage_path(config('custom.thumbnail_movie_path') . $movie->thumbnail);
                            File::delete($storagePath);
                        }

                        // save thumbnail
                        $data['thumbnail'] = storeImage($request->file('thumbnail'), $data['code'], 'custom.thumbnail_movie_path');
                    }
                }
            }else{
                $data['thumbnail'] = $data['thumbnaillink'];
            }
            unset($data['thumbnaillink']);

            // check new image
            if($data['imagelink'] == '') {
                if (isset($data['image'])) {
                    if ($this->imgurAllow) {
                        $imageModel = $this->imgurService->upload($request->file('image'));
                        $data['image'] = $imageModel->getLink();
                    } else {
                        // remove old image
                        if ($movie->image != '') {
                            $storagePath = storage_path(config('custom.image_movie_path') . $movie->image);
                            File::delete($storagePath);
                        }

                        // save big image
                        $data['image'] = storeImage($request->file('image'), $data['code'], 'custom.image_movie_path');
                    }
                }
            }else{
                $data['image'] = $data['imagelink'];
            }
            unset($data['imagelink']);

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

            $html = view('backend.movies.partials.table',['movies' => $movies,])->render();
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

    public function flag($movieID, Request $request){
        $data = $request->all();
        $this->movieRepository->addMissing($movieID, $data['name'], 1);
        return response()->json(
            ['res' => 1]);
    }

    public function unflag($movieID){
        $this->movieRepository->removeMissing($movieID, 1);
        return response()->json(
            ['res' => 1]);
    }

    public function missing(){
        $result = $this->movieRepository->getMissingList(1);

        return view('backend.movies.missing', ['movies' => $result]);
    }
}