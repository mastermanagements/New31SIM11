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
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-data-investasi">Tambah data Investasi</button>
                            <p></p>
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
                                    <th>Persentase</th>
                                     <th></th>
                                     <th></th>
                                </tr>
                                </thead>
                                <tbody>
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
                                            <th >{{ $value->persentase }}</th>
                                            <th></th>
                                            <td>
                                                <form action="{{ url('hapus-bentuk-investasi/'.$value->id) }}" method="post">
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
    @include('user.investor.section.dataInvestasi.modal.modal')
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
              url: "{{ url('edit-daftar-investasi') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="id_bentuk_invest"]').attr('disabled',false);
                  $('[name="tgl_invest"]').val(result.tgl_invest);
                  $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                  $('[name="id_investor"]').val(result.id_investor).trigger('change');
                  $('[name="jumlah_saham"]').val(result.jumlah_saham);
                  $('[name="id_bentuk_invest"]').val(result.id_bentuk_invest).trigger('change');
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-daftar-investasi') }}');
                  $('#modal-data-investasi').modal('show');
              }
          })
       }
    </script>
@stop