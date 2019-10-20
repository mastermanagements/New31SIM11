<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $judul }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <form action="#" id="setting_tanggal">
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
                            <tbody>
                            @php($total_debet=0)
                            @php($total_kredit=0)
                                @foreach($data as $data_neraca)
                                     <tr>
                                        <td>{{ $data_neraca['kode_akun'] }}</td>
                                        <td align="left">{{ $data_neraca['nm_akun'] }}</td>
                                        <td>{{ number_format($data_neraca['debet'],2,',','.') }}</td>
                                        <td>{{ number_format($data_neraca['kredit'],2,',','.') }}</td>
                                    </tr>
                                    @php($total_debet+=$data_neraca['debet'])
                                    @php($total_kredit+=$data_neraca['kredit'])
                                @endforeach
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td>{{ number_format($total_debet,2,',','.') }}</td>
                                    <td>{{ number_format($total_kredit,2,',','.') }}</td>
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