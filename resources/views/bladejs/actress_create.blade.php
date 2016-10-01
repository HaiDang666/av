<script>
    $(document).ready(function () {
        $('#inputThumbnail').fileinput({
            allowedFileTypes: ["image"],
            showRemove: false,
            showUpload: false,
            showZoom: false
        });

        $('#inputImage').fileinput({
            maxFileCount: 5,
            allowedFileTypes: ["image"],
            showRemove: false,
            showUpload: false,
            showZoom: false
        });

        /*$('#frm-add-actress').
        submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/actresses',
                data: $('#frm-add-actress').serialize(),
                enctype: 'multipart/form-data',
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#frm-add-actress').trigger('reset');
                        setActionButton();
                    }

                    showNotification(data.notification);
                }
            });
        });*/
    });
</script>