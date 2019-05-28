<script>

    $(document).ready(function () {

        $('.ubah-saat-diklik').click(function () {
            var $text = $(this), $input=$('<input type="text" class="form-control dateMul" name="tgl_tes[]">')
            $text.show();

            $text.hide().after($input);

        })


    })
</script>