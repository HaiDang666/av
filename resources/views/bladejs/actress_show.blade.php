<script>
    function setActionButton() {
        $('.btn-remove-movie').click(function (e) {
            e.preventDefault();
            $('#inactionMovie').val($(this).attr('data-id'));
            $('#md-confirm-remove-movie').modal('show');
        });

        $('#btn-confirm-remove-movie').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/actresses/' + $('#actressID').val() + '/remove/'+ $('#inactionMovie').val(),
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#movie'+ $('#inactionMovie').val()).remove();
                    }

                    showNotification(data.notification);
                    $('#md-confirm-remove-movie').modal('hide');
                }
            });
        });

        $('#btn-flag').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/actresses/' + $('#actressID').val() + '/flag',
                data: {_token: '{{csrf_token()}}', name: '{{$actress->name}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.res == 1){
                        $('#btn-flag').remove();
                    }
                }
            });
        });

        $('#btn-unflag').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/actresses/' + $('#actressID').val() + '/unflag',
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.res == 1){
                        $('#btn-unflag').remove();
                    }
                }
            });
        });
    }

    $(document).ready(function () {
        setActionButton();
    });
</script>