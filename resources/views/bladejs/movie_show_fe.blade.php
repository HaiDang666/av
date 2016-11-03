<script>
    var studio = '{{$movie->studio_id}}';
    var imageLinkS = '{{$imageLink}}' + '{{$movie->code}}' + '/images/s/00';
    var imageLinkL = '{{$imageLink}}' + '{{$movie->code}}' + '/images/l/00';
    var ext = '.jpg';
    var element = $('#images_review');

    function myCallback(i, answer) {
        if(answer == false)
            return;
        element.append('<td><a target="_blank" href="'+imageLinkL + i + ext+'"><img id="im'+i+'" src="'+imageLinkS + i + ext+'" alt=""></a></td>');
    }

    function IsValidImageUrl(url, i, callback) {
        var img = new Image();
        img.onerror = function() { callback(i, false); }
        img.onload =  function() { callback(i, true); }
        img.src = url
    }

    $(document).ready(function () {
        if(studio == 1 || studio == 5){
            for (var i = 1; i < 7; i++) {
                IsValidImageUrl(imageLinkL + i + ext, i, myCallback);
            }
        }
    });
</script>