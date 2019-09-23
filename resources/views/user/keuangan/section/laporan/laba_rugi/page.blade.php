<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $judul }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-center">
            <form action="#" id="setting_tanggal">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example_rincian" class="table table-bordered table-hover" style="width: 100%">

                            <tbody>
                            @php($total_debet=0)
                            @php($total_kredit=0)
                                @foreach($data as $data_laba_rugi)
                                    <tr colspan= "2" align="left" style="background-color: lightgrey">
                                        <td>{{ $data_laba_rugi['akun'] }}</td>
                                    </tr>
                                    {{--@php($total_debet+=$data_neraca['debet'])--}}
                                    {{--@php($total_kredit+=$data_neraca['kredit'])--}}
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>