@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Halaman Penilaian Keahlian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-penilaian-keahlian/'.$pelamar->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Masukan penilaian</a>
        <p></p>
        <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Penilaian</h3>
                            </div>

                            <div class="box-body">
                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif

                               @if(empty($penilaian))
                               <div class="row">

                                   <div class="col-md-12">
                                     <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                        Belum ada penilaian
                                     </p>
                                   </div>

                               </div>
                               @else
                                @foreach($penilaian as $value)
                                            <div class="row">
                                                <div class="col-md-9" style="width: 80%">
                                                    <label style="font-size: xx-large">{{ $value->item_tes_keahlian->item_tes_keahlian }}</label>
                                                </div>
                                                <div class="col-md-2 pull-right">
                                                    <button class="btn btn-success" style="width: 100%"><label style="font-size: 24px;color: white"> + {{ $value->nilai_akhir }}</label></button>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                        {{ $value->ket }}
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            Aksi
                                                        </div>
                                                        <div class="col-md-9">
                                                            <form action="{{ url('hapus-hasil-keahlian/'.$value->id) }}" method="post" class="pull-right">
                                                                <input type="hidden" name="_method" value="put">
                                                                {{ csrf_field() }}
                                                                <a href="{{ url('ubah-hasil-keahlian/'.$value->id) }}" class="btn btn-xs btn-warning">Ubah</a>
                                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ...?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <hr>
                                @endforeach
                               @endif
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@stop
