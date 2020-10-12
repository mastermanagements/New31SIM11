<script>
    $(document).ready(function () {
        var example_rincian=$('#example_rincian').DataTable({
            filter: false,
            pagging : true,
            searching: false,
            info : true,
            ordering : true,
            processing : true,
            retrieve: true
        });
    })

    var example_rincian=$('#example_rincian').DataTable({
        "columns":[
            {'data':'no_transaksi'},
            {'data':'tanggal'},
            {'data':'kode_akun'},
            {'data':'nama_akun'},
            {'data':'keterangan'},
            {'data':'debet'},
            {'data':'kredit'},
        ],
        filter: false,
        pagging : true,
        searching: false,
        info : true,
        ordering : true,
        processing : true,
        retrieve: true
    });


    $('#tombol-tampilkan').click(function () {
        $.ajax({
            url:'{{ url('tampilkan-jurnal-berdasarkan-tanggal') }}',
            type:'post',
            data: {
                'tanggal_awal': $('[name="tgl_awal"]').val(),
                'tanggal_akhir': $('[name="tgl_akhir"]').val(),
                '_token': '{{ csrf_token() }}'
            },
            success: function (result) {
                example_rincian.clear().draw();
                example_rincian.rows.add(result.data_jurnal).draw();
            }
        })
    })

    $('#tombol-print').click(function(){
        var tgl_awal =  $('[name="tgl_awal"]').val();
        var tgl_akhir=  $('[name="tgl_akhir"]').val();
        window.open('{{ url('tampilan-cetak-jurnal-umum') }}/'+tgl_awal+'/'+tgl_akhir, '_blank');
    })
</script>