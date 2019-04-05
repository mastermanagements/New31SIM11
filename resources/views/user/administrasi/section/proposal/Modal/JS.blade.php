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

        uploadDocProposal = function (id) {
            $('[name="id_doc_proposal"]').val(id);
            $('#modal-tambah-file-doc-proposal').modal('show')
        }

        ubahStatusProposal = function (id) {
            $.ajax({
                url : "{{ url('ubah-status-proposal') }}/"+id,
                type : 'post',
                data : {
                    'id': id,
                    '_method': 'put',
                    '_token' : '{{ csrf_token() }}'
                },
                success :function (result) {
                    alert(result.message);
                }
            })
        }
   });
</script>
