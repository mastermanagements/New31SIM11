<script>

   
    $(document).ready(function () {
		
       detailKlien = function (id) {
           $.ajax({
               url : '{{ url('ambilDataKlien') }}/'+id,
               dataType : 'json',
               success : function (result) {
                   //console.log(result)
                   $('[name="id_ubah"]').val(result.data.id)
                   $('#modal-detail-klien').modal('show')
               }
           })
       }
   });
</script>
