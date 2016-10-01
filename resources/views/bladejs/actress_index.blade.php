<script>
    function setActionButton() {
        $('.btn-delete-actress').click(function (e) {
            e.preventDefault();
            $('#inactionActress').val($(this).attr('data-id'));
            $('#md-confirm-delete-actress').modal('show');
        });

        $('#btn-confirm-delete-actress').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'DELETE',
                url: '/actresses/' + $('#inactionActress').val(),
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#actress-list').html(data.html);
                        setActionButton();
                    }

                    showNotification(data.notification);
                    $('#md-confirm-delete-actress').modal('hide');
                }
            });
        });
    }

    $(document).ready(function () {
        setActionButton();
    });
</script>