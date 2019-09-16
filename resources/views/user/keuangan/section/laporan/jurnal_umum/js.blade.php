<script>
    var example_rincian=$('#example_rincian').DataTable({
        "ajax":"{{ url('Laporan-jurnal') }}",
        "column":[
            {'data':'data[,]'},
//            {'data':'tanggal'},
//            {'data':'kode_akun'},
//            {'data':'nm_akun'},
//            {'data':'nama_keterangan'},
//            {'data':'debet'},
//            {'data':'kredit'},
        ],
        {{--drawCallback: buttonBuild("{{ $thn_proses }}"),--}}
        filter: false,
        pagging : true,
        searching: false,
        info : true,
        ordering : true,
        processing : true,
        retrieve: true
    });
</script>