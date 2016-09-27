<script>
    function setAddActressButton() {
        $('#md-add-actress').on('shown.bs.modal', function () {
            $('#inputName').focus();
        });

        $('#md-edit-actress').on('shown.bs.modal', function () {
            $('#inputNameEdit').focus();
        });

        $('#btn-open-add-actress').click(function (e) {
            e.preventDefault();

            $('#md-add-actress').modal('show');
        })
    }

    function setActionButton() {
        $('.btn-edit-actress').click(function (e) {
            e.preventDefault();
            $('#inactionActress').val($(this).attr('data-id'));

            $.get('/actresses/' + $(this).attr('data-id') + '/edit' ,function (data) {
                $('#inputNameEdit').val(data.actress.name);

                $('#md-edit-actress').modal('show');

                $('#frm-edit-actress').
                submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'PUT',
                        url: '/actresses/' +  $('#inactionActress').val(),
                        data: $('#frm-edit-actress').serialize(),
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.notification.code != 0){
                                $('#actress-list').html(data.html.table);
                                $('#frm-edit-actress').trigger('reset');
                                setActionButton();
                            }

                            showNotification(data.notification);
                            $('#md-edit-actress').modal('hide');
                        }
                    });
                });
            });

        });

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

    function setSubmitForm() {
        setAddActressButton();

        $('#frm-add-actress').
            submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/actresses',
                data: $('#frm-add-actress').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#actress-list').html(data.html);
                        $('#frm-add-actress').trigger('reset');
                        setActionButton();
                    }

                    $('#md-add-actress').modal('hide');
                    showNotification(data.notification);
                }
            });
        });
    }

    $(document).ready(function () {
        setActionButton();

        setSubmitForm();
    });
</script>