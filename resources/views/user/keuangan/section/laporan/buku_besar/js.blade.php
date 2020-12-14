<script>
    $(document).ready(function () {
        $('#tombol-tampilkan').click(function(){
            var tgl_awal =  $('[name="tgl_awal"]').val();
            var tgl_akhir=  $('[name="tgl_akhir"]').val();
            window.location.href='{{ url('tampilan-cetak-buku-besar') }}/'+tgl_awal+'/'+tgl_akhir;
        })

        $('#tombol-print').click(function(){
            var tgl_awal =  $('[name="tgl_awal"]').val();
            var tgl_akhir=  $('[name="tgl_akhir"]').val();
            window.open('{{ url('print-buku-besar') }}/'+tgl_awal+'/'+tgl_akhir,'_blank');
        })
    })
</script>