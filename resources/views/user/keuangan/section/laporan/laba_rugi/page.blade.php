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
                            <input type="text" class="form-control " id="datepicker" placeholder="Tanggal Awal" name="tgl_awal"  value="{{ date('d-m-Y', strtotime($tahun_berjalan2->first_date->toDateString())) }}"  required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 0px; margin: 0px">
                        <label>s/d</label>
                    </div>
                    <div class="col-md-3" style="padding: 1px">
                        <div class="form-group">
                            <input type="text" class="form-control " id="datepicker1" placeholder="Tanggal Akhir" value="{{ date('d-m-Y', strtotime($tahun_berjalan2->last_date->toDateString())) }}" name="tgl_akhir" required>
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
                                @php($total_laba=0)
                                @foreach($akun as $key=> $data_laba_rugi)
                                    @php($total_sub=0)
                                    @if(!empty($data[$key]))
                                        <tr align="left" style="background-color: lightgrey">
                                            <td colspan= "2">{{ $data_laba_rugi[0] }}</td>
                                        </tr>
                                       @foreach($data[$key] as $data_group)
                                          <tr>
                                            <td>{{ $data_group['nama_akun'] }}</td>
                                            <td>
                                                @if($data_group['posisi_saldo']=="K")
                                                    @php($total_sub+=$data_group['saldo_kredit'])
                                                    @php($total_laba += $data_group['saldo_kredit'])
                                                    {{ $data_group['saldo_kredit'] }}
                                                @else
                                                    @php($total_laba -= $data_group['saldo_debet'])
                                                    @php($total_sub+=$data_group['saldo_debet'])
                                                    {{ $data_group['saldo_debet'] }}
                                                @endif
                                            </td>
                                          </tr>
                                       @endforeach
                                        <tr>
                                            <td>Total</td>
                                            <td>{{ $total_sub }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                   <td >Laba Rugi</td>
                                   <td align="center">{{ $total_laba }}</td>
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