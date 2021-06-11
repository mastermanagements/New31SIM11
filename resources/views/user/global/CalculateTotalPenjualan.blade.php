<script>
    calculate_total = function () {
        var harga_beli = $('[name="hpp"]').val();
        var jumlah_jual = $('[name="jumlah_jual"]').val();
        var diskon_item = $('[name="diskon_item"]').val();
        var total;
        total = harga_beli.split('.').join('') * jumlah_jual;

        //diskon
        if (diskon_item != 0) {
            var diskon = total * (diskon_item / 100);
            total = total - diskon;
        }

        $('#jumlah_harga').val(formatRupiah(total.toString()));
    }

    $('[name="pajak"]').keyup(function () {
         calculateJumlahBayar();
    });
    
    calculateJumlahBayar = function () {
        var sub_total = parseInt($('#sub_total').val());
        var pajak_field = parseInt($('[name="pajak"]').val());
        var diskon_tambahan_field = parseInt($('[name="diskon_tambahan"]').val());
        var ongkir_field = parseInt($('[name="ongkir"]').val());

        var pajak =0;
        var total_bayar=0;
        if(pajak_field !=0){
            pajak = sub_total * (pajak_field/100);
        }

        total_bayar = (sub_total + pajak + ongkir_field)-diskon_tambahan_field;
        $('[name="bayar"]').val(formatRupiah(total_bayar.toString()));
    }
</script>