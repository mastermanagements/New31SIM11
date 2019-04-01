@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Strategi Jangka Panjang
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-strategi-jangka-panjang') }}" class="btn btn-primary">Buat Strategi Anda</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @if(empty($data_strategi))
            <h4 style="color: orange; text-align: center">Anda belum memasukan strategi anda..!!</h4>
            @else
                @foreach($data_strategi as $value)
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Strategi ini Dibuat Pada Tanggal Dan Waktu {{ date('d-m-Y H:i:s', strtotime($value->created_at)) }}</h3>

                                    <div class="box-tools pull-right">
                                        <form action="{{ url('hapus-sjp/'. $value->id) }}" method="post">
                                        <a href="{{ url('ubah-strategi-jangka-panjang-ini/'.$value->id) }}"  class="btn btn-box-tool"><i class="fa fa-pencil-square"></i>
                                        </a>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put">
                                        <button type="submit" onclick="return confirm('Apakah anda setuju untuk menghapus strategi ini...?')" class="btn btn-box-tool"><i class="fa  fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        </form>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <p>Periode {{ $value->periode }}</p>
                                    {!! $value->isi_sjpg !!}
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    @endforeach
                @endif

        </div>
    </section>
    <!-- /.content -->
</div>
@stop