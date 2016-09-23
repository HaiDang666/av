<script>
    function setActionButton() {
        $('.btn-edit-studio').click(function (e) {
            e.preventDefault();
            var studioID = $(this).attr('data-id');

            $.get('/studios/' + studioID + '/edit' ,function (data) {
                $('#studio-form').html(data);

                focusInputText($('#inputName'));

                $('#frm-edit-studio').
                submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'PUT',
                        url: '/studios/' + $('#studioID').val(),
                        data: $('#frm-edit-studio').serialize(),
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.notification.code != 0){
                                $('#studio-form').html(data.html.form);
                                $('#studio-list').html(data.html.table);

                                setSubmitCreateForm();
                                setActionButton();
                            }

                            showNotification(data.notification);
                        }
                    });
                });

                $('#btn-cancel-edit').click(function (e) {
                    e.preventDefault();
                    $.get('/studios/create',function (data) {
                        $('#studio-form').html(data);

                        setSubmitCreateForm();
                    });
                });
            });
        });

        $('.btn-delete-studio').click(function (e) {
            e.preventDefault();
            var studioID = $(this).attr('data-id');

            $.ajax({
                type: 'DELETE',
                url: '/studios/' + studioID,
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#studio-list').html(data.html);
                        setActionButton();
                    }

                    showNotification(data.notification);
                }
            });
        });
    }

    function setSubmitCreateForm() {
        $('#frm-add-studio').
        submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/studios',
                data: $('#frm-add-studio').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#studio-list').html(data.html);
                        $('#frm-add-studio').trigger('reset');
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