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
                            <input type="text" class="form-control " id="datepicker1" placeholder="Tanggal Akhir" name="tgl_akhir" value="{{ date('d-m-Y', strtotime($tahun_berjalan2->last_date->toDateString())) }}"  required>
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
                            <tbody>
                                @php($saldo_kredit=0)
                                @php($saldo_debet=0)
                                @php($saldo_laba=0)
                                @foreach($data as $key=>$data_)
                                    @if($key!='laba_rugi')
                                        @foreach($data_ as $daftar_akun)
                                            <tr>
                                                <td>{{ $daftar_akun['nama_akun'] }}</td>
                                                <td>
                                                    @if($daftar_akun['posisi_saldo']=="D")
                                                        @php($saldo_debet+=$daftar_akun['saldo_debet'])
                                                    @else
                                                        @php($saldo_kredit+=$daftar_akun['saldo_kredit'])
                                                    @endif
                                                    {{ $daftar_akun['saldo_debet']+$daftar_akun['saldo_kredit'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>{{ $data_['nama_akun'] }}</td>
                                            <td>
                                                @php($saldo_laba+=($data_['saldo_debet']+$data_['saldo_kredit']))
                                                {{ ($data_['saldo_debet']+$data_['saldo_kredit']) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td>Penambahan Saldo</td>
                                    <td>{{ $saldo_laba-$saldo_debet }}</td>
                                </tr>
                                <tr>
                                    <td>Modal Akhir</td>
                                    <td>{{ ($saldo_laba-$saldo_debet)+$saldo_kredit }}</td>
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