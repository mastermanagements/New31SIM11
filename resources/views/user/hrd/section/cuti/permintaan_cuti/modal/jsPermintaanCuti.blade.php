<script>
    $(document).ready(function () {
        modelUpload = function (id_permintaan_cuti) {
            $('#modal-upload-surat-permintaan').modal('show');
            $('[name="id_permintaan_cuti"]').val(id_permintaan_cuti);
        }
    })
</script>