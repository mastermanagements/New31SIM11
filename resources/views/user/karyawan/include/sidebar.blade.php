

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if(!empty($daftar_menu['karyawan']))
        <div class="user-panel">
            @if(!empty($daftar_menu['karyawan']->pas_foto))
            <div class="pull-left image">
                <img src="{{ asset('filePFoto/'.$daftar_menu['karyawan']->pas_foto ) }}" style="width: 100%; height: 100%" class="img-circle" alt="User Image">
            </div>
            @else
                <div class="pull-left image">
                    <img src="{{ asset('image_superadmin_ukm/default.png') }}" class="img-circle" alt="User Image">
                </div>
            @endif
            <div class="pull-left info">
                <p>{{ $daftar_menu['karyawan']->nama_ky }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        @else
            <h6>Profil Karyawan tidak ditemukan</h6>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">LIST MENU KARYAWAN</li>
           @if(!empty($daftar_menu['daftar_menu']))
                @foreach($daftar_menu['daftar_menu'] as $mKey=> $menus)
                    <li class="treeview @if(Session::get('main_menu')==$mKey) active menu-open @endif" >
                        <a href="#">
                            <i></i> <span style="font-weight: bold">{{ $menus->getMasterMenu->nm_menu }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        @if(!empty($submenu=$menus->getSubMenu->sortBy('urutan')))
                            <ul class="treeview-menu">
                            @foreach($submenu as $sKey => $sum_menu)
                                @if(!empty($Menu_karyawan = $sum_menu->getMenuKaryawan->where('id_karyawan', Session::get('id_karyawan'))))
                                    @foreach($Menu_karyawan as $menus_karyawan)
                                        <li class="@if(Session::get('main_menu')==$mKey && Session::get('sub_menu')==$sKey) active @endif"><a
                                                    @if($sum_menu->getMasterSubMenuUKM->url=="BA-Pemeriksaan")
                                                    href="#"
                                                    data-toggle="modal" data-target="#modal-menu-ba-pemeriksaan"
                                                    @elseif($sum_menu->getMasterSubMenuUKM->url=="BA-Kemajuan")
                                                    href="#"
                                                    data-toggle="modal" data-target="#modal-menu-ba-kemajuan"
                                                    @elseif($sum_menu->getMasterSubMenuUKM->url=="BA-Penyelesaian")
                                                    href="#"
                                                    data-toggle="modal" data-target="#modal-menu-ba-penyelesaian"
                                                    @elseif($sum_menu->getMasterSubMenuUKM->url=="BA-Serah-Terima")
                                                    href="#"
                                                    data-toggle="modal" data-target="#modal-menu-ba-sertim"
                                                    @elseif($sum_menu->getMasterSubMenuUKM->url=="BA-Serah-Terima-Operasional")
                                                    href="#"
                                                    data-toggle="modal" data-target="#modal-menu-ba-serops"

                                                    @else
                                                    href="#"
                                                        onclick="setSession('{{ url($sum_menu->getMasterSubMenuUKM->url) }}', '{{ $mKey }}','{{ $sKey }}')"
                                                    @endif

                                            ><i></i> <span>{{ $sum_menu->getMasterSubMenuUKM->nm_submenu }}</span></a></li>
                                    @endforeach
                                @endif
                            @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @else
              <p style="color: orange;" >Daftar menu ini adalah hak akses yang diberikan oleh superadmin</p>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>


<div class="modal fade" id="modal-menu-ba-pemeriksaan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('Ba-Pemeriksaan') }}" method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilihan SPK</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih SPK</label>
                        <select class="form-control select2" style="width: 100%;" name="id" required>
                            @if(empty($daftar_menu['spk']))
                                <option>SPK Belum Tersedia</option>
                            @else
                                @foreach($daftar_menu['spk'] as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit"  class="btn btn-primary">Pergi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-menu-ba-kemajuan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('BA-Kemajuan') }}" method="get">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilihan SPK</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih SPK</label>
                        <select class="form-control select2" style="width: 100%;" name="id" required>
                            @if(empty($daftar_menu['spk']))
                                <option>SPK Belum Tersedia</option>
                            @else
                                @foreach($daftar_menu['spk'] as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit"  class="btn btn-primary">Pergi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-menu-ba-penyelesaian">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('BA-Penyelesaian') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilihan SPK</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih SPK</label>
                        <select class="form-control select2" style="width: 100%;" name="id" required>
                            @if(empty($daftar_menu['spk']))
                                <option>SPK Belum Tersedia</option>
                            @else
                                @foreach($daftar_menu['spk'] as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit"  class="btn btn-primary">Pergi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-menu-ba-sertim">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('BA-Sertim') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilihan SPK</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih SPK</label>
                        <select class="form-control select2" style="width: 100%;" name="id_spk" required>
                            @if(empty($daftar_menu['spk']))
                                <option>SPK Belum Tersedia</option>
                            @else
                                @foreach($daftar_menu['spk'] as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit"  class="btn btn-primary">Pergi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-menu-ba-serops">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('BA-Serah-Terima-Operasional') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pilihan SPK</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih SPK</label>
                        <select class="form-control select2" style="width: 100%;" name="id_spk" required>
                            @if(empty($daftar_menu['spk']))
                                <option>SPK Belum Tersedia</option>
                            @else
                                @foreach($daftar_menu['spk'] as $value)
                                    <option value="{{ $value->id }}">{{ $value->nm_spk }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit"  class="btn btn-primary">Pergi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
