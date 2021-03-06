<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><b>{{ $judul }}</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <form action="#" id="setting_tanggal">
                <div class="row" style="padding: 11px">
                    <div class="col-md-3" style="padding: 1px">
                        <div class="form-group">
                            <input type="text" class="form-control " id="datepicker" placeholder="Tanggal Awal" name="tgl_awal" value="{{ date('d-m-Y', strtotime($tahun_berjalan->first_date->toDateString())) }}" required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 0px; margin: 0px">
                             <label>s/d</label>
                    </div>
                    <div class="col-md-3" style="padding: 1px">
                        <div class="form-group">
                            <input type="text" class="form-control " id="datepicker1" placeholder="Tanggal Akhir" name="tgl_akhir" value="{{ date('d-m-Y', strtotime($tahun_berjalan->last_date->toDateString())) }}" required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 1px; margin-right: 10px;">
                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="tombol-tampilkan"><i class="fa fa-print"></i> Tampilkan</button>
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
                                    <th>Kode Akun</th>
                                    <th>Perkiraan</th>
                                    <th>Keterangan</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data_jurnal))
                                @foreach($data_jurnal as $data)
                                    <tr>
                                        <td>{{ $data['no_transaksi'] }}</td>
                                        <td>{{ $data['tanggal'] }}</td>
                                        <td>{{ $data['kode_akun'] }}</td>
                                        <td style="text-align:left">{{ ucfirst($data['nama_akun']) }}</td>
                                        <td style="text-align:left">{{ $data['keterangan'] }}</td>
                                        <td style="text-align:right">{{ rupiahView($data['debet']) }}</td>
                                        <td style="text-align:right">{{ rupiahView($data['kredit']) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5" style="text-align: center">Total</th>
                                <th>{{ $total_debet }}</th>
                                <th>{{ $total_kredit }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>