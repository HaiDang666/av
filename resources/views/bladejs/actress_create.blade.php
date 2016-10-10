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

        //Date picker
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        //Initialize Select2 Elements
        $('.select2').select2();

        $('#inputTags').select2({
            placeholder: 'Choose tags'
        });

        $('#inputCupSize').select2({
            placeholder: 'Choose cup size'
        });
    });
</script>