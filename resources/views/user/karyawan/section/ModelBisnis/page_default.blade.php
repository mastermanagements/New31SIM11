@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bisnis Model Canvas
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-model-bisnis') }}" class="btn btn-primary">Tambah</a>
        <p></p>
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>
              @if(!empty($jenis_mb))
                @foreach($jenis_mb as $jenisMb)
                        <div class="col-md-6">
                            <div class="box @if($jenisMb->nama_mb=="Customer segment") box-primary @elseif($jenisMb->nama_mb=="Value proportion") box-warning
                                        @elseif($jenisMb->nama_mb=="Channel") box-success @elseif($jenisMb->nama_mb=="Customer relathionship") box-danger
                                        @elseif($jenisMb->nama_mb=="Revenue stream") box-primary @elseif($jenisMb->nama_mb=="Key activities") box-warning
                                        @elseif($jenisMb->nama_mb=="Key resources") box-success @elseif($jenisMb->nama_mb=="Key partners") box-danger
                                        @else  box-primary  @endif collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $jenisMb->nama_mb }}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header-->
                                <div class="box-body">
                                    @foreach($model_bisnis as $value)
                                      @if($value->id_jenis_mb == $jenisMb->id)
                                        <div class="comment-text">
                                          <form action="{{ url('hapus-mb/'. $value->id) }}" method="post">
                                            <input type="hidden" name="_method" value="put">
                                            {{ csrf_field() }}
                                            <button type="submit" onclick="return confirm('apakah anda akan menghapus model bisnis .. ?')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                            <a href="{{ url('ubah-mb/'. $value->id) }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-pencil"></i></a>
                                          </form>
                                          <span class="username">
                                            <b>{{ $value->getSubModelBisnis->sub_mb }}</b>
                                          </span><br>
                                          <!-- /.username -->
                                            {!! $value->isi !!}
                                        </div>
                                        <!-- /.comment-text -->

                                      @endif
                                    @endforeach

                                </div>
                                <!-- /.box-body 2-->
                            </div>
                            <!-- /.box -->
                        </div>
                @endforeach
              @endif
    </section>
    <!-- /.content -->
</div>
@stop
