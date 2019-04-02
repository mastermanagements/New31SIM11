
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

            call_jenis_surat = function () {
                $.ajax({
                    url: '{{ url('tampilkan-jenis-barang') }}',
                    dataType : 'json',
                }).done(function (result) {
                    console.log(result);
                    table_jenis_surat.clear().draw();
                    table_jenis_surat.rows.add(result.data).draw();
                }).fail(function(jqXHR, textStatus,errorThrown){

                })
            }

            call_jenis_surat()

            ubahJenisBarang= function (id) {
                $.ajax({
                    url: '{{ url('tampilkan-jenis-barang') }}/'+id,
                    dataType : 'json',
                    success : function (result) {
                        $('[name="jenis_surat_keluar_ubah"]').val(result.data.jenis_surat_keluar)
                        $('[name="id"]').val(result.data.id)
                        $('#modal-ubah-jenis-surat').modal('show')
                    }
                })
            }

            hapusJenisBarang= function (id) {
                if(confirm('Apakah anda yakin akan menghapus data ini ...?') == true){
                    $.ajax({
                        url: '{{ url('hapus-jenis-barang') }}/'+id,
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
