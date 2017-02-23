<script>
    function setActionButton() {
        $('.btn-remove-actress').click(function (e) {
            e.preventDefault();
            $('#inactionActress').val($(this).attr('data-id'));
            $('#md-confirm-remove-actress').modal('show');
        });

        $('#btn-confirm-remove-actress').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/movies/' + $('#movieID').val() + '/remove/'+ $('#inactionActress').val(),
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#actress'+ $('#inactionActress').val()).remove();
                    }

                    showNotification(data.notification);
                    $('#md-confirm-remove-actress').modal('hide');
                }
            });
        });

        $('#btn-flag').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/movies/' + $('#movieID').val() + '/flag',
                data: {_token: '{{csrf_token()}}', name: '{{$movie->name}}'},
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
                url: '/movies/' + $('#movieID').val() + '/unflag',
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