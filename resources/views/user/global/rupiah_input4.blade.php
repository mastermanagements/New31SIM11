<script>
    var rupiah4 = document.getElementById("rupiah4");

    rupiah4.addEventListener("keyup", function(e) {
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah4.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah4 = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah4 += separator + ribuan.join(".");
      }

      rupiah4 = split[1] != undefined ? rupiah4 + "," + split[1] : rupiah4;
      return prefix == undefined ? rupiah4 : rupiah4 ? "Rp. " + rupiah4 : "";
    }

</script>
