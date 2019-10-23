<script>

    $('#tombol-print').click(function(){
        var tgl_awal =  $('[name="tgl_awal"]').val();
        var tgl_akhir=  $('[name="tgl_akhir"]').val();
       // window.open('{{ url('tampilan-cetak-neraca-saldo') }}/'+tgl_awal+'/'+tgl_akhir, '_blank');
    })
</script>