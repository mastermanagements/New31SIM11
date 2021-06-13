@extends('user.administrasi.master_user')



@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            BA. Serah Terima Operasionals untuk SPK : {{ $spk->no_spk }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar BA. Serah Terima Operasional / Pemeliharaan </a></li>
						<h5 class="pull-right"><a href="{{ url('SPK-Kontrak')}}"><font color="#1052EE">Kembali ke Halaman Utama</font>&nbsp;&nbsp;&nbsp;&nbsp;</a></h5>
                  </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-4" style="margin: 0">
                                    <form action="{{ url('BA-Serops-tambah/'.$spk->id) }}" method="get">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary" style="width: 100%"><i class="fa fa-plus"></i> Tambah BA. Serah Terima Operasional</button>
                                    </form>
                                </div>
                                <div class="col-md-8" >
                                    <form action="{{ url('cari-serops') }}" method="post" style="width: 100%">
                                        <div class="input-group input-group-md" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id_spk" value="{{ $spk->id }}">
                                            <input type="text" name="isi_serop" class="form-control" placeholder="cari berdasarkan isi BA Serah Terima Operasional" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                @if(!empty($save) && $save=="save")
                                   @include('user.administrasi.section.BAserops.form.BAserops')
                                @elseif(!empty($save) && $save=="update")
                                    @include('user.administrasi.section.BAserops.form.BAseropsUpdate')
                                @endif
                                @if(empty($dataSerops))
                                    <div class="col-md-12"> <h4 align="center">Anda belum menambahkan BA. Serah Terima Operasional untuk SPK: {{ $spk->no_spk }}</h4></div>
                                @else
                                    @foreach($dataSerops as $value)
                                            <div class="col-md-6">
                                                <div class="box box-solid">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                @if(empty($value->file_serops))
                                                                    <img src="{{ asset('coverDirectori/default.png') }}" width="130" height="180">
                                                                @else
                                                                   <a href="{{ asset('fileBaSertim/'.$value->file_serops) }}"><img src="{{ asset('fileBApem/default.png') }}" width="130" height="180"></a>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if(empty($value->scan_file))
                                                                    <img src="{{ asset('coverDirectori/default.png') }}" width="130" height="180">
                                                                @else
                                                                   <a href="{{ asset('fileBaSertimScan/'.$value->scan_file) }}"><img src="{{ asset('fileBApem/default.png') }}" width="130" height="180"></a>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {!! $value->isi_serops	 !!}
                                                                    </div>
                                                                   <div class="col-md-12 ">
                                                                       <div class="row">
                                                                           <div class="col-md-6 ">
                                                                            <form action="{{ url('BA-Serops-ubah/'.$value->id.'/'.$value->id_spk ) }}" method="get">
                                                                                {{ csrf_field() }}
                                                                                <button type="submit" class="btn btn-warning">ubah</button>
                                                                            </form>
                                                                           </div>
                                                                           <div class="col-md-6">
                                                                             <form action="{{ url('BA-Serops-delete/'.$value->id) }}" method="post">
                                                                                 {{ csrf_field() }}
                                                                                 <input type="hidden" name="_method" value="put">
                                                                                 <button type="submit" onclick="return confirm('Apakah anda yakin akan menghapus data ini..?')" class="btn btn-danger">hapus</button>
                                                                             </form>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                    @endforeach
                                    {{ $dataSerops->links() }}
                                @endif
                            </div>
                        <div class="tab-pane" id="tab_2">

                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
{{--@include('user.administrasi.section.spk.Modal.modal_upload_file_spk')--}}
@stop
