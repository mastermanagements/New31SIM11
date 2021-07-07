<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $judul }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <form action="#" id="setting_tanggal">
                <div class="row" style="padding: 11px">
                    {{--<div class="col-md-3" style="padding: 1px">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control " id="datepicker" placeholder="Tanggal Awal" name="tgl_awal"  value="{{ date('d-m-Y', strtotime($tahun_berjalan2->first_date->toDateString())) }}" required>--}}
                            {{--<small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-1" style="padding: 0px; margin: 0px">--}}
                        {{--<label>s/d</label>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3" style="padding: 1px">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control " id="datepicker1" placeholder="Tanggal Akhir" name="tgl_akhir" value="{{ date('d-m-Y', strtotime($tahun_berjalan2->last_date->toDateString())) }}"  required>--}}
                            {{--<small style="color: red" class="pull-left">* Tidak Boleh Kosong</small>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-1" style="padding: 1px">--}}
                        {{--<div class="form-group">--}}
                            {{--<button type="button" class="btn btn-success" id="tombol-tampilkan">Tampilkan</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>
            </form>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ url('tutup-buku') }}" method="post">
                            {{ csrf_field() }}
                            @if(!empty(Session::get('message_error_tutup_buku')))
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-ban"></i>Info</h4>
                                        {{ Session::get('message_error_tutup_buku') }}
                                    </div>
                                </div>
                            @endif

                            @if(!empty(Session::get('message_success_tutup_buku')))
                                <div class="col-md-12">
                                    <div class="alert alert-info alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-info"></i> Info </h4>
                                        {{ Session::get('message_error_tutup_buku') }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12 row">
                                    <div class="col-md-2">
                                        <label>Tahun</label>
                                    </div>
                                    <div class="col-md-5">
                                        <select name="thn_periode" class="form-control">
                                            <option value="{{$tahun_berjalan}}">{{ $tahun_berjalan }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button style="margin:5px" type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda akan tutup buku ...?')"> Tutup buku </button>
                                        <button type="button" class="btn btn-danger" id="tombol-print"> Cetak</button>
                                    </div>
                            </div>

                            <table id="example_rincian" class="table table-bordered table-hover" style="width: 100%; text-align: left">
                                <tbody>
                                    @if(!empty($data))

                                    @foreach($data as $key => $data_sort)
                                        <tr style="background-color: #00D8D8">
                                            <td colspan="2">{{ $key }}</td>
                                        </tr>
                                        @if(!empty($data_sort['data']))
                                            @foreach($data_sort['data'] as  $key_account=> $data_akuns)
                                                @foreach($data_akuns as $data_akun)
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="id_akun[]" value="{{ $key_account }}">
                                                            <input type="hidden" name="id_aktif_ukm[]" value="{{ $data_akun['id_aktif_ukm'] }}">
                                                            <input type="hidden" name="tgl_jurnal[]" value="{{ $data_akun['tgl_jurnal'] }}">
                                                            <input type="hidden" name="debet_kredit[]" value="{{ $data_akun['debet_kredit'] }}">
                                                            {{ $data_akun['nama_akun'] }}
                                                        </td>
                                                        @if($data_akun['posisi_saldo']=='D')
                                                            <td > <input type="hidden" name="saldo_dk[]" value="{{ $data_akun['saldo_debet'] }}"> {{ number_format($data_akun['saldo_debet'],2,',','.') }}</td>
                                                        @else
                                                            <td > <input type="hidden" name="saldo_dk[]" value="{{ $data_akun['saldo_kredit'] }}"> {{ number_format($data_akun['saldo_kredit'],2,',','.') }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                                <tr style="background-color: lightblue">
                                                    <td>Total {{ $key }}</td>
                                                    <td>{{ number_format($data_sort['total'],2,',','.') }}</td>
                                                </tr>
                                        @endif
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>