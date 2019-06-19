@extends('user.hrd.master_user')

@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daftar Karyawan
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <div class="row">
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
                @if(empty($Data_Karyawan))
                    <div class="col-md-12">
                        <h5>Peserta Karyawan Belum Tersedia</h5>
                    </div>
                @else
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Periode Kerja</h3>
                            </div>

                            <div class="box-body">
                                @if(!empty(session('message_success')))
                                    <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
                                @elseif(!empty(session('message_fail')))
                                    <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
                                @endif
                                    <table id="example1" class="table table-bordered table-striped">
                                        <input type="hidden" name="_id_rencana_pelatihan" value="{{ $rencana_pelatihan->id }}">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama Karyawan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=1)
                                        @foreach($Data_Karyawan as $values)
                                            <tr>
                                                <th>{{ $i++ }}</th>
                                                <td>{{ $values->nik }}</td>
                                                <td>{{ $values->nama_ky }}</td>
                                                <td>

                                                    <input type="checkbox" name="_ikut" value="{{ $values->id }}"
                                                        @if(!empty($values->get_pelatihan_karyawan->id))
                                                            checked
                                                        @endif
                                                    > Daftarkan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>

                @endif
        </div>
    </section>
    <!-- /.content -->
</div>

@stop

@section("plugins")
    <script>
        $(document).ready(function () {
            $('[name="_ikut"]').change(function () {
                if(this.checked == true){
                    $.ajax({
                       url : "{{ url('daftarkan_peserta') }}",
                       type : "post",
                       data: {
                           '_token' : '{{ csrf_token() }}',
                           'id_pelatihan': $('[name="_id_rencana_pelatihan"]').val(),
                           'id_karyawan' : $(this).val()
                       },
                       success: function(result){
                           alert("Karyawan telah terdaftar dalam peserta pelatihan "+ result.judul_pelatihan);
                       }
                    });

                }else{
                    $.ajax({
                        url : "{{ url('batal_daftarkan_peserta') }}",
                        type : "post",
                        data: {
                            '_token' : '{{ csrf_token() }}',
                            'id_pelatihan': $('[name="_id_rencana_pelatihan"]').val(),
                            'id_karyawan' : $(this).val()
                        },
                        success: function(result){
                            alert("Karyawan telah dibatalkan dalam peserta pelatihan :"+ result.judul_pelatihan);
                        }
                    });
                }
            })
        })
    </script>    
@stop
