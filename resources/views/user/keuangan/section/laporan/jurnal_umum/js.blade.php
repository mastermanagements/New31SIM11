<script>
    var example_rincian=$('#example_rincian').DataTable({
        "ajax":"{{ url('Laporan-jurnal') }}",
        "columns":[
            {'data':'no_transaksi'},
            {'data':'tanggal'},
            {'data':'kode_akun'},
            {'data':'nm_akun'},
            {'data':'nama_keterangan'},
            {'data':'debet'},
            {'data':'kredit'},
        ],
        {{--drawCallback: buttonBuild("{{ $thn_proses }}"),--}}
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(), data;

            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1:
                    typeof i === 'number' ? i: 0;
            }

            total_debit = api.column(5).data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                },0)
            total_kredit = api.column(6).data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                },0)

            $(api.column(5).footer()).html(total_debit);
            $(api.column(6).footer()).html(total_kredit);
        },
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
                example_rincian.rows.add(result.data).draw();
            }
        })
    })

    $('#tombol-print').click(function(){
        var tgl_awal =  $('[name="tgl_awal"]').val();
        var tgl_akhir=  $('[name="tgl_akhir"]').val();
        window.open('{{ url('tampilan-cetak-jurnal-umum') }}/'+tgl_awal+'/'+tgl_akhir, '_blank');
    })
</script>