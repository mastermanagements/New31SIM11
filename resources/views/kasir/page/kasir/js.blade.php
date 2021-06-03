@section('js')
    <script>
        var container = [];
        var total_awal = 0;

        render_table = function () {
            var html = "";
            var no = 1;
            total_awal = 0;
            $('#daftar_table_pesanan tbody').empty(html);
            $.each(container, function (index, value) {
                html += "<tr>";
                html += "<td>" + (no++) + "</td>";
                html += "<td><input type='hidden' name='id_barang[]' value='" + value[0] + "'>" + value[1] + "</td>";
                html += "<td><input type='hidden' name='jumlah_jual[]' value='" + value[2] + "'>" + value[3] + "</td>";
                html += "<td><input type='hidden' name='harga_satuan[]' value='" + value[3] + "'>" + value[2] + "</td>";
                html += "<td><input type='hidden' name='sub_total[]' value='" + (value[2] * value[3]) + "'>" + (value[2] * value[3]) + "</td>";
                html += "<td><button class='btn btn-sm btn-danger' onclick='delete_item(" + index + ")'>hapus</button></td>";
                html += "</tr>";
                total_awal += (value[2] * value[3]);
            });
            $('#total_akhir').text("Total Rp: " + total_awal);
            $('#total_penjualan').val(total_awal);
            $('#daftar_table_pesanan').append(html);
        }

        $('#bayar').keyup(function () {
            var bayar = $(this).val();
            $('#total_bayar').text('Bayar Rp:' + bayar);
            var kembalian = Math.abs((bayar - total_awal));
            if (kembalian > bayar) {
                console.log(kembalian);
            }
            $('#total_kembalian').text("Kembalian Rp: " + kembalian);
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


        cek_barang = function (id_nota) {
            var html = "";
            $('#detail_tabel_modal tbody').empty(html);
            $('#belanja_total').text('asasd');
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
                    total_bayar = result.nota.bayar;
                    $.each(result.detail_barang, function (i, v) {
                        html += "<tr>";
                        html += "<td>" + v[0] + "</td>";
                        html += "<td>" + v[1] + "</td>";
                        html += "<td>" + v[2] + "</td>";
                        html += "<td>" + v[3] + "</td>";
                        html += "<td>" + v[4] + "</td>";
                        html += "</tr>";
                        total_belanja += parseInt(v[4]);
                    });
                    $('#detail_tabel_modal').append(html);
                    $('#modal-detail-barang').modal({backdrop: 'static',});
                    $('#belanja_total').text("Total Belanja :" + total_belanja);
                    $('#modal_total_bayar').text("Total Bayar :" + total_bayar);
                    var n_kembalian = Math.abs(total_belanja - total_bayar);
                    $('#kembalian').text("Kembalian :" + n_kembalian);
                },
                error(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }
            })
        }
    </script>
@stop