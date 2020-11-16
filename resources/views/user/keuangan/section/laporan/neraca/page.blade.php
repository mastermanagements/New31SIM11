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
                            <input type="text" class="form-control " id="datepicker" placeholder="Tanggal Awal" name="tgl_awal"  value="{{ date('d-m-Y', strtotime($tahun_berjalan2->first_date->toDateString())) }}" required>
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
                        <table id="example_rincian" class="table table-bordered table-hover" style="width: 100%; text-align: left">
                            <tbody>
                                @if(!empty($data))

                                @foreach($data as $key => $data_sort)
                                    <tr style="background-color: greenyellow">
                                        <td colspan="2">{{ $key }}</td>
                                    </tr>
                                    @if(!empty($data_sort['data']))
                                        @foreach($data_sort['data'] as $data_akuns)
                                            @foreach($data_akuns as $data_akun)
                                                <tr>
                                                    <td >{{ $data_akun['nama_akun'] }}</td>
                                                    @if($data_akun['posisi_saldo']=='D')
                                                        <td >{{ $data_akun['saldo_debet'] }}</td>
                                                    @else
                                                        <td >{{ $data_akun['saldo_kredit'] }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                            <tr style="background-color: lightblue">
                                                <td>Total {{ $key }}</td>
                                                <td>{{ $data_sort['total'] }}</td>
                                            </tr>
                                    @endif
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