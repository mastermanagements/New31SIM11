@extends('user.penggajian.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Daftar Tunjangan Karyawan {{ $data->nama_ky }}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-3">
                    <div class="col-md-12">
                          <h3>
                            Periode
                          </h3>
                    </div>
                    @if(!empty($data->getMannyTunjangan))
                        @php($x=1)
                        @foreach($data->getMannyTunjangan->groupBy('periode')->sortBy('periode') as $key => $value)
                          <form action="{{ url('detail-daftar-tunjangan/'. $data->id) }}">
                              <input type="hidden" name="year" value="{{ $key }}">
                              <div class="col-md-12" style="padding-bottom: 10px">
                                  <button  class="btn btn-lg @if($x++ % 2) btn-primary @else btn-danger @endif" style="margin: 0px;width: 100%; ">{{ $key }}</button>
                              </div>
                          </form>
                        @endforeach
                    @else
                      <div class="col-md-12">
                          <button class="btn btn-lg btn-primary" style="margin: 0px;width: 100%">Belum ada tunjangan</button>
                      </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Tunjangan</h3>
                            <div class="box-tools pull-right">
                               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-gaji" >Tambah Tunjangan</button>
                            <p></p>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Periode </th>
                                    <th>Nama Tunjagan</th>
                                    <th>Besar Tunjangan</th>
                                    <th>Status Tunjagan</th>
                                    <th>Status Slip</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @if(!empty($data->getMannyTunjangan))
                                    @if(!empty($year))
                                       @php($datayear= $data->getMannyTunjangan->where('periode', $year)->sortBy('periode'))
                                    @else
                                        @php($datayear= $data->getMannyTunjangan->sortBy('periode'))
                                    @endif
                                    @foreach($datayear as $data_tunjangan)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data_tunjangan->periode }}</td>
                                            <td>{{ $data_tunjangan->nm_tunjangan }}</td>
                                            <td>{{ number_format($data_tunjangan->besar_tunjangan,2,',','.') }}</td>
                                            <td>

                                                @if($data_tunjangan->status_tunjangan == 0)
                                                    <span class="badge bg-red" onclick="onStatus('{{ $data_tunjangan->id }}')">Off</span>
                                                @else
                                                    <span class="badge bg-green" onclick="offStatus('{{ $data_tunjangan->id }}')">On</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data_tunjangan->status_aktif == 0)
                                                    <span class="badge bg-red" onclick="onActifStatus('{{ $data_tunjangan->id }}')">Off</span>
                                                @else
                                                    <span class="badge bg-green" onclick="offActifStatus('{{ $data_tunjangan->id }}')">On</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('delete-daftar-tunjangan/'.$data_tunjangan->id) }}" method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    {{ csrf_field() }}
                                                    <button type="button" class="btn btn-warning" onclick="update('{{ $data_tunjangan->id }}')"><i class="fa fa-pencil"></i></button>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini...?')"><i class="fa fa-eraser"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>


    <div class="modal fade" id="modal-form-gaji">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Formulir Tambah Tunjangan Gaji</h4>
                </div>
                <form action="{{ url('tambah-daftar-tunganga-gaji') }}" method="post" id="formulir">
                    <input type="hidden" name="id_ky" value="{{ $data->id }}">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Periode</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker"  name="periode" required>
                            </div>
                            <!-- /.input group -->
                            <small style="color: red">* Tidak boleh kosong</small>
                        </div>
                        <div class="form-group">
                            <label>Nama Tunjangan</label>
                            <textarea class="form-control "  name="nm_tunjangan" ></textarea>
                            <!-- /.input group -->
                            <small style="color: red">* Tidak boleh kosong</small>
                        </div>
                        <div class="form-group">
                            <label>Besar Tunjangan</label>
                            <input type="number" class="form-control "  name="besar_tunjangan" required>
                            <!-- /.input group -->
                            <small style="color: red">* Tidak boleh kosong</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        $('[name="status"]').change(function () {
            alert('asda');
            $(this).trigger("sumbit")
        });


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

        onStatus = function (id) {
            if(confirm('Apakah anda akan mengahapus mengubah status data ini')== true){
                $.ajax({
                    url:"{{ url('change-status-tunjanganOn') }}/"+id,
                    type:"post",
                    data:{
                        '_token': "{{ csrf_token() }}",
                        '_method':"put"
                    },
                    success: function (result) {
                        window.location.reload();
                    }
                })
            }else{
                alert('Proses dibatalkan');
            }
        }

        onActifStatus = function (id) {
            if(confirm('Apakah anda akan mengahapus mengubah status data ini')== true){
                $.ajax({
                    url:"{{ url('change-status-aktif-tunjanganOn') }}/"+id,
                    type:"post",
                    data:{
                        '_token': "{{ csrf_token() }}",
                        '_method':"put"
                    },
                    success: function (result) {
                        window.location.reload();
                    }
                })
            }else{
                alert('Proses dibatalkan');
            }
        }

        offStatus = function (id) {
            if(confirm('Apakah anda akan mengahapus mengubah status data ini')== true){
                $.ajax({
                    url:"{{ url('change-status-tunjanganOff') }}/"+id,
                    type:"post",
                    data:{
                        '_token': "{{ csrf_token() }}",
                        '_method':"put"
                    },
                    success: function (result) {
                        window.location.reload();
                    }
                })
            }else{
                alert('Proses dibatalkan');
            }
        }

        offActifStatus = function (id) {
            if(confirm('Apakah anda akan mengahapus mengubah status data ini')== true){
                $.ajax({
                    url:"{{ url('change-status-aktif-tunjanganOff') }}/"+id,
                    type:"post",
                    data:{
                        '_token': "{{ csrf_token() }}",
                        '_method':"put"
                    },
                    success: function (result) {
                        window.location.reload();
                    }
                })
            }else{
                alert('Proses dibatalkan');
            }
        }

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-daftar-tunjangan') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="periode"]').val(result.periode);
                  $('[name="nm_tunjangan"]').val(result.nm_tunjangan);
                  $('[name="besar_tunjangan"]').val(result.besar_tunjangan);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-daftar-tunjangan') }}');
                  $('#modal-form-gaji').modal('show');
              }
          })
       }
    </script>
@stop