<script>

    $(document).ready(function () {

        var tgl_tes, id_pel, id_tes, hasil;
        $.each($('.eventDate'), function (index, value) {
            $(this).attr('id','datepicker'+index)
            $('#datepicker'+index).datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $(this).change(function () {
                tgl_tes = $(this).val();
                id_pel = $('#id_oel'+index).val();
            });

            $('#idTes'+index).change(function () {
                id_tes = $(this).val();
            });

            $('#hasil'+index).change(function () {
                hasil = $(this).val()
            })
        });

        simpan=function(i, key){
            reload(key);
             if(tgl_tes==undefined){
                alert("Tanggal tidak boleh kosong");
            }else if(id_tes==undefined){
                alert("Jenis Tes tidak boleh kosong");
            }else{
                $.ajax({
                    url: '{{ url('simpan-psikotes') }}',
                    type: 'post',
                    data: {
                        'tgl_tes':tgl_tes,
                        'id_lamaran_p': i,
                        'id_jenis_psikotes': id_tes,
                        'nilai_akhir': hasil,
                        '_token': '{{ csrf_token() }}'
                    }, success: function (result) {
                        unreaload(key);
                        alert(result.message);
                    }
                })
            }
        }

        reload=function(key){
            $("#loading"+key).attr('class', 'fa fa-refresh fa-spin');
        }

        unreaload=function(key){
            $('#loading'+key).attr('class', 'fa fa-save')
        }

        inforPelamar = function (id) {
            $.ajax({
                url: '{{ url('lihat-keterangan') }}/'+id,
                dataType: 'json',
                success: function (result) {
                    if(isEmpty(result.ket)){
                        var data = "<p> Informasi belum dimasukan </p>"
                    }else{
                        var data = result.ket;
                    }
                    $('#contents').html(data);
                    $('#modal-lihat-keterangan').modal('show');
                }
            })
        }

        function isEmpty(obj) {
            for(var key in obj) {
                if(obj.hasOwnProperty(key))
                    return false;
            }
            return true;
        }


        $('.ubah-saat-diklik').click(function () {
            var $text = $(this), $input=$('<input type="text" class="form-control dateMul" name="tgl_tes[]">')
            $text.show();

            $text.hide().after($input);

        })



    })
</script>