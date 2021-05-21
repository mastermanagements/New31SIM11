<script>
    calculate_jumlah  = function(){
        var n_diskon = 0;
        var dis_total = 0;
        if(diskon !=0){
            n_diskon = diskon/100;
        }
        var jumlah_total =0;
        var sub_total =0;
        sub_total = (harga_beli.split('.').join('') * jumlah_beli);
        dis_total = sub_total * n_diskon;
        jumlah_total = sub_total - dis_total;

        $('[name="jumlah_total"]').val(formatRupiah(jumlah_total.toString()));
    }
</script>