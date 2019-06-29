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
        <a href="{{ url('tambah-sop') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambahkah Rencana Pelatihan</a>
        <p></p>
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
                @if(empty($sop))
                    <div class="col-md-12">
                        <h5>Rencanan Pelatihan Belum Tersedia</h5>
                    </div>
                @else
                    @foreach($sop as $value)
                        <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">

                            <div class="box-body">
                                <h3>{{ $value->nm_sop }}</h3>
                                <hr>
                                <p style="text-align: justify">
                                    {!! $value->isi_sop !!}
                                </p>
                                <p>
                                    <form action="{{ url('hapus-sop/'.$value->id) }}" method="post" class="pull-right">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                        <a href="{{ url('ubah-sop/'.$value->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> ubah</a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus SOP ini..?')"><i class="fa fa-pencil"></i> hapus</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    @endforeach
                @endif
        </div>
    </section>
    <!-- /.content -->
</div>

@stop
