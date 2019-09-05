<script>

    var table_transaksi=$('.table_transaksi').DataTable({
        "ajax":"{{ url('data-penerimaan') }}",
        column:[
            {'data':'0'}
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
    var counter=1;

    var t= $('#example3').DataTable();
    var akun = "<select class='form-control select2' style='width:100%' name='id_akun_aktif[]' required> @foreach($akun_aktif as $value) <option value='{{ $value->id }}'> {{ $value->kode_akun_aktif }}: {{ $value->nm_akun_aktif }}</option> @endforeach </select>";
    var posisi = "<select class='form-control select2' style='width:100%' name='posisi[]' required> @foreach($posisi as $key=> $value) <option value='{{ $key }}'> {{ $value }}</option> @endforeach </select>";
    var button="<button type='button' class='btn btn-danger'>Hapus</button>"
    $('#addRow').on( 'click', function () {
        t.row.add( [
            akun,
            posisi,
            button,
        ] ).draw( false );
        counter++;
    });

    $('#example3').on('click','button', function () {
        t.row($(this).parents('tr')).remove().draw(false);
    });

    $('#simpan').on('click', function () {
        $.ajax({
            url:"{{ url('store-transaksi-penerimaan') }}",
            type: "post",
            data: $('#form-penerimaan').serialize(),
            success:function (result) {
                console.log(result.message);
                table_transaksi.reatable.ajax.reload( function ( json ) {
                    $('#myInput').val( json.lastInput );
                } );
            }
        })
    })
</script>