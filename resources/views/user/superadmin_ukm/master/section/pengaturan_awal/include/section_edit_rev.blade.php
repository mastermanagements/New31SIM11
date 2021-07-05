<div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
            <form action="{{ url('updateProfile/'.$data_user->id) }}" method="post" enctype="multipart/form-data">
				
            <img class="profile-user-img img-responsive img-circle" src="
                            @if(empty($profil_user_ukm->foto))
            {{ asset('image_superadmin_ukm/default.png') }}
            @else
            {{ asset('image_superadmin_ukm/'.$profil_user_ukm->foto) }}
            @endif
                    " alt="User profile picture">

            <h3 class="profile-username text-center">Foto :<input class="form-control input-sm" type="file" name="foto" id="foto"></h3>
            <h3 class="profile-username text-center"><input class="form-control input-sm" type="text" name="nama" value="{{ $data_user->nama }}" required>
            <small style="color:red;">* Tidak boleh kosalesng</small></h3>

            <p class="text-muted text-center">Owner Application</p>

            <ul class="list-group list-group-unbordered">

                <li class="list-group-item">
                    <a><input type="text" class="form-control input-sm" name="email" value="{{ $data_user->email }}" readonly></a>
                </li>
                <li class="list-group-item">
                        @if(empty($profil_user_ukm))
                           <select class="form-control select2" style="width: 100%;" name="id_provinsi">
                                <option>Pilih Provinsi</option>
                                @foreach($provinsi as $value)
                                 <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                                @endforeach
                            </select>
                       @else
                                <select class="form-control select2" style="width: 100%;" name="id_provinsi">
                                    <option>Pilih Provinsi</option>
                                    @foreach($provinsi as $value)
                                        <option value="{{ $value->id }}" @if($profil_user_ukm->getUserProvinsi->id == $value->id) selected @endif>{{ $value->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                        @endif
                            <small style="color:red;">* Tidak boleh kosalesng</small>
                </li>
                <li class="list-group-item">
                        @if(empty($profil_user_ukm))
                            <select class="form-control select2" style="width: 100%;" name="id_kabupaten">
                                <option>Pilih Kabupaten</option>
                            </select>
                       @else
                            <select class="form-control select2" style="width: 100%;" name="id_kabupaten">
                                <option>Pilih Kabupaten</option>
                                @foreach($kabupaten as $value)
                                    <option value="{{ $value->id }}" @if($profil_user_ukm->getUserKabupaten->id == $value->id) selected @endif>{{ $value->nama_kabupaten }}</option>
                                @endforeach
                            </select>
                       @endif
                            <small style="color:red;">* Tidak boleh kosalesng</small>
                </li>
                <li class="list-group-item">
                        @if(empty($profil_user_ukm))
                            <a ><input type="text" class="form-control input-sm"  style="width:100%" name="telp"  placeholder="No.Telepon"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" style="width:100%" name="telp" value="{{ $profil_user_ukm->telp }}"></a>
                        @endif 
							<small style="color:orange;">* Isi Jika ada</small>
                </li>
                <li class="list-group-item">
                       @if(empty($profil_user_ukm))
                            <a ><input type="text" class="form-control" style="width:100%" name="hp" placeholder="No.Handphone" required></a>
                        @else
                            <a ><input type="text" class="form-control" style="width:100%" name="hp" value="{{ $profil_user_ukm->hp }}" placeholder="No.Telepon" required></a>
                        @endif
                           <small style="color:red;">* Tidak boleh kosalesng</small>
                </li>
                <li class="list-group-item">
                        @if(empty($profil_user_ukm))
                            <a ><input type="text" class="form-control input-sm" name="wa"  placeholder="No.Whatshapp" required></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="wa" value="{{ $profil_user_ukm->wa }}" required></a>
                        @endif
                            <small style="color:red;">* Tidak boleh kosalesng</small>

                </li>
                <li class="list-group-item">
                       @if(empty($profil_user_ukm))
                            <a ><input type="text" class="form-control input-sm" name="telegram" placeholder="No.Telegram"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="telegram" value="{{ $profil_user_ukm->telegram }}"></a>
                        @endif
                           <small style="color:orange;">* Isi Jika ada</small>
                </li>
            </ul>
            @if(empty($profil_user_ukm))
                <div style="width: 100%">
                    <p style="color: red">Lengkapi data profil anda ...!</p>
                </div>
            @endif
                {{ csrf_field() }}
                <input hidden="hidden" name="_method" value="put">
				<input type="text" class="form-control input-sm" name="id" value="{{ $data_user->id }}" readonly></a>
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-pencil"></i> <b>Simpan</b></button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
           
@section('plugins')
    <script>
        $(document).ready(function () {
            $('[name="id_provinsi"]').change(function () {
                $.ajax({
                    url:"{{ url('getKabupaten') }}/" + $(this).val(),
                    dataType: "jsalesn",
                    success: function (result) {
                        var option="<option>Pilih Kabupaten</option>";
                        $.each(result, function (id, val) {
                            option+="<option value="+val.id+">"+val.nama_kabupaten+"</option>";
                        });
                        $('[name="id_kabupaten"]').html(option);
                    }
                })
            })
        })
    </script>
@stop