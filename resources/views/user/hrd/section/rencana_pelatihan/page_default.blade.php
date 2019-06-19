@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rencana Pelatihan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-rencana-pelatihan') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambahkah Rencana Pelatihan</a>
        <p></p>
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
                @if(empty($data_pelatihan))
                    <div class="col-md-12">
                        <h5>Rencanan Pelatihan Belum Tersedia</h5>
                    </div>
                @else
                    @foreach($data_pelatihan as $value)
                        <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">

                            <div class="box-body">
                                <h3>{{ $value->tema }}</h3>
                                <span style="color: dimgrey">{{ date('d-m-Y', strtotime($value->tgl_pelatihan)) }}, Rp. {{ number_format($value->biaya,2, ',','.') }}</span>
                                <hr>
                                <p style="text-align: justify">Perserta yang akan mengikuti pelatihan <a href="{{ url('daftarkan-peserta-mengikuti-pelatihan/'. $value->id) }}">Tambah karyawan</a></p>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10px">No.</th>
                                            <th>Nama Karyawan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($i1=1)
                                        @if(!empty($value->karyawan_pelatihan))
                                            @foreach($value->karyawan_pelatihan as $vas)
                                                <tr>
                                                    <th width="10px">{{ $i1++ }}</th>
                                                    <th>{{ $vas->karyawan->nama_ky }}</th>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <p>
                                    <form action="{{ url('hapus-rencana-pelatihan/'.$value->id) }}" method="post" class="pull-right">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                        <a href="{{ url('ubah-rencana-pelatihan/'.$value->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> ubah rencana pelatihan</a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus rencana pelatihan ini..?')"><i class="fa fa-pencil"></i> hapus rencana pelatihan</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    @endforeach
                    {{ $data_pelatihan->links() }}
                @endif
        </div>
    </section>
    <!-- /.content -->
</div>

@stop
