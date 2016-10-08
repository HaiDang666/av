<script>
    function setActionButton() {
        $('.btn-edit-tag').click(function (e) {
            e.preventDefault();
            var tagID = $(this).attr('data-id');

            $.get('/tags/' + tagID + '/edit' ,function (data) {
                $('#tag-form').html(data);

                focusInputText($('#inputName'));

                $('#frm-edit-tag').
                submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'PUT',
                        url: '/tags/' + $('#tagID').val(),
                        data: $('#frm-edit-tag').serialize(),
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.notification.code != 0){
                                $('#tag-form').html(data.html.form);
                                $('#tag-list').html(data.html.table);

                                setSubmitCreateForm();
                                setActionButton();
                            }

                            showNotification(data.notification);
                        }
                    });
                });

                $('#btn-cancel-edit').click(function (e) {
                    e.preventDefault();
                    $.get('/tags/create',function (data) {
                        $('#tag-form').html(data);

                        setSubmitCreateForm();
                    });
                });
            });
        });

        $('.btn-delete-tag').click(function (e) {
            e.preventDefault();
            $('#inactionTag').val($(this).attr('data-id'));
            $('#md-confirm-delete-tag').modal('show');
        });

        $('#btn-confirm-delete-tag').off('click').on('click',function(e){
            e.preventDefault();

            $.ajax({
                type: 'DELETE',
                url: '/tags/' + $('#inactionTag').val(),
                data: {_token: '{{csrf_token()}}'},
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#tag-list').html(data.html);
                        setActionButton();
                    }

                    showNotification(data.notification);
                    $('#md-confirm-delete-tag').modal('hide');
                }
            });
        });
    }

    function setSubmitCreateForm() {
        $('#frm-add-tag').
        submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/tags',
                data: $('#frm-add-tag').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#tag-list').html(data.html);
                        $('#frm-add-tag').trigger('reset');
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