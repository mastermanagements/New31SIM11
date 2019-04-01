@extends('user.karyawan.master_user')


@section('master_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Job Desc
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
        <a href="{{ url('tambah-job-decs') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> Tambah Job decs</a>
        <p></p>
        <div class="row">

            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            <p></p>

            @if(!empty($data_jd))
                @foreach($data_jd as $data)
                        <div class="col-md-12">
                            <div class="box box-success box-solid">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <p>
                                        <form action="{{ url('hapus-JD/'. $data->id) }}" method="post">
                                            <input type="hidden" name="_method" value="put">
                                            {{ csrf_field() }}
                                            <button type="submit" onclick="return confirm('apakah anda akan menghapus job decs ini .. ?')" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button> <label> </label>
                                            <a href="{{ url('ubah-job-decs/'. $data->id) }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-pencil"></i></a>
                                        </form>
                                        <hr>
                                    </p>
                                    {!! $data->job_desc !!}
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    {{ $data_jd->links() }}
                    @endforeach
                @else
                <h3>Job decs belum ditambahkan</h3>
             @endif
        </div>
    </section>
    <!-- /.content -->
</div>
@stop