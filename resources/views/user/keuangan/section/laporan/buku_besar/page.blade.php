<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $judul }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <form action="#" id="setting_tanggal">
                <div class="row" style="padding: 11px">
                    <div class="col-md-3" style="padding: 1px">
                        <div class="form-group">
                            <input type="text" class="form-control " id="datepicker" placeholder="Tanggal Awal" name="tgl_awal" value="{{ date('d-m-Y', strtotime($tahun_berjalan2->first_date->toDateString())) }}" required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 0px; margin: 0px">
                             <label>s/d</label>
                    </div>
                    <div class="col-md-3" style="padding: 1px">
                        <div class="form-group">
                            <input type="text" class="form-control " id="datepicker1" placeholder="Tanggal Akhir" name="tgl_akhir" value="{{ date('d-m-Y', strtotime($tahun_berjalan2->last_date->toDateString())) }}" required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 1px">
                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="tombol-tampilkan">Tampilkan</button>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 1px">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="tombol-print"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example_rincian" class="table table-bordered table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                              {{--@foreach($data as $akun)--}}
                                    {{--<tr style="background-color: #00D8D8" id="akuns">--}}
                                        {{--<th >{{ $akun[0] }} </th>--}}
                                        {{--<th></th>--}}
                                        {{--<th></th>--}}
                                        {{--<th></th>--}}
                                        {{--<th></th>--}}
                                        {{--<th></th>--}}
                                    {{--</tr>--}}
                                    {{--@php($total_debet  = 0)--}}
                                    {{--@php($total_kredit = 0)--}}
                                    {{--@foreach($akun[1] as $keterangan)--}}
                                        {{--<tr class="body-table-buku-besar">--}}
                                            {{--<td>{{ $keterangan['no_transaksi'] }}</td>--}}
                                            {{--<td>{{ date('d-m-Y', strtotime($keterangan['tanggal'])) }}</td>--}}
                                            {{--<td>{{ $keterangan['nama_keterangan'] }}</td>--}}
                                            {{--<td>{{ number_format($keterangan['debet'],2,',','.') }}</td>--}}
                                            {{--<td>{{ number_format($keterangan['kredit'],2,',','.') }}</td>--}}
                                            {{--<td>{{ number_format($keterangan['saldo'],2,',','.') }}</td>--}}
                                            {{--@php($total_debet  += $keterangan['debet'])--}}
                                            {{--@php($total_kredit  += $keterangan['kredit'])--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--<tr style="background-color: greenyellow">--}}
                                        {{--<td >Total</td>--}}
                                        {{--<td ></td>--}}
                                        {{--<td ></td>--}}
                                        {{--<td >{{ number_format($total_debet,2,',','.') }}</td>--}}
                                        {{--<td >{{ number_format($total_kredit,2,',','.') }}</td>--}}
                                        {{--<td ></td>--}}
                                    {{--</tr>--}}
                              {{--@endforeach--}}
                              @if(!empty($data_buku_besar))
                                @foreach($data_buku_besar as $key=> $data)
                                    <tr style="background-color: lawngreen; text-align: left; font-weight: bold">
                                        <td colspan="6">{{ $akun->where('id',$key)->first()->nm_akun_aktif }}</td>
                                    </tr>
                                    @foreach($data as $sub_key => $sub_data)
                                        <tr>
                                            <td>{{ $sub_data['no_transaksi'] }}</td>
                                            <td>{{ $sub_data['tanggal'] }}</td>
                                            <td>{{ $sub_data['keterangan'] }}</td>
                                            <td>{{ $sub_data['debet'] }}</td>
                                            <td>{{ $sub_data['kredit'] }}</td>
                                            <td>
                                                @if($sub_data['saldo_debet']!=0)
                                                    {{ $sub_data['saldo_debet'] }}
                                                @else
                                                    {{ $sub_data['saldo_kredit'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                              @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>