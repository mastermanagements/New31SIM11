@extends('user.produksi.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">


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
                            <a target="_blank" href="{{ url('detail-barang-selesai-produksi-cetak/'.$id) }}" class="btn btn-primary">Print</a>
                      </div>
                      <div class="col-sm-12" style="padding: 20px">
                          <p style='text-align: center; font-weight: bold;'><u>Detail Produksi</u></p>
                          <p></p>
                          <p></p>
                          <p style="font-weight: bold;">Tim Produksi :</p>
                          <p><strong>Supervisor</strong> : {{ $data->linkToSupervisor->nama_ky }}</p>
                      </div>
                      <div class="col-md-12">
                          <p><strong>Anggota:</strong></p>
                          <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Biaya Tenaga Kerja</th>
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
                                        <td>{{ rupiahView($data_item->jumlah_upah) }}</td>
                                        <td></td>
                                    </tr>
                                  @endforeach
                              @endif
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          <p><strong>Gambaran Umum:</strong></p>
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
                                <td>#</td>
                                <td>{{ $data->kode_produksi }}</td>
                                <td>{{ $data->batch_number }}</td>
                                <td>{{ $data->no_serial }}</td>
                                <td>{{ date('d-m-Y', strtotime($data->tgl_mulai)) }} {{ date('H:i:s', strtotime($data->jam_mulai)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }} {{ date('H:i:s', strtotime($data->jam_selesai)) }}</td>
                            </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          <p><strong>Quality Control & Hasil</strong></p>
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
                                    <td>1</td>
                                    <td>{{ date('d-m-Y', strtotime($data->tgl_mulai_qc)) }} s/d {{ date('d-m-Y', strtotime($data->tgl_selesai)) }}</td>
                                    <td>{{ $data->jumlah_bdp_bagus }}</td>
                                    <td>{{ $data->jumlah_bdp_rusak }}</td>
                                    <td>{{ $data->jumlah_brg_jadi_bagus }}</td>
                                    <td>{{ $data->jumlah_brg_jadi_rusan }}</td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="col-md-12">
                          <p><strong>History Pelaksanaan</strong></p>
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
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item_produksi->linkToProsesBisnis->proses_bisnis }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item_produksi->tgl_mulai)) }} {{ date('H:i:s', strtotime($item_produksi->jam_mulai)) }} </td>
                                            <td>{{ date('d-m-Y', strtotime($data->tgl_selesai)) }} {{ date('H:i:s', strtotime($data->jam_selesai)) }} </td>
                                            <td>{{ $item_produksi->ket }}</td>
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
                                        <li>{{ $sub_item['judul'] }} : Rp. {{ rupiahView($sub_item['total']) }}
                                            <ul>
                                                @if(!empty($sub_item['data']))
                                                    @foreach($sub_item['data'] as $value)
                                                        <li>{{ $value['judul'] }} : Rp.{{ rupiahView($value['total']) }}</li>
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

@stop
