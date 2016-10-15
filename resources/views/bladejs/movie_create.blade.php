<script>
    $(document).ready(function () {
        //Initialize fileinput
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

        //Initialize Select2 Elements
        $('.select2').select2();

        //Date picker
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $('#inputStudio').select2({
            placeholder: 'Choose studio',
        });

        $('#inputNewActresses').select2({
            placeholder: 'Enter name of new actresses',
            tags: true
        });

        $('#inputExistActresses').select2({
            placeholder: 'Choose actresses'
        });

        $('#inputTags').select2({
            placeholder: 'Choose tags'
        });
    });
</script>