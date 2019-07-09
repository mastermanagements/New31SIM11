@extends('user.hrd.master_user')

@section('skin')
    <link rel="stylesheet" href="{{ asset('component/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('component/bower_components/select2/dist/css/select2.min.css') }}">
@stop

@section('master_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Content Compansable Factors
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">

                    <div class="col-md-12">
                        <div class="box box-primary collapsed">
                            <div class="box-header with-border">
                                <h3 class="box-title">FAKTOR :{{ $cf->cf->faktor }}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                               <p>
                                   SUB FAKTOR : {{ $cf->sub_faktor }}
                               </p><p>
                                   DEFINISI : {{ $cf->definisi }}
                               </p>

                                <table class="table table-bordered">
                                    <form action="{{ url('store-content-cf') }}" method="post">
                                    <tbody>
                                    <tr>
                                        <td  rowspan="3" style="width: 40%">
                                            <textarea name="kolom_content" class="form-control" placeholder="Isi Nama kolom ini sesuai kebutuhan" required>@if(!empty($cf->pokok_cf->content_ccf)){{ $cf->pokok_cf->content_ccf->first()->kolom_content }}@endif</textarea>
                                            <input type="hidden" name="id_sub_cf" value="{{ $cf->id }}">
                                            <small style="color: red">* tidak boleh kosong</small>
                                        </td>
                                        <th colspan="{{ $cf->pokok_cf->item_ccf->count('id') }}"rowspan="2">  {{ $cf->pokok_cf->nm_pokok_ccf }}</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        @if(!empty($cf->pokok_cf->item_ccf))
                                            @foreach($cf->pokok_cf->item_ccf as $item)
                                                <td>{{ $item->item_ccf}}</td>
                                            @endforeach
                                        @endif
                                        <td></td>
                                    </tr>
                                    @if(!empty($cf->pokok_cf->content_ccf))
                                        <ol type="a">
                                        @foreach($cf->pokok_cf->content_ccf as $conten_cf)
                                            <tr>
                                                <td><li>{{ $conten_cf->content_cf }}</li>  </td>
                                                @php($item = explode(',', $conten_cf->bobot_content_cf))
                                                @foreach($item as $isi)
                                                    <td>{{ $isi }}</td>
                                                @endforeach
                                                <td><button class="btn btn-danger"> Hapus </button></td>
                                            </tr>
                                        @endforeach
                                        </ol>
                                    @endif
                                    <tr>
                                        <td>
                                            <textarea name="content_cf" class="form-control" placeholder="Masukan konten anda disini" required></textarea>
                                            <input type="hidden" name="id_pokok_cf" value="{{ $cf->pokok_cf->id }}">
                                            <small style="color: red">* tidak boleh kosong</small>
                                        </td>
                                        @if(!empty($cf->pokok_cf->item_ccf))
                                            @foreach($cf->pokok_cf->item_ccf as $item)
                                                <td><input name="bobot_content_cf[]" class="form-control"/></td>
                                            @endforeach
                                        @endif
                                        <td>{{ csrf_field() }}<button type="submit" class="btn btn-primary">simpan</button></td>
                                    </tr>
                                    </tbody>
                                    </form>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

            </div>

        </section>
        <!-- /.content -->
    </div>

    @include("user.penggajian.section.SubCompansableFactors.modal.modal")
@stop

@section('plugins')
    <script src="{{ asset('component/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('component/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years"
        });

        setIDCF= function(id){
            $('[name="id_cf"]').val(id);
            $('#modal-subcf').modal('show');
        }

       update=function (id) {
          $.ajax({
              url: "{{ url('edit-sub-cf') }}/"+id,
              dataType: "json",
              success: function (result) {
                  console.log(result);
                  $('[name="sub_faktor"]').val(result.sub_faktor);
                  $('[name="definisi"]').val(result.definisi);
                  $('[name="bobot_subcf"]').val(result.bobot_subcf);
                  $('[name="id"]').val(result.id);
                  $('[name="id_cf"]').val(result.id_cf);
                  $('#formulir').attr('action', '{{ url('update-sub-cf') }}');
                  $('#modal-subcf').modal('show');
              }
          })
       }
    </script>
@stop