
    <script>

       // $('#example4').DataTable()

        $(function () {
            $('.select2').select2()
        });


        $(document).ready(function () {
            table_jenis_proposal = $('#example4').DataTable({
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

            call_jenis_proposal = function () {
                $.ajax({
                    url: '{{ url('jenis-proposal') }}',
                    dataType : 'json',
                }).done(function (result) {
                    console.log(result);
                    table_jenis_proposal.clear().draw();
                    table_jenis_proposal.rows.add(result.data).draw();
                }).fail(function(jqXHR, textStatus,errorThrown){

                })
            }

            call_jenis_proposal()

            UbahJenisProposal= function (id) {
                $.ajax({
                    url: '{{ url('jenis-proposal') }}/'+id,
                    dataType : 'json',
                    success : function (result) {
                        $('[name="jenis_proposal_ubah"]').val(result.jenis_proposal)
                        $('[name="id"]').val(result.id)
                        $('#modal-ubah-jenis-proposal').modal('show')
                    }
                })
            }

            HapusJenisProposal= function (id) {
                if(confirm('Apakah anda yakin akan menghapus data ini ...?') == true){
                    $.ajax({
                        url: '{{ url('delete-jenis-proposal')}} ',
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
