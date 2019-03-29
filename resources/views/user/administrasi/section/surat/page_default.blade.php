@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Surat
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Surat Masuk</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Surat Keluar</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Surat</th>
                                    <th>Perihal</th>
                                    <th>Dari</th>
                                    <th>Ditujukan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                {{--@foreach($jabatan as $jabatans)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{ $i++ }}</td>--}}
                                        {{--<td>{{ $jabatans->nm_jabatan }}</td>--}}
                                        {{--<td>--}}
                                            {{--@if($jabatans->level_jabatan==0)--}}
                                                {{--Direktur/CEO/Dirut/Pimpinan--}}
                                            {{--@elseif($jabatans->level_jabatan==1)--}}
                                                {{--Bagian Administrasi--}}
                                            {{--@elseif($jabatans->level_jabatan==2)--}}
                                                {{--Bagian Produk--}}
                                            {{--@elseif($jabatans->level_jabatan==3)--}}
                                                {{--Bagian Marketing--}}
                                            {{--@elseif($jabatans->level_jabatan==4)--}}
                                                {{--Bagian Keuangan--}}
                                            {{--@elseif($jabatans->level_jabatan==5)--}}
                                                {{--Bagian HRD--}}
                                            {{--@elseif($jabatans->level_jabatan==6)--}}
                                                {{--Bagian Penggajian--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<form action="{{ url('jabatan-delete/'.$jabatans->id) }}" method="post">--}}
                                                {{--<a href="{{ url('ubah-jabatan/'.$usaha->id.'/'.$jabatans->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<input type="hidden" name="_method" value="put"/>--}}
                                                {{--<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus Ijin ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>--}}
                                            {{--</form>--}}
                                        {{--</td>--}}
                                        {{--</tr>--}}
                                       {{--@endforeach--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Surat</th>
                                    <th>Perihal</th>
                                    <th>Dari</th>
                                    <th>Ditujukan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i2=1)

                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
@stop