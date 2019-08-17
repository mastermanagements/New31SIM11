@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Strategi Jangka Pendek
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
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
                                        <form method="get" action="{{ url('buat-strategi-jangka-pendek') }}">
                                            <input type="hidden" name="sjp" value="{{ $value->id }}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary ">Tambahkan strategi jangka pendek anda</button>
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
                                    @if(!empty($value->getStrategiJangkaPendek))
                                        @php($strategi_jangka_pendek = $value->getStrategiJangkaPendek->groupBy('periode'))
                                        <div class="row">

                                            @foreach($strategi_jangka_pendek as $key => $periode)

                                            <div class="col-md-12">
                                                <div class="box box-success box-solid">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">{{ $key }}</h3>
                                                        <div class="box-tools pull-right">
                                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <!-- /.box-tools -->
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        @if(!empty($data_perperiode=$periode))
                                                            @foreach($data_perperiode as $value_sjpk)
                                                                <p style="font-weight: bold">
                                                                <form action="{{ url('ubah-strategi-jangka-pendek') }}" method="get">
                                                                       <label style="font-weight: bold">{{ $value_sjpk->getBagian->nm_bagian }}</label>
                                                                        <input type="hidden" name="sjpk" value="{{ $value_sjpk->id }}">
                                                                        {{ csrf_field() }}
                                                                        <button type="submit" class="btn btn-xs btn-primary pull-right"><i class="fa fa-pencil"></i></button>
                                                                </form>
                                                                <a href="{{ url('delete-sjpk/'.$value_sjpk->id ) }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-trash" onclick="return confirm('Apakah anda akan menghapus strategi ini')"></i></a>

                                                                </p>
                                                                <p>{{ $value_sjpk->getDivisi->nm_devisi }}</p>
                                                                <p></p>
                                                                {!! $value_sjpk->isi_spjd !!}
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            @endforeach
                                        </div>
                                    @endif
                                        {{--End--}}
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