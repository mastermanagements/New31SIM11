<script>

    //iCheck for checkbox and radio inputs
    $('input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })


    $(document).ready(function () {
		
       uploadSurat = function (id) {
           $.ajax({
               url : '{{ url('ambilDataSuratKeluar') }}/'+id,
               dataType : 'json',
               success : function (result) {
                   //console.log(result)
                   $('[name="id"]').val(result.data.id)
                   $('#cek_file').val(result.data.scan_file)
                   $('#modal-tambah-file-surat-keluar').modal('show')
               }
           })
       }

       ubahStatusSurat = function (id) {
           $.ajax({
               url : '{{ url('ambilDataSuratKeluar') }}/'+id,
               dataType : 'json',
               success : function (result) {
                   //console.log(result)
                   $('[name="id_ubah"]').val(result.data.id)
                   $('#modal-ubah-status-surat').modal('show')
               }
           })
       }
   });
</script>
