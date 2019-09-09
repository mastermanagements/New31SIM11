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
    var transaksi= $('#example_rincian').DataTable({
        ordering : false,
    });
    var akun = "<select class='form-control select2' style='width:100%' name='id_akun_aktif[]' required> @foreach($akun_aktif as $value) <option value='{{ $value->id }}'> {{ $value->kode_akun_aktif }}: {{ $value->nm_akun_aktif }}</option> @endforeach </select>";
    var posisi = "<select class='form-control select2' style='width:100%' name='posisi[]' required> @foreach($posisi as $key=> $value) <option value='{{ $key }}'> {{ $value }}</option> @endforeach </select>";
    var button="<button type='button' class='btn btn-warning' disabled>Ubah</button> <button type='button' class='btn btn-danger' disabled>Hapus</button>"
    $('#addRow').on( 'click', function () {
        t.row.add( [
            akun,
            posisi,
            button,
        ] ).draw( false );
        counter++;
    });

//    $('#example3').on('click','button', function () {
//        var data = t.row($(this).parents('tr')).data();
//    });

    $('#simpan').on('click', function () {
        $.ajax({
            url:"{{ url('store-transaksi-penerimaan') }}",
            type: "post",
            data: $('#form-penerimaan').serialize(),
            success:function (result) {
                table_transaksi.ajax.reload();
                t.clear().draw()
                $('[name="id_ket_transaksi"]').val("");
            }
        })
    })

    detail_keterangan = function (id) {
        $.ajax({
            url:"{{ url('detail-keterangan-transaksi') }}",
            type:'post',
            dataType:'json',
            data :{
                'id':id,
                '_token': '{{ csrf_token() }}'
            },
            success: function (result) {
                $('[name="nm_transaksi"]').val(result.keterangan);
                $('[name="id_ket_transaksi"]').val(id);
                t.clear().draw();
                t.rows.add(result.data).draw();
            }
        })
    }

    update_akun = function(id){
         $.ajax({
            url: "{{ url('update-transaksi-penerimaan') }}/"+id,
            type: 'post',
            data:{
                'nm_transaksi':$('[name="nm_transaksi"]').val(),
                'id_akun_aktif': $('#id_akun_aktif_'+id).val(),
                'posisi': $('#posisi_'+id).val(),
                '_method':'put',
                '_token': '{{ csrf_token() }}'
            },success:function (result) {
                alert('input data berhasil diupdate'+ result.message);
                 table_transaksi.ajax.reload();
            }
        })
    }

    hapus_akun = function(id){
        if(confirm('apakan anda akan menghapus akun ini .. ?')==true){
         $.ajax({
            url: "{{ url('delete-transaksi-penerimaan') }}/"+id,
            type: 'post',
            data:{
                '_method':'put',
                '_token': '{{ csrf_token() }}'
            },success:function (result) {
                 alert(result.message);
                 detail_keterangan(result.id);
            }
        })
        }else{
            alert('Proses diberhentikan');
        }
    }


   $('#id_transaksi').change(function () {
       var id_ket = $(this).val();
       $('[name="id_ket_transaksi"]').val(id_ket )
        $.ajax({
            url: '{{ url('data-keterangan-transaksi') }}/'+ id_ket ,
            dataType : 'json',
            success:function (result) {
                console.log(result);
                transaksi.clear().draw();
                transaksi.rows.add(result.data).draw();
            }
        })
   })


</script>