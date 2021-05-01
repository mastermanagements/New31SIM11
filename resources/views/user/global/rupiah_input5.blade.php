<script>
    var rupiah5 = document.getElementById("rupiah5");

    rupiah5.addEventListener("keyup", function(e) {
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah5.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah5 = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah5 += separator + ribuan.join(".");
      }

      rupiah5 = split[1] != undefined ? rupiah5 + "," + split[1] : rupiah5;
      return prefix == undefined ? rupiah5 : rupiah5 ? "Rp. " + rupiah5 : "";
    }

</script>
