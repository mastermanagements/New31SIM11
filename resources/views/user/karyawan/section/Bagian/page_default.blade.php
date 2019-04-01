@extends('user.karyawan.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bagian Perusahaan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <button type="button" data-toggle="modal" data-target="#modal-tambah-bagian" class="btn btn-primary"><i class="fa fa-plus"></i> Masukan Bagian Perusahaan</button>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Bagian Perusahaan</h3>
                            </div>

                            <div class="box-body">
                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bagian Perusahaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
    </section>
    <!-- /.content -->
</div>
    @include('user.karyawan.section.Bagian.include.modal')
@stop

@section('plugins')
    <script>
        $(document).ready(function () {
            var ids;
            var table_bagian = $('#example1').DataTable({
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

            call_data = function () {
                $.ajax({
                    url: '{{ url('dataBagian') }}',
                    dataType : 'json',
                }).done(function (result) {
                    table_bagian.clear().draw();
                    table_bagian.rows.add(result.data).draw();
                }).fail(function(jqXHR, textStatus,errorThrown){

                })
            };

            call_data();

            $('#submitBagian').click(function () {

                if($('[name="nm_bagian"]').val()==""){
                    $('#notify').text("*Tidak Boleh Kosong")
                }else{
                    $.ajax({
                        url: "{{ url('store-bagian') }}",
                        type: "post",
                        data : {
                            'nm_bagian': $('[name="nm_bagian"]').val(),
                            '_token': '{{ csrf_token() }}',
                        },
                        success:function (result) {
                            call_data();
                            $("#modal-tambah-bagian").modal('hide')
                        }
                    })
                }
            });

            edits = function(id)
            {
                $.ajax({
                   url : "{{ url('dataBagian') }}/"+id,
                   dataType: "json",
                   success: function (result) {
                       $('[name="nm_bagian_ubah"]').val(result.bagian.nm_bagian);
                       ids = result.bagian.id;
                       $('#modal-ubah-bagian').modal('show');
                   }
                });
            };
            
            $('#submitUbahBagian').click(function () {
                 $.ajax({
                    url: "{{ url('update-bagian') }}",
                    type: "post",
                    data : {
                        'nm_bagian': $('[name="nm_bagian_ubah"]').val(),
                        'id' : ids,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (result) {
                        call_data();
                        $('#modal-ubah-bagian').modal('hide');
                        alert(result.message);
                    }
                })
            });

            deletes = function(id)
            {
                if(confirm('Apakah anda mehapus bagian ini, ini akan berdampak pada data defisi yang berhubungan dengan data ini ... ?')== true){
                    $.ajax({
                        url : "{{ url('hapus-bagian') }}/"+id,
                        type: "post",
                        data :{
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (result) {
                            call_data();
                            alert(result.message);
                        }
                    });
                }else{
                    alert('Bagian ini tidak jadi dihapus');
                }
            }
        })
    </script>
@stop