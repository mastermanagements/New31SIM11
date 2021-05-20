<script>
    calculate_total = function(){
        var harga_beli = $('[name="hpp"]').val();
        var jumlah_jual = $('[name="jumlah_jual"]').val();
        var diskon_item = $('[name="diskon_item"]').val();
        var total;
        total = harga_beli.split('.').join('') * jumlah_jual;

        //diskon
        if(diskon_item != 0 ){
            var diskon = total * (diskon_item/100);
            total = total - diskon;
        }

        $('#jumlah_harga').val(formatRupiah(total.toString()));
    }
</script>