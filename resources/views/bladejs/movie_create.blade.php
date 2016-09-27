<script>
    $(document).ready(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

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
            allowClear: true
        });

        $('#inputNewActresses').select2({
            placeholder: 'Enter name of new actresses',
            tags: true
        });

        $('#inputExistActresses').select2({
            placeholder: 'Choose actresses'
        });
		
		$('#frm-add-movie').submit(function (e){
			e.preventDefault();
            var data = {
                _token: '{{csrf_token()}}',
                code: $('#inputCode').val(),
                name: $('#inputName').val(),
                studio_id: $('#inputStudio').val(),
                eact: $('#inputExistActresses').val(),
                nact: $('#inputNewActresses').val(),
                stored: $('#inputStored').is(':checked') == true ? 1 : 0
            };

            $.ajax({
                type: 'POST',
                url: '/movies',
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    if (data.notification.code != 0){
                        $('#frm-add-movie').trigger('reset');
                        $('#inputExistActresses').val(null).trigger("change");
                        $('#inputNewActresses').val(null).trigger("change");
                        $('#inputStudio').val(null).trigger("change");
                    }

                    showNotification(data.notification);
                }
            });
		});
    });
</script>