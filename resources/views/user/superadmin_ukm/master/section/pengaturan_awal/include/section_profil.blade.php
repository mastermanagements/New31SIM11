<div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="
                            @if(empty($profil_user_ukm->foto))
            {{ asset('image_superadmin_ukm/default.png') }}
            @else
            {{ asset('image_superadmin_ukm/'.$profil_user_ukm->foto) }}
            @endif
            " alt="User profile picture">

            <h3 class="profile-username text-center">{{ $data_user->nama }}</h3>

            <ul class="list-group list-group-unbordered">

                <li class="list-group-item">
                    <b>Email</b> <a class="pull-right">{{ $data_user->email }}</a>
                </li>
                <li class="list-group-item">
                    <b>Alamat </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->alamat))
                            <p style="color: red">Belum diisi..!</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->alamat }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>Provinsi </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->getUserProvinsi->nama_provinsi))
                            <p style="color: red">Belum diisi..!</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->getUserProvinsi->nama_provinsi }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>Kabupaten</b> <a class="pull-right">
                        @if(empty($profil_user_ukm->getUserKabupaten->nama_kabupaten))
                            <p style="color: red">Belum diisi..!</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->getUserKabupaten->nama_kabupaten }}</a>
                        @endif
                    </a>
                </li>

                <li class="list-group-item">
                    <b>No.Handphone </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->hp))
                            <p style="color: red">Belum diisi..!</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->hp }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>No.Whatshap </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->wa))
                            <p style="color: red">Belum diisi..!</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->wa }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>No.Telegram </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->telegram))
                            <p style="color: orange">Isi jika ada</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->telegram }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>Facebook</b> <a class="pull-right">
                        @if(empty($profil_user_ukm->fb))
                            <p style="color: orange">Isi jika ada</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->fb }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>Instagram </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->ig))
                            <p style="color: orange">Isi jika ada</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->ig }}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>Twitter </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->twitter))
                            <p style="color: orange">Isi jika ada</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->twitter}}</a>
                        @endif
                    </a>
                </li>
                <li class="list-group-item">
                    <b>Tiktok </b> <a class="pull-right">
                        @if(empty($profil_user_ukm->tiktok))
                            <p style="color: orange">Isi jika ada</p>
                        @else
                            <a class="pull-right">{{ $profil_user_ukm->tiktok }}</a>
                        @endif
                    </a>
                </li>
            </ul>
            @if(!empty(session('message_success')))
                <p style="color: green; text-align: center">*{{ session('message_success')}}</p>
            @elseif(!empty(session('message_fail')))
                <p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
            @endif
            @if(empty($profil_user_ukm))
                <div style="width: 100%">
                    <p style="color: red">Lengkapi data profil anda ...!</p>
                </div>
            @endif
            <a href="{{ url('editprofile') }}" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> <b>Edit Profil</b></a></br>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
