

    <script>

        $(function () {
            $('.select2').select2()
        });

        //iCheck for checkbox and radio inputs
        $('input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        });


        $(document).ready(function () {
            $('#buttonEditPendidikan').click(function () {
                $.ajax({
                    url : '{{ url('getDataPendidikan') }}',
                    dataType : 'json',
                    success: function (result) {
                        $('[name="pend_akhir"]').val(result.data.pend_akhir);
                        $('[name="program_studi"]').val(result.data.program_studi);
                        $('[name="pt"]').val(result.data.pt);
                        $('#modal-ubah-pendidikan').modal('show');
                    }
                })
            });

            $('#submitPendidikan').click(function () {
                $.ajax({
                    url  : '{{ url('proses-pendidikan') }}',
                    type : 'post',
                    data : {
                        '_token' : '{{ csrf_token() }}',
                        'pend_akhir' : $('[name="pend_akhir"]').val(),
                        'program_studi' : $('[name="program_studi"]').val(),
                        'pt' : $('[name="pt"]').val(),
                    },
                    success: function (result) {
                        window.location.reload()
                    }
                })
            });

            $('[name="id_provinsi"]').change(function () {
                $.ajax({
                    url:"{{ url('GlobalKabupaten') }}/" + $(this).val(),
                    dataType: "json",
                    success: function (result) {
                        var option="<option>Pilih Kabupaten</option>";
                        $.each(result, function (id, val) {
                            option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
                        });
                        $('[name="id_kabupaten"]').html(option);
                    }
                })
            });

            $('#buttonEditAlamat').click(function () {
                $.ajax({
                    url : '{{ url('getDataAlamatAsal') }}',
                    dataType : 'json',
                    success: function (result) {
                        console.log(result);
                         $('[name="alamat_asal"]').val(result.data.alamat_asal);
                         $('[name="id_provinsi"]').val(result.data.id_prov).trigger('selected');
                         $('[name="id_kabupaten"]').val(result.data.id_kab);
                         $('#modal-ubah-alamat-asal').modal('show');
                    },
                    error: function () {
                        $('#modal-ubah-alamat-asal').modal('show');
                    }
                })
            });

            $('#submitAlamatAsal').click(function () {
                $.ajax({
                   url : '{{ url('store-alamat-asal') }}',
                   type : 'post',
                   data : {
                       '_token' : '{{ csrf_token() }}',
                       'alamat_asal': $('[name="alamat_asal"]').val(),
                       'id_prov' :   $('[name="id_provinsi"]').val(),
                       'id_kab' :   $('[name="id_kabupaten"]').val(),
                   },
                    success : function (result) {
                       console.log(result);
                       window.location.reload();
                    }
                });
            });

            $('#buttonEditAlamatSek').click(function () {
                $.ajax({
                    url : '{{ url('getDataAlamatSek') }}',
                    dataType : 'json',
                    success: function (result) {
                        console.log(result);
                        $('[name="alamat_sek"]').val(result.data.alamat_asal);
                        $('[name="id_prov_sek"]').val(result.data.id_prov).trigger('selected');
                        $('[name="id_kab_sek"]').val(result.data.id_kab);
                        $('#modal-ubah-alamat-sek').modal('show');
                    },
                    error: function () {
                        $('#modal-ubah-alamat-sek').modal('show');
                    }
                })
            });

            $('[name="id_prov_sek"]').change(function () {
                $.ajax({
                    url:"{{ url('GlobalKabupaten') }}/" + $(this).val(),
                    dataType: "json",
                    success: function (result) {
                        var option="<option>Pilih Kabupaten</option>";
                        $.each(result, function (id, val) {
                            option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
                        });
                        $('[name="id_kab_sek"]').html(option);
                    }
                })
            });

            $('#submitAlamatSek').click(function () {
                $.ajax({
                    url : '{{ url('store-alamat-sek') }}',
                    type : 'post',
                    data : {
                        '_token' : '{{ csrf_token() }}',
                        'alamat_asal': $('[name="alamat_sek"]').val(),
                        'id_prov' :   $('[name="id_prov_sek"]').val(),
                        'id_kab' :   $('[name="id_kab_sek"]').val(),
                    },
                    success : function (result) {
                        console.log(result);
                        window.location.reload();
                    }
                });
            });

        });
    </script>
