<script>

    //iCheck for checkbox and radio inputs
    $('input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })


    $(document).ready(function () {
        uploadCoverProposal = function (id) {
            $('[name="id_cover_proposal"]').val(id);
            $('#modal-tambah-file-cover-proposal').modal('show')
        }
   });
</script>
