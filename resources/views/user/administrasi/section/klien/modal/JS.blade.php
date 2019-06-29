<script>

   
    $(document).ready(function () {
		
       detailKlien = function (id) {
           $.ajax({
               url : '{{ url('ambilDataKlien') }}/'+id,
               dataType : 'json',
               success : function (result) {
                   //console.log(result)
				   
                   //$('[name="id_ubah"]').val(result.data.id)
				   $('[name="nm_klien"]').val(result.data.nm_klien);
				   $('[name="alamat"]').val(result.data.alamat);
				   $('[name="pekerjaan"]').val(result.data.pekerjaan);
				   $('[name="hp"]').val(result.data.hp);
				   $('[name="wa"]').val(result.data.wa);
				   $('[name="email"]').val(result.data.email);
				   $('[name="teleg"]').val(result.data.teleg);
				   $('[name="ig"]').val(result.data.ig);
				   $('[name="fb"]').val(result.data.fb);
				   $('[name="twiter"]').val(result.data.twiter);
				   $('[name="nm_perusahaan"]').val(result.data.nm_perusahaan);
				   $('[name="alamat_perusahaan"]').val(result.data.alamat_perusahaan);
				   $('[name="telp_perusahaan"]').val(result.data.telp_perusahaan);
				   $('[name="jabatan"]').val(result.data.jabatan);
                   $('#modal-detail-klien').modal('show')
				   
				
				   
               }
           })
       }
   });
</script>
