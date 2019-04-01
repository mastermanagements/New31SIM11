@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Model Bisnis
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-model-bisnis') }}" class="btn btn-primary">Buat Model Bisnis</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>
                @if(empty($model_bisnis))
                    <h4 style="text-align: center">anda belum menambahkan model bisnis</h4>
                @else
                    @foreach($model_bisnis as $value)
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $value->nm_mb }}</h3>
                                    <div class="box-tools pull-right">
                                        <form action="{{ url('hapus-model-bisnis/'. $value->id) }}" method="post">
                                            <a href="{{ url('ubah-model-bisnis/'.$value->id) }}"  class="btn btn-box-tool"><i class="fa fa-pencil-square"></i>
                                            </a>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put">
                                            <button type="submit" onclick="return confirm('Apakah anda setuju untuk menghapus model bisnis ini...?')" class="btn btn-box-tool"><i class="fa  fa-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    {!! $value->sasaran !!}
                                </div>
                                <!-- /.box-body -->
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