<!--banner -->
<div id="slidey" style="display:none;">
    <ul>
        @foreach($bannerMovies as $movie)
        <li><img src="@if(substr($movie->image, 0, 4) == 'http'){{$movie->image}}@else{{url('/image?category=movie&type=image&filename='. $movie->image)}}@endif" alt=" "><p class='title'>{{$movie->code. ' ' .$movie->name}}</p><p class='description'> Tarzan, having acclimated to life in London, is called back to his former home in the jungle to investigate the activities at a mining encampment.</p></li>
        @endforeach
    </ul>
</div>
<!-- //banner -->