@extends('user.administrasi.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jenis Kontrak Kerja
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Jenis Kontrak Kerja</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-jenis-psikotes"><i class="fa fa-plus"></i> Tambah Jenis Kontrak Kerja</a>
                            <p></p>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Psikotes</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($jenis_kontrak as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->jenis_kontrak }}</td>
                                        <td>
                                            <form action="{{ url('hapus-jenis-kontrak-kerja/'.$value->id) }}" method="post">
                                                <a href="#" onclick="ubahForm('{{ $value->id }}')" class="btn btn-warning" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus wawancara ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
    @include('user.hrd.section.kontrak_kerja.kt_kerja.jenispsikotes.modal.modal')
@stop
@section('plugins')
    <script>
        $(document).ready(function () {
            ubahForm = function (id) {
               $.ajax({
                    url: "{{ url('ubah-jenis-kontrak-kerja')  }}/"+id,
                    dataType:"json",
                    success: function (result) {
                        $('[name="jenis_kontrak_kerja_ubah"]').val(result.jenis_kontrak);
                        $('[name="id_jenis_kontrak_kerja"]').val(result.id);
                        $('#modal-ubah-jenis-psikotes').modal('show');
                    }
                });
            }
        });
    </script>
@stop