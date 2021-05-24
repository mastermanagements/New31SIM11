
@section('js')
<script>
    var container=[];
    var total_awal = 0;

    render_table = function(){
        var html ="";
        var no=1;
        total_awal = 0;
        $('#daftar_table_pesanan tbody').empty(html);
        $.each(container,function (index, value) {
            html+="<tr>";
            html+="<td>"+(no++)+"</td>";
            html+="<td><input type='hidden' name='id_barang[]' value='"+value[0]+"'>"+value[1]+"</td>";
            html+="<td><input type='hidden' name='jumlah_jual[]' value='"+value[2]+"'>"+value[2]+"</td>";
            html+="<td><input type='hidden' name='harga_satuan[]' value='"+value[3]+"'>"+value[3]+"</td>";
            html+="<td><input type='hidden' name='sub_total[]' value='"+(value[2]*value[3])+"'>"+(value[2]*value[3])+"</td>";
            html+="<td><button class='btn btn-sm btn-danger' onclick='delete_item("+index+")'>hapus</button></td>";
            html+="</tr>";
            total_awal += (value[2]*value[3]);
        });
        $('#total_akhir').text("Total Rp: "+total_awal);
        $('#daftar_table_pesanan').append(html);
    }

    $('#bayar').keyup(function(){
        var bayar = $(this).val();
        $('#total_bayar').text('Bayar Rp:'+ bayar);
        var kembalian = Math.abs((bayar-total_awal));
        if(kembalian > bayar){
            console.log(kembalian);
        }
        $('#total_kembalian').text("Kembalian Rp: "+kembalian);
    });

    $('#tombol_tambah').click(function(){
        var id_barang = $('#barang').val();
        var nama_barang = $( "#barang option:selected" ).text();;
        var hpp = $('#hpp').val();
        var jumlah = $('#jumlah').val();

        var item = [id_barang,nama_barang, hpp, jumlah];
        container.push(item);
        render_table();
    });

    delete_item = function(i){
            container.splice(i, 1);
            render_table();
    }

    $('#input_code_barcode').keyup(function(){
       var code_barcode =$(this).val();
       console.log(code_barcode);
       if(code_barcode == '1234567'){
           $('#modal-default').modal('show');
       }
    });

</script>
@stop