<?php
namespace App\Http\Controllers;

use app\Repositories\ActressRepository;
use app\Repositories\MovieRepository;
use app\Repositories\StudioRepository;
use app\Repositories\TagRepository;
use Google_Client;
use Google_Exception;
use Google_Service_Exception;
use Google_Service_YouTube;
use Illuminate\Http\Request;

use App\Http\Requests;

class FeMoviesController extends Controller
{

    protected $OAUTH2_CLIENT_ID = '';
    protected $OAUTH2_CLIENT_SECRET = '';
    protected $refresh_token = '';

    protected $movieRepository;
    protected $studioRepository;
    protected $actressRepository;
    protected $tagRepository;

    protected $crbReviewLink = 'http://www.caribbeancom.com/moviepages/';
    protected $crbPrReviewLink = 'http://www.caribbeancompr.com/moviepages/';
    protected $heyReviewLink = 'http://www.heyzo.com/contents/3000/';
    protected $ponReviewLink = 'http://www.1pondo.tv/assets/sample/';
    protected $musumeReviewLink = 'http://www.10musume.com/moviepages/';

    protected $indexOrder = ['order' => ['col' => 'release',
        'dir' => 'desc'],
        'select' => ['code', 'id', 'thumbnail', 'name', 'rate', 'note']
    ];

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
        $perPage = $request->input('perPage', 24);
        if(isset($request->q)){
            $this->indexOrder['q'] = ['field' => 'code',
                'value' => $request->q];
        }

        $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $movies->appends(['q' => $request->q]);
        }

        return view('frontend.movies.index', [
            'movies' => $movies,
        ]);
    }

    public function index2(Request $request){
        $perPage = $request->input('perPage', 24);
        if(isset($request->q)){
            $this->indexOrder['q'] = ['field' => 'code',
                'value' => $request->q];
        }
        $this->indexOrder['q']['stored'] = 1;

        $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $movies->appends(['q' => $request->q]);
        }

        return view('frontend.movies.index', [
            'movies' => $movies,
        ]);
    }

    public function show($code, Request $request){
        $attribute = 'code';
        $value = $code;
        if(isset($request->id)){
            $attribute = 'id';
            $value = $request->id;
        }
        try{
            $movie = $this->movieRepository->findBy($attribute, $value);
            $actresses = $movie->actresses()->select('name', 'id')->get();
            $tags = $movie->tags()->select('name', 'id')->get();
            $movies = $this->movieRepository->bannerMovies();
            $imageLink = 0;
            switch ($movie->studio_id){
                case 1:
                    $imageLink = $this->crbReviewLink;
                    break;
                case 2:
                    $imageLink = $this->heyReviewLink;
                    break;
                case 3:
                    $imageLink = $this->musumeReviewLink;
                    break;
                case 4:
                    $imageLink = $this->ponReviewLink;
                    break;
                case 5:
                    $imageLink = $this->crbPrReviewLink;
                    break;
            }

        }catch (\Exception $e){
            return view('frontend.errors.404');
        }

        return view('frontend.movies.show', [
            'actresses' => $actresses,
            'movie' => $movie,
            'movies' => $movies,
            'imageLink' => $imageLink,
            'tags' => $tags]);
    }

    public function unlock(Request $request){
        $client = new Google_Client();
        $client->setClientId($this->OAUTH2_CLIENT_ID);
        $client->setClientSecret($this->OAUTH2_CLIENT_SECRET);
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->setScopes('https://www.googleapis.com/auth/youtube');

        $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
        $client->setRedirectUri($redirect);

        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);

        // Check if an auth token exists for the required scopes
        $tokenSessionKey = 'token-' . $client->prepareScopes();

        if (isset($this->refresh_token))
        {
            $client->refreshToken($this->refresh_token);
            session([$tokenSessionKey => $client->getAccessToken()]);
            header('Location: ' . $redirect);
        }

        // Check to ensure that the access token was successfully acquired.
        if ($client->getAccessToken()) {
            try {
                // REPLACE this value with the video ID of the video being updated.
                $videoId = $request->id;
                // Call the API's videos.list method to retrieve the video resource.
                $listResponse = $youtube->videos->listVideos('status',
                    array('id' => $videoId));

                // If $listResponse is empty, the specified video was not found.
                if (empty($listResponse)) {
                    return response()->json(
                        ['code' => 1]);
                } else {
                    // Since the request specified a video ID, the response only
                    // contains one video resource.
                    $video = $listResponse[0];
                    $videoStatus = $video['status'];
                    //Then you set the video status. Valid values are 'private', 'public', 'unlisted'.
                    $videoStatus->privacyStatus = 'unlisted';
                    //Finally you update the status & then video
                    $video->setStatus($videoStatus);
                    $updateResponse = $youtube->videos->update('status', $video);
                }

            } catch (Google_Service_Exception $e) {
                dd(htmlspecialchars($e->getMessage()));
            } catch (Google_Exception $e) {
                dd(htmlspecialchars($e->getMessage()));
            }
            session([$tokenSessionKey => $client->getAccessToken()]);
        }
        else {
            dd('ko');
        }

        return response()->json(
            ['code' => 1]);
    }

    public function lock(Request $request){
        $client = new Google_Client();
        $client->setClientId($this->OAUTH2_CLIENT_ID);
        $client->setClientSecret($this->OAUTH2_CLIENT_SECRET);
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->setScopes('https://www.googleapis.com/auth/youtube');

        $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
        $client->setRedirectUri($redirect);

        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);
        // Check if an auth token exists for the required scopes
        $tokenSessionKey = 'token-' . $client->prepareScopes();

        if (isset($this->refresh_token))
        {
            $client->refreshToken($this->refresh_token);
            session([$tokenSessionKey => $client->getAccessToken()]);
            header('Location: ' . $redirect);
            //$client->setAccessToken($_SESSION[$tokenSessionKey]);
        }

        // Check to ensure that the access token was successfully acquired.
        if ($client->getAccessToken()) {
            try {
                // REPLACE this value with the video ID of the video being updated.
                $videoId = $request->id;
                // Call the API's videos.list method to retrieve the video resource.
                $listResponse = $youtube->videos->listVideos("status",
                    array('id' => $videoId));

                // If $listResponse is empty, the specified video was not found.
                if (empty($listResponse)) {
                    return response()->json(
                        ['code' => 1]);
                } else {
                    // Since the request specified a video ID, the response only
                    // contains one video resource.
                    $video = $listResponse[0];
                    $videoStatus = $video['status'];
                    //Then you set the video status. Valid values are 'private', 'public', 'unlisted'.
                    $videoStatus->privacyStatus = 'private';
                    //Finally you update the status & then video
                    $video->setStatus($videoStatus);
                    $updateResponse = $youtube->videos->update('status', $video);
                }

            } catch (Google_Service_Exception $e) {
                dd(htmlspecialchars($e->getMessage()));
            } catch (Google_Exception $e) {
                dd(htmlspecialchars($e->getMessage()));
            }
            session([$tokenSessionKey => $client->getAccessToken()]);
        }
        else {
            dd('dek co authenticate dc');
        }

        return response()->json(
            ['code' => 1]);
    }
}
