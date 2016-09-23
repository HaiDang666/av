<script>
    function showNotification(noti) {
        var notiClass = 'alert-success';
        var notiTitle = '<i class="icon fa fa-check"></i> Success!';

        switch (noti.code){
            case 0:
                notiClass = 'alert-danger';
                notiTitle = '<i class="icon fa fa-ban"></i> Error!';
                break;
            case 2:
                notiClass = 'alert-warning';
                notiTitle = '<i class="icon fa fa-warning"></i> Warning!';
                break;
        }

        var html = '<div class="alert ' + notiClass +' fade in col-md-10 col-lg-offset-1 notification-app"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                '<h4>'+ notiTitle + '</h4><p>'+
                noti.mes + noti.detail + '</p></div>';

        $('#notification').html(html);
    }

    function focusInputText(inputField) {
        var strLength = inputField.val().length * 2;

        inputField.focus();
        inputField[0].setSelectionRange(strLength, strLength);
    }

    $(document).ready(function () {
        $('.hover-active').hover(function () {
            $(this).addClass('active');
        }, function () {
            $(this).removeClass('active');
        });
    });
</script>