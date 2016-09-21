<html>
<head>
    <title>ok</title>
</head>
<body>
<form id="frm" class="form-horizontal" method="post" action="{{url('test')}}">
    {!! csrf_field() !!}
    <input type="text" name="sssss" placeholder="Name">
    <button>submit</button>
</form>
@include('layouts.partials.scripts')
<script>
    $(document).ready(function () {
        $('#frm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/test',
                data: $('#frm').serialize(),
                dataType: 'JSON',
                success: function (data) {
                    alert(data.steam);
                    alert(data.array1.fuck);
                    $('#frm').trigger('reset');
                }
            });
        });
    });
</script>
</body>
</html>