<script>
    $('[name="id_kategori"]').change(function () {
        $.ajax({
            url: "{{ url('GlobalSubKategori') }}",
            type : "post",
           data : {
                'id_kategori': $(this).val(),
                '_token': '{{ csrf_token() }}'
            },
            success: function (result) {
                console.log(result);
                var option= "<option value='0'>pilih kategori jasa diatas terlebih dahulu</option> ";
                $.each(result.data, function (index, value) {
                    option +="<option value="+value.id+"> "+ value.nm_subkategori_produk+" </p>";
                });
                $('[name="id_subkategori_produk"]').html(option);
            }
        })
    })

    $('[name="id_subkategori_produk"]').change(function () {
        $.ajax({
            url: "{{ url('GlobalSubSubKategori') }}",
            type : "post",
            data : {
                'id_subkategori': $(this).val(),
                '_token': '{{ csrf_token() }}'
            },
            success: function (result) {
                console.log(result);
                var option= "<option value='0'>pilih sub kategori jasa diatas terlebih dahulu</option> ";
                $.each(result.data, function (index, value) {
                    option +="<option value="+value.id+"> "+ value.nm_subsub_kategori_produk+" </p>";
                });
                $('[name="id_subsubkategori_produk"]').html(option);
            }
        })
    })


</script>