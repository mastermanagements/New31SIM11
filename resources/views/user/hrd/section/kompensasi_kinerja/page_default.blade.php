@extends('user.hrd.master_user')

@section('skin')
   <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kompensasi Kinerja
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulir Predikat Penilaian</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <form action="{{ url('store-predikat-penilaian') }}" method="post" id="formulir">
                            <div class="box-body" style="">
                                    <input type="hidden" name="id">
                                    <div class="input-group">
                                        <label>Skor Awal</label>
                                        <input type="number" class="form-control" name="skor_awal" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="input-group">
                                        <label>Skor Akhir</label>
                                        <input type="number" class="form-control" name="skor_akhir" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="input-group">
                                        <label>Predikat</label>
                                        <input type="text" class="form-control" name="predikat" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="input-group">
                                        <label>Kenaikan</label>
                                        <input type="number" class="form-control" name="kenaikan" required>
                                        <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                                    <div class="input-group">
                                            <label>Fasilitas Umum</label>
                                            <textarea class="form-control" placeholder="Fasilitas lain" name="fasilitas_lain" ></textarea>
                                            <small style="color: red"> * Tidak Boleh Kosong </small>
                                    </div>
                            </div>
                            <div class="box-footer">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <!-- /.box-body -->
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Predikat Penilaian</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Skor Awal</th>
                                    <th>Skor Akhir</th>
                                    <th>Predikat</th>
                                    <th>Kenaikan</th>
                                    <th>Fasilitas</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($predikat as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->skor_awal }}</td>
                                        <td>{{ $value->skor_akhir }}</td>
                                        <td>{{ $value->predikat }}</td>
                                        <td>{{ $value->kenaikan }}</td>
                                        <td>{{ $value->fasilitas_lain }}</td>
                                        <td>
                                            <form action="{{ url('delete-predikat-penilaian/'.$value->id) }}" method="post">
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
                <div class="col-md-12">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kompensasi Kinerja</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <div class="form-group">
                                <label>Tahun</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker1"  name="tahun" required>
                                </div>
                                <!-- /.input group -->
                                <small style="color: red">* Tidak boleh kosong</small>
                            </div>

                            <table id="predikat_penilaian" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tahun</th>
                                    <th>Nama Karyawan</th>
                                    <th>Skor Kinerja</th>
                                    <th>Predikat</th>
                                    <th>Kenaikan Gaji</th>
                                    <th>Fasilitas</th>
                                </tr>
                                </thead>
                                <tbody>

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
    @include('user.hrd.section.loker.include.modal')
@stop

@section('plugins')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        //Date picker
        $('#datepicker1').datepicker({
            autoclose: true,
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        $(document).ready(function () {
            var year = new Date();
            $('#predikat_penilaian').dataTable({
                ajax:  {
                    url: "{{ url('kompensasi_kinerja_data') }}/"+year.getFullYear(),
                }
            });

            table_predikat = $('#predikat_penilaian').DataTable({
                data:[],
                column:[
                    {'data' :'0'},
                    {'data' :'1'},
                    {'data' :'2'},
                    {'data' :'3'},
                    {'data' :'4'},
                    {'data' :'5'},
                    {'data' :'6'},
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


            $('[name="tahun"]').change(function () {
                var year = $(this).val();
                $.ajax({
                    url: '{{url('kompensasi_kinerja_data')}}/'+year,
                    dataType : 'json',
                }).done(function (result) {
                    console.log(result);
                    table_predikat.clear().draw();
                    table_predikat.rows.add(result.data).draw();
                }).fail(function(jqXHR, textStatus,errorThrown){

                })
            })


        })
       update=function (id) {
          $.ajax({
              url: "{{ url('edit-predikat-penilaian') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="skor_awal"]').val(result.skor_awal);
                  $('[name="skor_akhir"]').val(result.skor_akhir);
                  $('[name="predikat"]').val(result.predikat);
                  $('[name="kenaikan"]').val(result.kenaikan);
                  $('[name="fasilitas_lain"]').val(result.fasilitas_lain);
                  $('[name="id"]').val(result.id);
                  $('#formulir').attr('action', '{{ url('update-predikat-penilaian') }}');
              }
          })
       }
    </script>
@stop