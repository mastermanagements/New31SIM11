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
                            @php($total_sub=0)
                            @php($total_kredit=0)
                                @foreach($data['data'] as $data_laba_rugi)
                                    <tr align="left" style="background-color: lightgrey">
                                        <td colspan= "2">{{ $data_laba_rugi['akun'] }}</td>
                                    </tr>
                                    @if(!empty($data_laba_rugi['sub_akun']))
                                        @foreach($data_laba_rugi['sub_akun'] as $data_sub)
                                                <tr align="left" style="background-color: white">
                                                    <td>{{ $data_sub['nm_sub_akun'] }}</td>
                                                    <td>{{ number_format($data_sub['total'],2,',','.') }}
                                                    </td>
                                                </tr>
                                                @if(!empty($data_sub['data_sub_akun_aktif']))
                                                    @foreach($data_sub['data_sub_akun_aktif'] as $data_sub_sub)
                                                        @if($data_sub_sub['status'] ==1)
                                                            <tr align="left" style="background-color: white">
                                                                <td style="padding-left: 30px">{{ $data_sub_sub['nm_sub_sub_akun'] }}</td>
                                                                <td>{{ number_format($data_sub_sub['total_sub_sub'],2,',','.') }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        @endforeach
                                    @endif
                                    {{--@php($total_debet+=$data_neraca['debet'])--}}
                                    {{--@php($total_kredit+=$data_neraca['kredit'])--}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                   <td >Laba Rugi</td>
                                   <td align="left">{{ number_format($data['total_laba_rugi'],2,',','.') }}</td>
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