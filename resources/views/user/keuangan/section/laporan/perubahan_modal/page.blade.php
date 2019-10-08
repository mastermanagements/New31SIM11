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
                                @php($total_kredit=0)
                                @php($total_debet=0)
                                {{-- Kredit --}}
                                <tr align="left" style="background-color: lightgrey">
                                    <td>{{ $data['kredit'][0]['akun'] }}</td>
                                    <td></td>
                                    <td>{{ number_format($data['kredit'][0]['sub_total'],2,',','.') }} @php($total_kredit = $data['kredit'][0]['sub_total'])</td>
                                </tr>

                                @foreach($data['kredit'][0]['sub_akun'] as $kredit)
                                    <tr align="left">
                                        <td>{{ $kredit['nm_sub_akun'] }}</td>
                                        <td></td>
                                        <td>{{ number_format($kredit['total'],2,',','.') }}</td>
                                    </tr>
                                @endforeach
                                <tr align="left" style="background-color: lightgrey">
                                    <td>{{ $data['laba_tahun_berjalan']['nm_sub_akun'] }} </td>
                                    <td>{{ number_format($data['laba_tahun_berjalan']['total'],2,',','.') }}</td>
                                    <td></td>
                                </tr>
                                {{--debit--}}
                                @php($total_debet=$data['debit'][0]['sub_total'])
                                @foreach($data['debit'][0]['sub_akun'] as $debit)
                                    <tr align="left">
                                        <td>{{ $debit['nm_sub_akun'] }} aa</td>
                                        <td></td>
                                        <td>{{ number_format($debit['total'],',','.') }}</td>
                                    </tr>
                                @endforeach
                                {{--Laba Bersih--}}
                                <tr align="left" style="background-color: deepskyblue">
                                    <td>
                                        @if($data['laba_tahun_berjalan']['total'] < 0)
                                            Pengurang Modal
                                        @else
                                            Penambah Modal
                                        @endif
                                    </td>
                                    <td></td>
                                    <td>
                                        @php($total_debet = $total_debet+$data['laba_tahun_berjalan']['total'] + $total_debet)
                                        {{ number_format($total_debet,2,',','.') }}
                                    </td>
                                </tr>
                                <tr align="left">
                                    <td>
                                      Modal Akhir
                                    </td>
                                    <td></td>
                                    <td>
                                        @if($total_debet < 0)
                                            {{ number_format($total_kredit - $total_debet,2,',','.') }}
                                        @else
                                            {{ number_format($total_kredit + $total_debet,2,',','.') }}
                                        @endif
                                    </td>
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