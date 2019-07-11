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
              Skor Content Compansable Factors
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-sm-12" style="padding-bottom: 10px">
                    <div class="row">
                        <div class="col-sm-2" style="margin-right:10px ">
                            <a href="{{ url('Pokok-cf') }}" class="btn btn-primary">Pokok Compansable Factors</a>
                        </div>
                        <div class="col-sm-5">
                            <a href="{{ url('item-cf') }}" class="btn btn-success">Item Content CF</a>
                            <a href="{{ url('stok-total-compensable-factor') }}" class="btn btn-danger">Stok Total Compensable Factors</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tabel Skor Total Per Posisi Berdasarkan Compensable Faktors</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th rowspan="2">NO</th>
                                        <th rowspan="2">Posisi</th>
                                        @php($table_item="")
                                        @php($table_input_item="")
                                        @if(!empty($cf))
                                            @foreach($cf as $CF)
                                            <th colspan="@if(!empty($CF->sub_cf)) {{ $CF->sub_cf->count('id') }} @endif">{{ $CF->faktor }}</th>
                                                @if($CF->sub_cf->count('id')<=0)
                                                    @php($table_item .="<td style='color:red'>Anda belum mengisi sub cf</td>")
                                                    @php($table_input_item .="<td style='color:red'>input box tidak tersedia</td>")
                                                @else
                                                    @foreach($CF->sub_cf as $sub_cf)
                                                        @php($skor=0)
                                                        @if(!empty($sub_cf))
                                                            @php($table_item .="<td>".$sub_cf->sub_faktor."</td>")
                                                            @php($table_input_item .="<td><input type='hidden'  name='id_sub_cf[]' value=".$sub_cf->id."> <input type='number'  min='0' name='skor_sub_cf[]' class='form-control idsub_".$sub_cf->id."'></td>")
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @else
                                            <th colspan="3">Anda belum mengisi compesable factor</th>
                                        @endif
                                        <th rowspan="2">Total</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        {!! $table_item !!}
                                    </tr>
                                    @php($no=1)
                                    @foreach($jabatan as $jabatan)
                                        <form action="{{ url('store-skore-ccf') }}" method="post">
                                            <tr id="{{ $jabatan->id }}" class="jabatan">
                                                <th>{{ $no++ }}</th>
                                                <td>{{ $jabatan->nm_jabatan }}</td>
                                                {!! $table_input_item !!}
                                                <td>belakangan di kerja</td>
                                                {{ csrf_field() }}
                                                <td><button type="submit" class="btn btn-success" name="id_jabatan" value="{{ $jabatan->id }}">Simpan</button></td>
                                            </tr>
                                        </form>
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

    @include("user.penggajian.section.SubCompansableFactors.modal.modal")
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

        setIDCF= function(id){
            $('[name="id_cf"]').val(id);
            $('#modal-subcf').modal('show');
        }

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-sub-cf') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="sub_faktor"]').val(result.sub_faktor);
                  $('[name="definisi"]').val(result.definisi);
                  $('[name="bobot_subcf"]').val(result.bobot_subcf);
                  $('[name="id"]').val(result.id);
                  $('[name="id_cf"]').val(result.id_cf);
                  $('#formulir').attr('action', '{{ url('update-sub-cf') }}');
                  $('#modal-subcf').modal('show');
              }
          })
       }
    </script>
@stop