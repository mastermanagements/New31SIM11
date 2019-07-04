@extends('user.hrd.master_user')

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tes Kemanajerialan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                <div class="col-md-12" >
                    <form action="{{ url('cari-tes-km') }}" method="post" style="width: 100%">
                        <div class="input-group input-group-md" >
                            {{ csrf_field() }}
                            <input type="text" name="nm_ky" class="form-control" placeholder="cari karyawan" required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <p> </p>
            <div class="row">
                @foreach($ky as $value)
                    <div class="col-md-6">
                        <div class="box box-primary collapsed">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $value->nama_ky }}</h3>
                                <div class="box-tools pull-right">
                                    <a href="{{ url('formulir-tes-kemanajerialan/'. $value->id) }}" class="btn btn-success" ><i class="fa fa-plus"></i> Penilaian</a>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                   </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($value->get_MannyTesKemanajerialan->sortByDesc('thn_tes_km')->groupBy('thn_tes_km') as $tahun => $penilaian)
                                            <tr>
                                                <th>{{ $tahun }}</th>
                                                <th>
                                                    @php($nilai_total = 0)
                                                    @foreach($penilaian as $value)
                                                        @php($nilai_total += $value->nilai_km)
                                                    @endforeach
                                                    {{ $nilai_total/$penilaian->count() }}
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                @endforeach
                {{ $ky->links() }}
            </div>

        </section>
        <!-- /.content -->
    </div>

@stop
