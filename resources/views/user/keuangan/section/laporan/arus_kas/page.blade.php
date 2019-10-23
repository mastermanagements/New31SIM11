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
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($total=0)
                            @foreach($data as $key=>$first_floor)
                                <tr style="background-color: lightgrey">
                                    <td align="left">{{ $key }}</td>
                                    <td></td>
                                </tr>
                                @foreach($first_floor as $key2 => $second_floor)
                                    @php($total_floor=0)
                                    @if(!empty($second_floor['data']))
                                       <tr style="background-color: #b0d4f1">
                                           <td align="left">{{ str_replace('_',' ', $key2) }}</td>
                                           <td></td>
                                       </tr>
                                        @foreach($second_floor['data'] as $content)
                                            <tr>
                                                <td align="left">{{ $content[0] }}</td>
                                                <td>{{ number_format($content[2],2,',','.') }}</td>
                                                @php($total_floor+=$content[2])
                                            </tr>
                                        @endforeach
                                       <tr style="background-color: deepskyblue">
                                           <td align="left">Total {{ strtolower($key) }}</td>
                                           <td>{{ number_format($total_floor,2,',','.') }}</td>
                                           @php($total+=$total_floor)
                                       </tr>
                                   @endif
                                @endforeach
                            @endforeach
                            <tr style="background-color: lightgreen">
                                <td align="left">Kas Pada Awal Periode 1 januari 2019</td>
                                <td>{{ number_format($total,2,',','.') }}</td>
                            </tr>
                            <tr style="background-color: orange">
                                <td align="left">Kenaikan Kas Bersih</td>
                                <td>{{ number_format($total,2,',','.') }}</td>
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