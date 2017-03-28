<script>
    var utubeID = '{{$movie->link}}';
    var studio = '{{$movie->studio_id}}';
    var imageLinkS, imageLinkL, quantity;
    switch (studio){
        case '1':
            //caribeancom
            imageLinkS = '{{$imageLink}}' + '{{$movie->code}}' + '/images/s/00';
            imageLinkL = '{{$imageLink}}' + '{{$movie->code}}' + '/images/l/00';
            quantity = 7;
            break;
        case '2':
            //heyzo
            imageLinkS = '{{$imageLink}}' + '{{$movie->code}}' + '/gallery/thumbnail_00';
            imageLinkL = '{{$imageLink}}' + '{{$movie->code}}' + '/gallery/00';
            quantity = 5;
            break;
        case '3':
            //10musume
            imageLinkS = '{{$imageLink}}' + '{{$movie->code}}' + '/images/g_s00';
            imageLinkL = '{{$imageLink}}' + '{{$movie->code}}' + '/images/g_b00';
            quantity = 5;
            break;
        case '4':
            //1pondo
            imageLinkS = '{{$imageLink}}' + '{{$movie->code}}' + '/thum_106/';
            imageLinkL = '{{$imageLink}}' + '{{$movie->code}}' + '/popu/';
            quantity = 5;
            break;
    }

    var ext = '.jpg';
    var element = $('#images_review');

    function myCallback(i, answer) {
        if(answer == false)
            return;
        element.append('<td><a target="_blank" href="'+imageLinkL + i + ext+'"><img id="im'+i+'" src="'+imageLinkS + i + ext+'" alt=""></a></td>');
    }

    function IsValidImageUrl(url, i, callback) {
        var img = new Image();
        img.onerror = function() { callback(i, false); };
        img.onload =  function() { callback(i, true); };
        img.src = url
    }

    $(document).ready(function () {
        if(studio != '5'){
            for (var i = 1; i < quantity; i++) {
                IsValidImageUrl(imageLinkL + i + ext, i, myCallback);
            }
        }
        $("#video").click(function () {
            if(utubeID == ''){
                alert('dek co phim coi');
                return;
            }
            $(document.body).css({'cursor' : 'wait'});
            var token = "{!! csrf_token() !!}";
            var formData = {
                id: utubeID,
                _token: token
            };
            $.ajax({
                type: 'POST',
                url: '/movies/unlock',
                data: formData,
                success: function (data) {
                    $(document.body).css({'cursor' : 'default'});
                    if(data.code == '1'){
                        $("#video").remove();
                        $("#player").append('<iframe allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" width="100%" height="600px" src="https://www.youtube.com/embed/'+utubeID+'?controls=1&autoplay=1"></iframe>');
                        setTimeout(function () {
                            var token = "{!! csrf_token() !!}";
                            var formData = {
                                id: utubeID,
                                _token: token
                            };
                            $.ajax({
                                type: 'POST',
                                url: '/movies/lock',
                                data: formData,
                                success: function (data) {},
                                error: function () {}
                            });
                        },10000);
                    }
                },
                error: function () {
                    $(document.body).css({'cursor' : 'default'});
                    alert("dek cho coi");
                }
            });
        });
    });
</script>