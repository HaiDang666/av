<script>
    $(document).ready(function () {
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
                    }

                    showNotification(data.notification);
                }
            });
        });
    });
</script>