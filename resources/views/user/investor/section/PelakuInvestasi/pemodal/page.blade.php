<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Tahun dividen</label>
            <input type="text" class="form-control" name="thn" id="datepicker" value="{{ $thn_proses }}">
            <small style="color: darkgray">* Tahun akan disetting otomatis berdasarkan tahun server</small>
        </div>
    </div>

    {{--<div class="col-md-12" >--}}
        {{--<div class="row" >--}}
            {{--@php($i=1)--}}
            {{--@foreach($ymd->month->semua_bulan as $key => $value)--}}
                {{--@php($i++)--}}
                {{--<div class="col-md-2" style="margin: 2px; margin-left: 0px;margin-right: 0px">--}}
                    {{--<button class="btn @if($i % 2) btn-success @else btn-danger @endif" style="width: 100%"> {{ $value }}</button>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                <button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-divide-perbulan"> <i class="fa fa-plus"></i> Bulan Dividen</button>
                <table id="example1" class="table table-bordered table-striped tbdividenPerusahaan" style="width: 100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun Dividen</th>
                        <th>Bulan Dividen</th>
                        <th>Laba Rugi</th>
                        <th>Alokasi Kas</th>
                        <th>Net Kas</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->thn_dividen}} </td>
                            <td>{{ date('M', strtotime($value->bln_dividen)) }}</td>
                            <td>{{ number_format($value->laba_rugi,2,',','.') }}</td>
                            <td>{{ number_format($value->alokasi_kas,2,',','.') }}</td>
                            <td>{{ number_format($value->net_kas,2,',','.') }}</td>
                            <td>
                                <form action="{{ url('delete-divine-bulanan/'. $value->id) }}" method="post">
                                    <input type="hidden" name="_method" value="put">
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-warning" onclick="edit_divide_per_bulan('{{ $value->id }}')">ubah</button>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda akan menghapus data ini ... ?')">hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>