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
                            <button type="button" class="btn btn-danger" id="tombol-print"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example_rincian" class="table table-bordered table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Keterangan</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            {{--<tbody>--}}
                            {{--@php($total_debet=0)--}}
                            {{--@php($total_kredit=0)--}}
                                {{--@foreach($data as $data_neraca)--}}
                                     {{--<tr>--}}
                                        {{--<td>{{ $data_neraca['kode_akun'] }}</td>--}}
                                        {{--<td>{{ $data_neraca['nm_akun'] }}</td>--}}
                                        {{--<td>{{ number_format($data_neraca['debet'],2,',','.') }}</td>--}}
                                        {{--<td>{{ number_format($data_neraca['kredit'],2,',','.') }}</td>--}}
                                    {{--</tr>--}}
                                    {{--@php($total_debet+=$data_neraca['debet'])--}}
                                    {{--@php($total_kredit+=$data_neraca['kredit'])--}}
                                {{--@endforeach--}}
                                {{--<tr>--}}
                                    {{--<td colspan="2">Total</td>--}}
                                    {{--<td>{{ number_format($total_debet,2,',','.') }}</td>--}}
                                    {{--<td>{{ number_format($total_kredit,2,',','.') }}</td>--}}
                                {{--</tr>--}}
                            {{--</tbody>--}}
                            <tbody>

                            @if(!empty($data))
                                @php($total_debet=0)
                                @php($total_kredit=0)
                            @foreach($data as $data)
                                <tr>
                                    <th>{{ $data['kode_akun'] }}</th>
                                    <th>{{ $data['nama_akun'] }}</th>
                                    <th>{{ number_format(abs($data['saldo_debet']),2,',','.') }}</th>
                                    <th>{{ number_format(abs($data['saldo_kredit']),2,',','.') }}</th>
                                </tr>
                                @php($total_debet+=abs($data['saldo_debet']))
                                @php($total_kredit+=abs($data['saldo_kredit']))
                            @endforeach
                            @endif
                            <tr>
                                <td colspan="2">Total</td>
                                <th>{{ number_format($total_debet,2,',','.') }}</th>
                                <th>{{ number_format($total_kredit,2,',','.') }}</th>
                            </tr>
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