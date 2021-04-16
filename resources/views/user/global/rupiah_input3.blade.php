<script>
    var rupiah3 = document.getElementById("rupiah3");

    rupiah3.addEventListener("keyup", function(e) {
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah3.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah3 = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah3 += separator + ribuan.join(".");
      }

      rupiah3 = split[1] != undefined ? rupiah3 + "," + split[1] : rupiah3;
      return prefix == undefined ? rupiah3 : rupiah3 ? "Rp. " + rupiah3 : "";
    }

</script>
