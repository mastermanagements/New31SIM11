<script>

    //iCheck for checkbox and radio inputs

    $(document).ready(function () {
        uploadFileContrak = function (id) {
            $('[name="id_spk"]').val(id);
            $('#modal-tambah-file-spk').modal('show')
        }

        uploadFilescan = function (id) {
            $('[name="id_file_scan"]').val(id);
            $('#modal-tambah-file-scan-spk').modal('show')
        }
   });
</script>
