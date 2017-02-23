<script>
    function setActionButton() {
        $('.btn-edit-series').click(function (e) {
            e.preventDefault();
            var seriesID = $(this).attr('data-id');

            $.get('/series/' + seriesID + '/edit' ,function (data) {
                $('#series-form').html(data);

                focusInputText($('#inputName'));

                $('#frm-edit-series').
                submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'PUT',
                        url: '/series/' + $('#seriesID').val(),
                        data: $('#frm-edit-series').serialize(),
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.notification.code != 0){
                                $('#series-form').html(data.html.form);
                                $('#series-list').html(data.html.table);

                                setSubmitCreateForm();
                                setActionButton();
                            }

                            showNotification(data.notification);
                        }
                    });
                });

                $('#btn-cancel-edit').click(function (e) {
                    e.preventDefault();
                    $.get('/series/create',function (data) {
                        $('#series-form').html(data);

                        setSubmitCreateForm();
                    });
                });
            });
        });

        $('.btn-delete-series').click(function (e) {
            e.preventDefault();
            $('#inactionSeries').val($(this).attr('data-id'));
            $('#md-confirm-delete-series').modal('show');
        });

        $('#btn-confirm-delete-series').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'DELETE',
                url: '/series/' + $('#inactionSeries').val(),
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#series-list').html(data.html);
                        setActionButton();
                    }

                    showNotification(data.notification);
                    $('#md-confirm-delete-series').modal('hide');
                }
            });
        });
    }

    function setSubmitCreateForm() {
        $('#frm-add-series').
        submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/series',
                data: $('#frm-add-series').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#series-list').html(data.html);
                        $('#frm-add-series').trigger('reset');
                        setActionButton();
                    }

                    showNotification(data.notification);
                }
            });
        });
    }

    $(document).ready(function () {
        setSubmitCreateForm();

        setActionButton();
    });
</script>