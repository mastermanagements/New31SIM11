@section('js')
    <script>
        var container = [];
        var total_awal = 0;
        var total_kembalian =0;

        render_table = function () {
            var html = "";
            var no = 1;
            total_awal = 0;
            $('#daftar_table_pesanan tbody').empty(html);
            $.each(container, function (index, value) {
                console.log(value[3]);
                var harga_satuan = value[3].replaceAll('.00','');
                html += "<tr>";
                html += "<td>" + (no++) + "</td>";
                html += "<td><input type='hidden' name='id_barang[]' value='" + value[0] + "'>" + value[1] + "</td>";
                html += "<td><input type='hidden' name='jumlah_jual[]' value='" + value[2] + "'>" + value[2] + "</td>";
                html += "<td><input type='hidden' name='harga_satuan[]' value='" + value[3] + "'>" + formatRupiah(harga_satuan.toString()) + "</td>";
                var total = value[2] * value[3];
                html += "<td><input type='hidden' name='sub_total[]' value='" + (value[2] * value[3]) + "'>" + formatRupiah(total.toString()) + "</td>";
                html += "<td><button class='btn btn-sm btn-danger' onclick='delete_item(" + index + ")'>hapus</button></td>";
                html += "</tr>";
                total_awal += (value[2] * value[3]);
            });
            $('#total_akhir').text("Total Rp: " + formatRupiah(total_awal.toString()));
            $('#total_penjualan').val(total_awal);
            $('#daftar_table_pesanan').append(html);
        }

        reset_barang = function () {
            container=[];
            render_table();
        }

        $('#bayar').keyup(function () {
            var bayar = $(this).val().replaceAll('.','');
            $('#total_bayar').text('Bayar Rp:' + formatRupiah(bayar.toString()));
            var kembalian = (bayar - total_awal);
            console.log(kembalian);
//            if (kembalian > bayar) {
//                console.log(kembalian);
//            }
            var n_format = kembalian;
            total_kembalian = n_format;
            $('#total_kembalian').text("Kembalian Rp: " + formatRupiah(n_format.toString()));
            cek_bayar();
        });

        $('#tombol_tambah').click(function () {
            var id_barang = $('#barang').val();
            var nama_barang = $("#barang option:selected").text();
            var hpp = $('#hpp').val();
            var jumlah = $('#jumlah').val();

            var item = [id_barang, nama_barang, jumlah, hpp];
            container.push(item);
            render_table();
        });

        delete_item = function (i) {
            container.splice(i, 1);
            render_table();
        }

        $('#input_code_barcode').keyup(function () {
            var code_barcode = $(this).val();
            console.log(code_barcode);
            $.ajax({
                url: '{{ url('filter-barang-by-barcode') }}/'+code_barcode,
                dataType: 'json',
                type: 'get',
                success: function (result) {
                    if (result.data !=null) {
                        $('#barang').val(result.data.id).trigger('change')
                        $('#modal-default').modal('show');
                    }
                }
            });
        });

        $('#barang').change(function () {
            getHarga();
        })

        $('#jumlah').keyup(function () {
            getHarga();
        });
        getHarga = function () {
            $.ajax({
                url: '{{ url('response_json') }}/' + $('#barang').val(),
                dataType: 'json',
                type: 'post',
                data: $('#form-pesanan').serialize(),
                success: function (result) {
                    $('#hpp').val(result.hpp);
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }
            })
        }

        cek_bayar= function(){
            if(total_kembalian < 0){
                $('#notif_bayar').text('Bayar Kurang');
                $('#btn_proses').attr('disabled', true);
            }else{
                $('#notif_bayar').text('');
                $('#btn_proses').attr('disabled', false);
            }
        }

        cek_barang = function (id_nota) {
            var html = "";
            $('#detail_tabel_modal tbody').empty(html);
            $('#belanja_total').text('');
            $('#modal_total_bayar').text('');
            $('#kembalian').text('');
            var total_belanja = 0;
            var total_bayar = 0;
            var kebalian = 0;
            $.ajax({
                url: '{{ url('Kasir') }}/' + id_nota,
                type: 'get',
                success: function (result) {
                    console.log(result);
                    total_bayar = result.nota.bayar.replaceAll('.00','');
                    $.each(result.detail_barang, function (i, v) {
                        html += "<tr>";
                        html += "<td>" + v[0] + "</td>";
                        html += "<td>" + v[1] + "</td>";
                        html += "<td>" + v[2] + "</td>";
                        html += "<td>" + formatRupiah(v[3].toString()) + "</td>";
                        html += "<td>" + formatRupiah(v[4].toString()) + "</td>";
                        html += "</tr>";
                        total_belanja += parseInt(v[4]);
                    });
                    $('#detail_tabel_modal').append(html);
                    $('#modal-detail-barang').modal({backdrop: 'static',});
                    $('#belanja_total').text("Total Belanja :" + formatRupiah(total_belanja.toString()));
                    $('#modal_total_bayar').text("Total Bayar :" + formatRupiah(total_bayar.toString()));
                    var n_kembalian = Math.abs(total_belanja - total_bayar);
                    $('#kembalian').text("Kembalian :" + formatRupiah(n_kembalian.toString()));
                },
                error(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }
            })
        }
    </script>
@stop