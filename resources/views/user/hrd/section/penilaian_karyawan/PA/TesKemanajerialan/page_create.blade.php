@extends('user.hrd.master_user')
@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop
@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Daftar Tabel Penilaian
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 10px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tesKemanajerial">Tambah penilaian</button>
                </div>
                @foreach($ky->get_MannyTesKemanajerialan->sortByDesc('thn_tes_km')->groupBy('thn_tes_km') as $tahun => $penilaian)
                <div class="col-md-6">
                    <div class="box box-primary collapsed">
                        <div class="box-header with-border">
                            <h3 class="box-title">Penilaian Tahun {{ $tahun }} </h3>
                            <div class="box-tools pull-right">
                               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                               </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kompetensi</th>
                                    <th>Item Kompetensi</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @php($nilai_total = 0)
                                @foreach($penilaian as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->kompentensi_m->nm_kompetensi_m }}</td>
                                        <td>{{ $value->item_km->item_kompetensi_m }}</td>
                                        <td>{{ $value->nilai_km }}</td>
                                        <td>
                                            <form action="{{ url('hapus-test-manajerial/'.$value->id) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <button type="button" class="btn btn-warning" id="tomboh-ubah" onclick="update('{{ $value->id }}')" >Ubah</button>
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda akan menghapus data ini...?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                   @php($nilai_total += $value->nilai_km)
                                @endforeach
                                </tbody>
                            </table>
                            <p></p>
                            <button class="btn btn-success pull-right"> Nilai Akhir : {{ $nilai_total/$penilaian->count() }} </button>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                @endforeach
            </div>

        </section>
        <!-- /.content -->
    </div>
    @include('user.hrd.section.penilaian_karyawan.PA.TesKemanajerialan.modal.modal')
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


    <script>


        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

        update = function (id) {
            $.ajax({
                url: "{{ url('edit-tes-kemanajerial') }}/"+id,
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    $('[name="thn_tes_km"]').val(result.thn_tes_km);
                    $('[name="id_kompetensi_m"]').val(result.id_kompetensi_m).trigger('change');
                    $('[name="id_item_km"]').val(result.id_item_km).trigger('change');
                    $('[name="nilai_km1"]').val(result.nilai_km);
                    $('[name="id"]').val(result.id);
                    $('#formulir').attr('action', '{{ url('update-tes-kemanajerial') }}');
                    $('#modal-tesKemanajerial').modal('show');
                }
            })
        }
    </script>
@stop