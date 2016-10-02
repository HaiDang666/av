<script>
    function setActionButton() {
        $('.btn-delete-movie').click(function (e) {
            e.preventDefault();
            $('#inactionMovie').val($(this).attr('data-id'));
            $('#md-confirm-delete-movie').modal('show');
        });

        $('#btn-confirm-delete-movie').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'DELETE',
                url: '/movies/' + $('#inactionMovie').val(),
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#movie-list').html(data.html);
                        setActionButton();
                    }

                    showNotification(data.notification);
                    $('#md-confirm-delete-movie').modal('hide');
                }
            });
        });
    }

    $(document).ready(function () {
        setActionButton();
    });
</script>