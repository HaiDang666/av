<?php

namespace App\Http\Controllers;

use app\Repositories\TagRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends Controller
{
    protected $tagRepository;

    protected $indexOrder = ['order' => ['col' => 'created_at',
        'dir' => 'desc']];

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', config('custom.default_load_limit'));

        $tags = $this->tagRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $tags->appends(['q' => $request->q]);
        }

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }

    public function show($tagID){
        try{
            $tag = $this->tagRepository->find($tagID);
            $movies = $tag->movies()->paginate(15);
        }
        catch(\Exception $e){
            return view('errors.404');
        }

        return view('tags.show', [
            'tag' => $tag,
            'movies' => $movies]);
    }

    public function create(){
        return view('tags.partials.create');
    }

    public function store(Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->tagRepository->create($data, ['validation' => TRUE]);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $tags = $this->tagRepository->paginate($perPage, $this->indexOrder);

            $notification = makeNotification('Add', $data['name']);
            $html = view('tags.partials.table',[
                'tags' => $tags,
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

    public function edit($tagID){
        try{
            $tag = $this->tagRepository->find($tagID);
        }
        catch(\Exception $e){
            return view('errors.404');
        }

        return view('tags.partials.edit',
            ['tag' => $tag]);
    }

    public function update($tagID, Request $request){
        $data = $request->all();
        unset($data['_token']);

        try{
            $this->tagRepository->updateAtID($tagID, $data, ['validation' => TRUE]);
            $notification = makeNotification('Update', $data['name']);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $tags = $this->tagRepository->paginate($perPage, $this->indexOrder);

            $html['table'] = view('tags.partials.table',['tags' => $tags])->render();
            $html['form'] = view('tags.partials.create')->render();

        }catch (\Exception $e){
            $notification = makeNotification('Update', $data['name'], 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

    public function destroy($tagID, Request $request){
        try{
            $deleted_tag = $this->tagRepository->delete($tagID);

            $notification = makeNotification('Delete', $deleted_tag->name);

            $perPage = $request->input('perPage', config('custom.default_load_limit'));
            $tags = $this->tagRepository->paginate($perPage, $this->indexOrder);

            $html = view('tags.partials.table',['tags' => $tags])->render();
        }catch (\Exception $e){
            $notification = makeNotification('Delete', isset($deleted_tag->name) ? $deleted_tag->name : 'tag with ID '. $tagID, 0, $e->getMessage());
            $html = '';
        }

        return response()->json(
            ['html' => $html,
                'notification' => $notification]);
    }

}
