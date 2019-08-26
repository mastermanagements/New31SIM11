<div class="row">
    <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body" style="">
                <h4 style="margin-top: 0px">Daftar Proyek</h4>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. SPK</th>
                        <th>Proyek</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($proyek as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->spk->no_spk }}</td>
                            <td>{{ $value->spk->nm_spk }}</td>
                            <td><a href="{{ url('Skala-bonus-proyek/'. $value->id) }}" class="btn btn-success">Lihat detail Bonus Proyek</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>