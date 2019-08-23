<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                 <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-dividen-investor"> <i class="fa fa-plus"></i> Dividen Investor</button>


                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Investor</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="daftar-investor">
                                <span style="color: darkgray">Investor ini telah ditambahkan ke daftar dividen: </span>
                                <ul>
                                    @foreach($data_dividen_investor->groupBy('id_daftar_investor') as $investor)
                                        <li><a href="#" onclick="lihat_dividen('{{ $investor[0]->investor->id }}','')">{{ $investor[0]->investor->nm_investor }} </a> </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-default collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tahun</h3>

                                        <div class="box-tools pull-right ">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" >
                                        <div id="button-container">

                                        </div>
                                        <div class="overlay" id="loading-button">
                                            <i class="fa fa-refresh fa-spin"></i>
                                            <p style="text-align: center; padding-top: 10%">Pilih Salah satu Investor</p>
                                        </div>
                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <div class="col-md-12">
                                    <div class="box box-danger box-solid">
                                        <div class="box-header">
                                            <h3 class="box-title" id="title-table">Daftar Dividen</h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <table id="example1" class="table table-bordered table-striped table_dividen" style="width: 100%">
                                                    <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Bulan Dividen</th>
                                                        <th>Laba Rugi</th>
                                                        <th>Alokasi Kas</th>
                                                        <th>Net Kas</th>
                                                        <th>Besar Dividen</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php($i=1)
                                                        {{--@foreach($data_dividen_investor as $value)--}}
                                                        {{--<tr>--}}
                                                        {{--<td>{{ $i++ }}</td>--}}
                                                        {{--<td>{{ $value->investor->nm_investor}}</td>--}}
                                                        {{--<td>{{ date('M', strtotime($value->bulan_dividen->bln_dividen)) }} {{ $value->bulan_dividen->thn_dividen }}</td>--}}
                                                        {{--<td>{{ number_format($value->besar_dividen,2,',','.') }}</td>--}}
                                                        {{--<td>--}}
                                                        {{--<form action="{{ url('delete-saham-real/'. $value->id) }}" method="post">--}}
                                                        {{--<input type="hidden" name="_method" value="put">--}}
                                                        {{--{{ csrf_field() }}--}}
                                                        {{--<button type="button" class="btn btn-warning" onclick="edit_dividen_investor('{{ $value->id }}')">ubah</button>--}}
                                                        {{--<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data ini ...?')" >hapus</button>--}}
                                                        {{--</form>--}}
                                                        {{--</td>--}}
                                                        {{--</tr>--}}
                                                        {{--@endforeach--}}
                                                    </tbody>
                                                </table>
                                                </div>

                                        </div>
                                        <!-- /.box-body -->
                                        <!-- Loading (remove the following to stop the loading)-->
                                        <div class="overlay" id="loading_s">
                                            <i class="fa fa-refresh fa-spin"></i>
                                            <p style="text-align: center; padding-top: 16%; font-weight: bold">Pilih Salah satu Investor</p>
                                        </div>
                                        <!-- end loading -->
                                    </div>
                                    <!-- /.box -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
    </div>
</div>