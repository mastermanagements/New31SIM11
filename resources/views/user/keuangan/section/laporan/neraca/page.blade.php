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
                            <input type="text" class="form-control " id="datepicker" placeholder="Tanggal Awal" name="tgl_awal" required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 0px; margin: 0px">
                        <label>s/d</label>
                    </div>
                    <div class="col-md-3" style="padding: 1px">
                        <div class="form-group">
                            <input type="text" class="form-control " id="datepicker1" placeholder="Tanggal Akhir" name="tgl_akhir" required>
                            <small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding: 1px">
                        <div class="form-group">
                            <button type="button" class="btn btn-success" id="tombol-tampilkan">Tampilkan</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example_rincian" class="table table-bordered table-hover" style="width: 100%">
                            <tbody>
                            @php($total_sub=0)
                            @php($total_aktiva=0)
                            @php($total_pasiva=0)
                                @foreach($data['aktiva'] as $data_laba_rugi)
                                    @php($totals=0)
                                    @php($total_subsed=0)
                                    <tr align="left" style="background-color: lightgrey">
                                        <td colspan= "2">{{ $data_laba_rugi['akun'] }}</td>
                                    </tr>

                                    @if(!empty($data_laba_rugi['sub_akun']))
                                        @foreach($data_laba_rugi['sub_akun'] as $data_sub)
                                                <tr align="left" style="background-color: white">
                                                    <td>{{ $data_sub['nm_sub_akun'] }}</td>
                                                    <td>{{ $data_sub['total'] }}
                                                        @if($data_sub['sub_operasi']==1)
                                                            @php($total_sub+=$data_sub['total'] )
                                                        @else
                                                            @php($total_sub-=$data_sub['total'] )
                                                         @endif
                                                    </td>
                                                </tr>
                                                @php($totals += $data_sub['total'])
                                                @if(!empty($data_sub['data_sub_akun_aktif']))
                                                    @foreach($data_sub['data_sub_akun_aktif'] as $data_sub_sub)
                                                        @if($data_sub_sub['status'] ==1)
                                                            <tr align="left" style="background-color: white">
                                                                <td style="padding-left: 30px">{{ $data_sub_sub['nm_sub_sub_akun'] }}</td>
                                                                <td>{{ $data_sub_sub['total_sub_sub'] }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif

                                        @endforeach
                                    @endif
                                    {{--@php($total_debet+=$data_neraca['debet'])--}}
                                    {{--@php($total_kredit+=$data_neraca['kredit'])--}}
                                    <tr align="left" style="background-color: white">
                                        <td>Total</td>
                                        <td>{{ $totals }} @php($total_aktiva +=$totals )</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color: #b0d4f1">
                                    <td >Total Aktiva</td>
                                    <td align="left">{{ $total_aktiva }}</td>
                                </tr>
                                @foreach($data['pasiva'] as $data_laba_rugi)
                                    @php($totals=0)
                                    @php($total_subsed=0)
                                    <tr align="left" style="background-color: lightgrey">
                                        <td colspan= "2">{{ $data_laba_rugi['akun'] }}</td>
                                    </tr>

                                    @if(!empty($data_laba_rugi['sub_akun']))
                                        @foreach($data_laba_rugi['sub_akun'] as $data_sub)
                                                <tr align="left" style="background-color: white">
                                                    <td>{{ $data_sub['nm_sub_akun'] }}</td>
                                                    <td>{{ $data_sub['total'] }}
                                                        @if($data_sub['sub_operasi']==1)
                                                            @php($total_sub+=$data_sub['total'] )
                                                        @else
                                                            @php($total_sub-=$data_sub['total'] )
                                                         @endif
                                                    </td>
                                                </tr>
                                                @php($totals += $data_sub['total'])
                                                @if(!empty($data_sub['data_sub_akun_aktif']))
                                                    @foreach($data_sub['data_sub_akun_aktif'] as $data_sub_sub)
                                                        @if($data_sub_sub['status'] ==1)
                                                            <tr align="left" style="background-color: white">
                                                                <td style="padding-left: 30px">{{ $data_sub_sub['nm_sub_sub_akun'] }}</td>
                                                                <td>{{ $data_sub_sub['total_sub_sub'] }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif

                                        @endforeach
                                    @endif
                                    {{--@php($total_debet+=$data_neraca['debet'])--}}
                                    {{--@php($total_kredit+=$data_neraca['kredit'])--}}
                                    <tr align="left" style="background-color: white">
                                        <td>Total</td>
                                        <td>{{ $totals }} @php($total_pasiva+=$totals)</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color: #b0d4f1">
                                    <td >Total Pasiva</td>
                                    <td align="left">{{ $total_aktiva }}</td>
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