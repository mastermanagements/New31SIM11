@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@stop


@section('master_content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content container-fluid">
        <p></p>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-body box-primary">
                  <div class="row">
                      <div class="col-sm-12" style="padding: 20px">
                            <a href="{{ url('detail-barang-selesai-produksi-cetak/'.$id) }}" class="btn btn-primary">Print</a>
                      </div>
                      <div class="col-sm-12" style="padding: 20px">
                          <p style='text-align: center; font-weight: bold;'>Detail Produksi</p>
                          <p></p>
                          <p></p>
                          <p style="font-weight: bold;">Tim Produksi :</p>
                          <p style="font-weight: bold;">Supervisor : {{ $data->linkToSupervisor->nama_ky }}</p>
                      </div>
                      <div class="col-md-12">
                          <p>Anggota:</p>
                          <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(!empty($data->linkToMannyTenagaProduksi))
                                  @php($no=1)
                                  @foreach($data->linkToMannyTenagaProduksi as $data_item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data_item->linkToPekerja->nama_ky }}</td>
                                        <td>{{ $data_item->jumlah_upah }}</td>
                                        <td></td>
                                    </tr>
                                  @endforeach
                              @endif
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          <p>Gambaran Umum:</p>
                          <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Produksi</th>
                                    <th>No. Batch</th>
                                    <th>No. Serial</th>
                                    <th>Tgl. Mulai</th>
                                    <th>Tgl. Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>#</th>
                                <th>{{ $data->kode_produksi }}</th>
                                <th>{{ $data->batch_number }}</th>
                                <th>{{ $data->no_serial }}</th>
                                <th>{{ date('d-m-Y', strtotime($data->tgl_mulai)) }} {{ date('H:i:s', strtotime($data->jam_mulai)) }}</th>
                                <th>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }} {{ date('H:i:s', strtotime($data->jam_selesai)) }}</th>
                            </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          <p>Quality Control & Hasil</p>
                          <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Tgl diperiksa</th>
                                    <th colspan="2">Barang Dalam Proses</th>
                                    <th colspan="2">Barang jadi</th>
                                </tr>
                                <tr>
                                    <th>Bagus</th>
                                    <th>Rusak</th>
                                    <th>Bagus</th>
                                    <th>Rusak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>{{ date('d-m-Y', strtotime($data->tgl_mulai_qc)) }} s/d {{ date('d-m-Y', strtotime($data->tgl_selesai)) }}</th>
                                    <th>{{ $data->jumlah_bdp_bagus }}</th>
                                    <th>{{ $data->jumlah_bdp_rusak }}</th>
                                    <th>{{ $data->jumlah_brg_jadi_bagus }}</th>
                                    <th>{{ $data->jumlah_brg_jadi_rusan }}</th>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          <p>History Pelaksanaan</p>
                          <table class="table table-responsive">
                              <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>Proses Produksi</th>
                                  <th>Tgl & Jam Mulai</th>
                                  <th>Tgl & Jam Selesai</th>
                                  <th>Keterangan</th>
                              </tr>
                              </thead>
                              <tbody>
                                @if(!empty($data->linkToMannyProsesPengerjaan))
                                    @php($i=1)
                                    @foreach($data->linkToMannyProsesPengerjaan as $item_produksi)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <th>{{ $item_produksi->linkToProsesBisnis->proses_bisnis }}</th>
                                            <th>{{ date('d-m-Y', strtotime($item_produksi->tgl_mulai)) }} {{ date('H:i:s', strtotime($item_produksi->jam_mulai)) }} </th>
                                            <th>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }} {{ date('H:i:s', strtotime($data->jam_selesai)) }} </th>
                                            <th>{{ $item_produksi->ket }}</th>
                                        </tr>
                                    @endforeach
                                @endif
                              </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          @if(!empty($hpp))
                              <ol style="font-weight: bold">
                                @foreach($hpp as $key=> $item)
                                    @foreach($item as $sub_item)
                                        <li>{{ $sub_item['judul'] }} : Rp. {{ $sub_item['total'] }}
                                            <ul>
                                                @if(!empty($sub_item['data']))
                                                    @foreach($sub_item['data'] as $value)
                                                        <li>{{ $value['judul'] }} : Rp.{{ $value['total'] }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
                                @endforeach
                              </ol>
                          @endif
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop
@section('plugins')
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        window.onload = function() {
            CKEDITOR.replace( 'spec_barang',{
                height: 200
            } );
            CKEDITOR.replace( 'desc_barang',{
                height: 200
            } );
        };

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
//        $('#datepicker1').datepicker({
//            autoclose: true,
//            format: 'dd-mm-yyyy'
//        });

        $(function () {
            $('.select2').select2()
        });
    </script>
    @include('user.produksi.section.barang.JS.JS')
@stop