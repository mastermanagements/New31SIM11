@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Investasi
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                @if(!empty(session('message_success')))
                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                @endif
                <p></p>
                <div class="col-md-12">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Data Investasi</h3>
                            <div class="box-tools pull-right">
                               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="overflow: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal </th>
                                    <th>Periode </th>
                                    <th>Nama Investor</th>
                                    <th>Jumlah Investasi</th>
                                    <th>Jumlah Saham</th>
                                    <th>Satuan</th>
                                    <th>Bentuk Investasi</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <form action="{{ url('store-investasi') }}" method="post">
                                        <th>#</th>
                                        <th>
                                            <input type="text" class="form-control pull-right" id="datepicker"  name="tgl_invest" required>
                                        </th>
                                        <th>
                                            <select class="form-control select2" style="width: 100%;" name="id_periode_invest" required>
                                                @if(empty($periode_inves))
                                                    <option>Periode Investasi Masih Kosong</option>
                                                @else
                                                    @foreach($periode_inves as $value)
                                                        <option value="{{ $value->id }}">{{ str_limit($value->nm_periode,40) }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </th>
                                        <th>
                                            <select class="form-control select2" style="width: 100%;" name="id_investor" required>
                                                @if(empty($data_investor))
                                                    <option>Investor Masih Kosong</option>
                                                @else
                                                    @foreach($data_investor as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nm_investor }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </th>
                                        <th></th>
                                        <th><input type="number" name="jumlah_saham" class="form-control" required></th>
                                        <th>Satuan</th>
                                        <th>
                                            <select class="form-control select2" style="width: 100%;" name="id_bentuk_invest" required>
                                                @if(empty($bentuk_investor))
                                                    <option>Bentuk Investasi</option>
                                                @else
                                                    @foreach($bentuk_investor as $value)
                                                        <option value="{{ $value->id }}">{{ $value->bentuk_investasi }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </th>
                                        <th>
                                            {{ csrf_field()}}
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </th>
                                        </form>
                                    </tr>
                                    @php($i=1)
                                    @foreach($data_investasi as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <th>{{ date('d-m-Y', strtotime($value->tgl_invest)) }} </th>
                                            <th>{{ $value->periode_invest->nm_periode }}</th>
                                            <th>{{ $value->investor->nm_investor }}</th>
                                            <th>{{ $value->jumlah_investasi }}</th>
                                            <th>{{ $value->jumlah_saham }}</th>
                                            <th>Lembar</th>
                                            <th>{{ $value->bentuk_investasi->bentuk_investasi }}</th>
                                            <td>
                                                <form action="{{ url('hapus-bentuk-investor/'.$value->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="put">
                                                    <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update('{{ $value->id }}')" >Ubah</button>
                                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda akan menghapus data ini...?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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

@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

        $(function () {
            $('.select2').select2()
        });


        update=function (id) {
          $.ajax({
              url: "{{ url('edit-bentuk-investor') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="bentuk_investasi"]').val(result.bentuk_investasi);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-bentuk-investor') }}');
              }
          })
       }
    </script>
@stop