<script>
    function showNotification(noti) {
        var notiClass = 'alert-success';
        var notiTitle = 'Success!';

        switch (noti.code){
            case 0:
                notiClass = 'alert-danger';
                notiTitle = 'Error!';
                break;
            case 2:
                notiClass = 'alert-warning';
                notiTitle = 'Warning!';
                break;
        }

        var html = '<div class="alert ' + notiClass +' fade in col-md-10 col-lg-offset-1 notification-app"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                '<strong>'+ notiTitle + '</strong><p>'+
                noti.mes + noti.detail + '</p></div>';

        $('#notification').html(html);
    }

    $(document).ready(function () {
        $('.hover-active').hover(function () {
            $(this).addClass('active');
        }, function () {
            $(this).removeClass('active');
        });
    });
</script>