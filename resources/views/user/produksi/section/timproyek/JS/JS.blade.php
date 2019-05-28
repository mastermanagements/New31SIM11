<script>
    $('.btnAddTim').each(function (index) {
        $(this).on('click', function () {
            $('[name="id_proyek"]').val($(this).val());
            $('#modal-timproyek').modal('show');
        })
    });

</script>