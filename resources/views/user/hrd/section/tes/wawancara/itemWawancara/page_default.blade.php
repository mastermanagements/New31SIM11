@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item Wawancara
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Daftar Item Wawancara </a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-item-wawancara"><i class="fa fa-plus"></i> Tambah Item Wawancara</a>
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
                                @foreach($itemWawancara as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->item_wawancara }}</td>
                                        <td>
                                            <form action="{{ url('hapus-item-wawancara/'.$value->id) }}" method="post">
                                                <a href="#" onclick="ubahForm('{{ $value->id }}')" class="btn btn-warning" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put"/>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus item wawancara ini ...?')" title="Hapus"><i class="fa fa-eraser"></i></button>
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
    @include('user.hrd.section.tes.wawancara.itemWawancara.modal.modal')
@stop
@section('plugins')
    <script>
        $(document).ready(function () {
            ubahForm = function (id) {
               $.ajax({
                    url: "{{ url('ubah-item-wawancara')  }}/"+id,
                    dataType:"json",
                    success: function (result) {
                        $('[name="item_wawancara_ubah"]').val(result.item_wawancara);
                        $('[name="id_item_wawancara"]').val(result.id);
                        $('#modal-ubah-item-wawancara').modal('show');
                    }
                });
            }
        });
    </script>
@stop