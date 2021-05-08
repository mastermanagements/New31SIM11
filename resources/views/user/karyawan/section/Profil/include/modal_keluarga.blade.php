<div class="modal fade" id="modal-ubah-keluarga">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Keluarga</h4>
            </div>
            <form action="{{ url('update-keluarga-ky') }}" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Ayah</label>
                    <input type="text" class="form-control" placeholder="" name="nm_ayah" value="@if(!empty($data_karyawan->getDataKeluarga->nm_ayah)) {{ $data_karyawan->getDataKeluarga->nm_ayah }} @endif" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status Ayah</label>

                    @foreach($status as $key => $value)
                    @if(!empty($data_karyawan->getDataKeluarga->status_a))
                    <input type="radio"  name="status_a" class="minimal" value="{{ $key }}" @if($data_karyawan->getDataKeluarga->status_a==$key) checked @else  @endif  required> {{ $value }}
                    @endif
                    @endforeach

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Ibu</label>

                    <input type="text" class="form-control" placeholder="" name="nm_ibu" value="@if(!empty($data_karyawan->getDataKeluarga->nm_ibu)) {{ $data_karyawan->getDataKeluarga->nm_ibu }} @endif" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status Ibu</label>
                    @foreach($status as $key => $value)
                    @if(!empty($data_karyawan->getDataKeluarga->status_i))
                        <input type="radio"  name="status_i" class="minimal" value="{{ $key }}" @if($data_karyawan->getDataKeluarga->status_i==$key) checked @else  @endif required> {{ $value }}
                    @endif
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Saudara</label>
                    <input type="text" class="form-control" placeholder="" name="jum_saudara" value="@if(!empty($data_karyawan->getDataKeluarga->jum_saudara)) {{ $data_karyawan->getDataKeluarga->jum_saudara }} @endif" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Anak Ke</label>
                    <input type="text" class="form-control" placeholder="" name="anak_ke" value="@if(!empty($data_karyawan->getDataKeluarga->anak_ke)) {{ $data_karyawan->getDataKeluarga->anak_ke }} @endif" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kontak Person Darurat</label>
                    <input type="text" class="form-control" placeholder="" name="cp_darurat" value="@if(!empty($data_karyawan->getDataKeluarga->cp_darurat)) {{ $data_karyawan->getDataKeluarga->cp_darurat }} @endif" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Telepon Darurat</label>
                    <input type="text" class="form-control" placeholder="" name="telp_darurat" value="@if(!empty($data_karyawan->getDataKeluarga->telp_darurat)) {{ $data_karyawan->getDataKeluarga->telp_darurat }} @endif" required>
                </div>
            </div>
            <div class="modal-footer">
                {{ csrf_field() }}
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-ubah-keluarga-file">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formulir Kartu Keluarga</h4>
            </div>
            <form action="{{ url('update-keluarga-ky-file') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">File Scan Kartu Keluarga</label>
                        <input type="file" class="form-control" name="file_kk"  required>
                        <span>@if(!empty($data_karyawan->getDataKeluarga->file_kk)) {{ $data_karyawan->getDataKeluarga->file_kk }} @endif</span>
                        <small>Disarankan Format File .jpg, .png, .gif</small>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
