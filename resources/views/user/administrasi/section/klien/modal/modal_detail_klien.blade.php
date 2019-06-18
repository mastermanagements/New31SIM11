
<div class="modal fade" id="modal-detail-klien">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Data Klien</h4>
                </div>
                <div class="modal-body">
					@foreach($data_klien as $value)
                    <label for="exampleInputFile">Nama</label>
					<p>{{ $value->nm_klien }}</p>
					@endforeach
                </div>
				
                <div class="modal-footer">
                    {{ csrf_field() }}
              
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
