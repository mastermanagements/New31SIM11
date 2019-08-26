@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SWOT (Strength, Weakness, Opportunitie, Threats)
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('buat-swot') }}" class="btn btn-primary">Buat SWOT anda</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @foreach($tahun_swot as $value_tahun)
                <div class="col-md-12" style="padding-bottom: 3%">
                    <div style="width: 100%;height: 15px; border-bottom: 1px solid black; text-align: center">
                          <span style="font-size: 20px; background-color: #ecf0f5; padding: 0 10px;">
                            {{ $value_tahun->tahun_swot }}
                          </span>
                    </div>
                </div>
                @foreach($data_swot as $value)
                    @if($value_tahun->tahun_swot == $value->tahun_swot)
                        <div class="col-md-6">
                            <div class="box @if($value->kategori_swot=="Strenght") box-primary @elseif($value->kategori_swot=="Weakness") box-warning @elseif($value->kategori_swot=="Opportunity") box-success @else  box-danger  @endif collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><b>{{ $value->kategori_swot }}</b></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>

									<!-- /.box-body 1-->
                                <div class="box-body">
                                    {!! $value->Isi  !!}
                                    <form action="{{ url('delete-swot/'. $value->id) }}" method="post">
                                        <input type="hidden" name="_method" value="put">
                                        {{ csrf_field() }}
                                        <button type="submit" onclick="return confirm('apakah anda akan menghapus target tahunan ini .. ?')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                        <a href="{{ url('ubah-swot/'. $value->id) }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-pencil"></i></a>
                                    </form>
                                </div>
                                <!-- /.box-body 2-->
                            </div>
                            <!-- /.box -->
                        </div>
                    @endif
                @endforeach
            @endforeach
            {{ $tahun_swot->links() }}
        </div>
    </section>
    <!-- /.content -->
</div>
@stop