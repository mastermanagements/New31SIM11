
    <script>

        $('#example4').DataTable()

        $(function () {
            $('.select2').select2()
        });


        $(document).ready(function () {
            table_jenis_surat = $('#example4').DataTable({
                data:[],
                column:[
                    {'data' :'0'},
                    {'data' :'1'},
                    {'data' :'2'},
                ],
                rowCallback : function(row, data){

                },
                filter: false,
                pagging : true,
                searching: true,
                info : true,
                ordering : true,
                processing : true,
                retrieve: true
            });

            UbahJenisArsip= function (id) {
                $.ajax({
                    url: '{{ url('ambil-jenis-arsip') }}/'+id,
                    dataType : 'json',
                    success : function (result) {
                        $('[name="jenis_arsip_ubah"]').val(result.data.jenis_arsip)
                        $('[name="id"]').val(result.data.id)
                        $('#modal-ubah-jenis-arsip').modal('show')
                    }
                })
            }

            HapusJenisArsip= function (id) {
                if(confirm('Apakah anda yakin akan menghapus data ini ...?') == true){
                    $.ajax({
                        url: '{{ url('hapus-jenis-arsip')}} ',
                        type : 'post',
                        data : {
                            '_token' : '{{ csrf_token() }}',
                            'id' : id
                        },
                        success : function (result) {
                           window.location.reload()
                        }
                    })
                }else
                    {
                        alert('proses hapus dibatalkan')
                    }
            }
        });

    </script>
