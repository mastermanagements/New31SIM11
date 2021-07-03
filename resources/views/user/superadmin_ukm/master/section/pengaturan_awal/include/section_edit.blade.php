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

            <div class="form-group">Foto :
              <input class="form-control input-sm" type="file" name="foto" value="$profil_user_ukm->foto">          
            </div>

            <div class="form-group">
              <input class="form-control input-sm" type="text" name="nama" value="{{ $data_user->nama }}" required>
              <small style="color:red;">* Tidak boleh kosong</small>
            </div>
            <ul class="list-group list-group-unbordered">
                <div class="form-group">
                    <a><input type="hidden" class="form-control input-sm" name="email" value="{{ $data_user->email }}" readonly></a>
                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm->alamat))
                            <a><input type="text" class="form-control" style="width:100%" name="alamat" placeholder="Alamat"></a>
                        @else
                            <a ><input type="text" class="form-control" style="width:100%" name="alamat" value="{{ $profil_user_ukm->alamat}}"></a>
                        @endif
                </div>
                <div class="form-group">
                        @if(empty($profil_user_ukm))
                           <select class="form-control select2" style="width: 100%;" name="id_provinsi">
                                <option>Pilih Provinsi</option>
                                @foreach($provinsi as $value)
                                 <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                                @endforeach
                            </select>
                       @else
                                <select class="form-control select2" style="width: 100%;" name="id_provinsi">
                                    <option>Pilih Provinsi </option>
                                    @foreach($provinsi as $value)
                                        <option value="{{ $value->id }}" @if($profil_user_ukm->getUserProvinsi->id == $value->id) selected @endif>{{ $value->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                        @endif
                        <small style="color:red;">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
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
                            <small style="color:red;">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm))
                            <a ><input type="text" class="form-control" style="width:100%" name="hp" placeholder="No.Handphone" required></a>
                        @else
                            <a ><input type="text" class="form-control" style="width:100%" name="hp" value="{{ $profil_user_ukm->hp }}" placeholder="HP" required></a>
                        @endif
                           <small style="color:red;">* Tidak boleh kosong</small>
                </div>
                <div class="form-group">
                        @if(empty($profil_user_ukm))
                            <a ><input type="text" class="form-control input-sm" name="wa"  placeholder="No.Whatshapp" required></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="wa" value="{{ $profil_user_ukm->wa }}" required></a>
                        @endif
                            <small style="color:red;">* Tidak boleh kosong</small>

                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm->telegram))
                            <a ><input type="text" class="form-control input-sm" name="telegram" placeholder="Telegram"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="telegram" value="{{ $profil_user_ukm->telegram }}"></a>
                        @endif
                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm->fb))
                            <a ><input type="text" class="form-control input-sm" name="fb" placeholder="Facebook"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="fb" value="{{ $profil_user_ukm->fb }}"></a>
                        @endif
                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm->ig))
                            <a ><input type="text" class="form-control input-sm" name="ig" placeholder="ig"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="ig" value="{{ $profil_user_ukm->ig }}"></a>
                        @endif
                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm->twitter))
                            <a ><input type="text" class="form-control input-sm" name="twitter" placeholder="Twitter"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="twitter" value="{{ $profil_user_ukm->twitter }}"></a>
                        @endif
                </div>
                <div class="form-group">
                       @if(empty($profil_user_ukm->tiktok))
                            <a ><input type="text" class="form-control input-sm" name="tiktok" placeholder="Tiktok"></a>
                        @else
                            <a ><input type="text" class="form-control input-sm" name="tiktok" value="{{ $profil_user_ukm->tiktok }}"></a>
                        @endif
                </div>
            </ul>
            @if(empty($profil_user_ukm))
                <div style="width: 100%">
                    <p style="color: red">Lengkapi data profil anda ...!</p>
                </div>
            @endif
                {{ csrf_field() }}
                <input hidden="hidden" name="_method" value="put">
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
                    dataType: "json",
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
