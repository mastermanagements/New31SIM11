<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-i-pelaksana"> <i class="fa fa-plus"></i> Nisbah pelaksana </button>
                @if(!empty(session('message_success')))
                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                @elseif(!empty(session('message_fail')))
                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                @endif

                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Pelaksana</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p style="color: darkgray">Pelaksana ini telah ditambahkan ke Disbah Pelaksana:</p>
                                @foreach($data as $value)
                                    <li ><a href="#" onclick="lihat_data_dividen('{{ $value->id_pelaksana }}','')"> {{ $value->pelaksana->karyawan->nama_ky }} </a> </li>
                                @endforeach
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-md-9">
                        <div class="box box-success box-solid ">
                            <div class="box-header with-border ">
                                <h3 class="box-title" >Tahun</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="button-container">

                                <div class="overlay" id="loading-button">
                                    <i class="fa fa-refresh fa-spin"></i>
                                    <p style="text-align: center; padding-top: 5%; font-weight: bold">Pilih Salah satu Pelaksana</p>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title" id="title_table">Tabel</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped table_dividen" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Bulan</th>
                                        <th>Laba Rugi</th>
                                        <th>Alokasi Kas</th>
                                        <th>Net Kas</th>
                                        <th>Nisbah Pelaksana</th>
                                        <th>Bagi Hasil</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Total</th>
                                        <th><p id="total_laba_rugi"></p></th>
                                        <th><p id="total_alokasi_kas"></p></th>
                                        <th><p id="total_net_kas"></p></th>
                                        <th><p id="total_nisbah_pelaku"></p></th>
                                        <th><p id="total_hasil_pelaku"></p></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <div class="overlay" id="loading_s">
                                <i class="fa fa-refresh fa-spin"></i>
                                <p style="text-align: center; padding-top: 20%; font-weight: bold">Pilih Salah satu Pelaksana</p>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>

                {{--<table id="example1" class="table table-bordered table-striped tbdividenPerusahaan" style="width: 100%">--}}
                    {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>No.</th>--}}
                            {{--<th>Pelaksana</th>--}}
                            {{--<th>Periode/Bulan/tahun</th>--}}
                            {{--<th>Besar Dividen</th>--}}
                            {{--<th>Aksi</th>--}}
                        {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@php($i=1)--}}
                    {{--@foreach($data as $value)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $i++ }}</td>--}}
                            {{--<td>{{ $value->pelaksana->karyawan->nama_ky}}</td>--}}
                            {{--<td>{{ $value->bulan_dividen->periode_invest->nm_periode }} ( {{ $value->bulan_dividen->bln_dividen }} - {{ $value->bulan_dividen->thn_dividen }} )</td>--}}
                            {{--<td>{{ $value->besar_dividen }}</td>--}}
                            {{--<td>--}}
                                {{--<form action="{{ url('delete-nisbah-pelaksana/'. $value->id) }}" method="post">--}}
                                    {{--<input type="hidden" name="_method" value="put">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<button type="button" class="btn btn-warning" onclick="edit_dividen_pelaksana('{{ $value->id }}')">ubah</button>--}}
                                    {{--<button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ... ?')">hapus</button>--}}
                                {{--</form>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            </div>
            <!-- /.box-body -->
    </div>
</div>