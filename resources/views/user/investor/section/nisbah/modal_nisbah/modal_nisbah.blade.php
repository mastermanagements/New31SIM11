<div class="modal fade" id="modal-nisbah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Daftar Nisbah Per Periode</h4>
            </div>

            <div class="modal-body">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Periode Investaso</th>
                        <th>Pelaku %</th>
                        <th>Pemodal %</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                        @foreach($pi as $data)
                            <tr>
                                <form action="{{ url('store-nisbah') }}" method="post" >
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        {{ $data->nm_periode }}
                                        <input type="hidden" name="id_periode_invest" value="{{ $data->id }}">
                                    </td>
                                    <td><input type="text" name="pelaksana" min="0" max="100" class="form-control" value="@if(!empty($data->nisbah)) {{ $data->nisbah->pelaksana }} @endif"></td>
                                    <td><input type="text" name="pemodal" min="0" max="100" class="form-control" value="@if(!empty($data->nisbah)) {{ $data->nisbah->pemodal }} @endif"></td>
                                    <td>
                                        {{ csrf_field() }}
                                        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> simpan</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
