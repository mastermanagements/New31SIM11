@extends('user.keuangan.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tahun Buku
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            <div class="col-md-12">
                @if(!empty(Session::get('message_success')))
                <div class="callout callout-success">
                    <h4>Informasi</h4>

                    <p>{{ Session::get('message_success') }}</p>
                </div>
                @endif

                    @if(!empty(Session::get('message_fail')))
                        <div class="callout callout-danger">
                            <h4>Informasi</h4>

                            <p>{{ Session::get('message_fail') }}</p>
                        </div>
                    @endif


                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tabel Tahun Buku</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ url('tahun-buku/create') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"> Tambah Tahun Buku </i>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Bulan Buku</th>
                                    <th>Tahun Buku</th>
                                    <th>status</th>
                                </tr>
                                @if(!empty($data))
                                    @php($i=1)
                                    @foreach($data as $data_thn_angkatan)
                                        <tr>
                                            <th style="width: 10px">{{ $i++ }}</th>
                                            <th>
                                                @if($data_thn_angkatan->bln_buku == 1)
                                                    Januari
                                                @elseif($data_thn_angkatan->bln_buku == 2)
                                                    Februari
                                                @elseif($data_thn_angkatan->bln_buku == 3)
                                                    Maret
                                                @elseif($data_thn_angkatan->bln_buku == 4)
                                                    April
                                                @elseif($data_thn_angkatan->bln_buku == 5)
                                                    Mei
                                                @elseif($data_thn_angkatan->bln_buku == 6)
                                                    Juni
                                                @elseif($data_thn_angkatan->bln_buku == 7)
                                                    Juli
                                                @elseif($data_thn_angkatan->bln_buku == 8)
                                                    Agustus
                                                @elseif($data_thn_angkatan->bln_buku == 9)
                                                    September
                                                @elseif($data_thn_angkatan->bln_buku == 10)
                                                    Oktober
                                                @elseif($data_thn_angkatan->bln_buku == 11)
                                                    November
                                                @elseif($data_thn_angkatan->bln_buku == 12)
                                                    Desember
                                                @endif
                                            </th>
                                            <th>{{ $data_thn_angkatan->thn_buku }}</th>
                                            <th>
                                                <div class="row">
                                                    <div class="col-md-3" style="width: 15%; padding-right: 100px">
                                                        <form action="{{ url('ubah-status-tahun-buku/'.$data_thn_angkatan->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            @if($data_thn_angkatan->status==1)
                                                                <button type="submit" class="btn btn-sm btn-primary" style="width: 100px"> Aktif </button>
                                                            @else
                                                                <button type="submit" class="btn btn-sm btn-danger" style="width: 100px"> Tidak Aktif </button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <form action="{{ url('tahun-buku/'.$data_thn_angkatan->id.'/delete') }}" method="post">
                                                            {{ csrf_field() }}
                                                            <a href="{{ url('tahun-buku/'.$data_thn_angkatan->id.'/edit') }}" class="btn btn-sm btn-warning">ubah</a>
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda akan menghapus tahun buku ini...?')" style="width: 100px"> hapus </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@stop