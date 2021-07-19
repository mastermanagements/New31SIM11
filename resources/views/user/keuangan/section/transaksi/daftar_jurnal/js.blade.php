<script>
    var groupColumn = 0;


  var table=  $('#example_rincian').DataTable( {
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [0, 1],
            startRender: function ( rows, group ) {
                <!--return '<label>Tanggal :'+group+'</label>';-->
				return '<label>'+group+'</label>';
            }
        },

         "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 1 },
        ],
  } );

  var tabel = $('#example_rincians').DataTable({
      data :[],
      column:[
          {'data':'0'},
          {'data':'1'},
          {'data':'2'},
          {'data':'3'},
          {'data':'4'},
      ],
      {{--drawCallback: buttonBuild("{{ $thn_proses }}"),--}}
      filter: false,
      pagging : true,
      searching: false,
      info : true,
      ordering : false,
      processing : true,
      retrieve: true
  })

    edit_jurnal=function (id) {
        $('#modal-transaksi-jurnal').modal('show');
        $.ajax({
            url: '{{ url('edit-jurnal')  }}/'+id,
            dataType : "json",
            success: function(result){
                console.log(result.data.data);
                $('#debit_total').val(result.data.total_debet);
                $('#kredit_total').val(result.data.total_kredit);
                $('[name="tgl_jurnal"]').val(result.data.tanggal);
                $('[name="no_transaksi"]').val(result.data.nomor_transaksi);
                if(result.data.jenis_jurnal==0){
                    $('#radio_0').iCheck('check');
                }else if(result.data.jenis_jurnal==1){
                    $('#radio_1').iCheck('check');
                }else if(result.data.jenis_jurnal==2){
                    $('#radio_2').iCheck('check');
                }

               tabel.clear().draw();
               tabel.rows.add(result.data.data).draw();
            }
        })
    }

    delete_jurnal = function (no_transaksi) {
        if(confirm("Apakah anda akan menghapus jurnal ini, Semua yang terhubung pada jurnal ini akan terhapus ...?")==true){
            alert('alert');
            $.ajax({
                url: "{{ url('hapus-jurnal') }}",
                type: 'post',
                data:{
                    'no_transaksi': no_transaksi,
                    '_method':'put',
                    '_token':'{{ csrf_token() }}'
                },success: function (result) {
                    alert(result.message);
                }
            });
        }else{
            alert('Proses Hapus Dibatal ');
        }
    }

    $(document).on('change','.class_debit', function () {
        var sum=0;
        $('.class_debit').each(function () {
            sum+=+$(this).val();
        })
        $('#debit_total').val(sum)
    })

    $(document).on('change','.class_kredit', function () {
        var sum=0;
        $('.class_kredit').each(function () {
            sum+=+$(this).val();
        })
        $('#kredit_total').val(sum)
    })

    isValidForm = function () {
        var debit=$('#debit_total').val();
        var kredit=$('#kredit_total').val();

        if(debit==kredit){
            return true;
        }else{
            $('#notif').text("Debit dan Kredit harus Sama");
            return false;
        }
    }
</script>