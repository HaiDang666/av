<script>
    $(document).ready(function () {
        $('.hover-active').hover(function () {
            $(this).addClass('active');
        }, function () {
            $(this).removeClass('active');
        });
    });
</script>