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
            <li class="header">LIST MENU </li>
           @if(!empty($daftar_menu['daftar_menu']))
                @foreach($daftar_menu['daftar_menu'] as $menus)
                    <li class="treeview" >
                        <a href="#">
                            <i></i> <span style="font-weight: bold">{{ $menus->getMasterMenu->nm_menu }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        @if(!empty($submenu=$menus->getSubMenu->sortBy('id_master_submenu')))
                            <ul class="treeview-menu">
                            @foreach($submenu as $sKey => $sum_menu)
                                @if(!empty($Menu_karyawan = $sum_menu->getMenuKaryawan->where('id_karyawan', Session::get('id_karyawan'))))
                                    @foreach($Menu_karyawan as $menus_karyawan)
                                        <li ><a href="{{ url($sum_menu->getMasterSubMenuUKM->url) }}" ><i ></i> <span>{{ $sum_menu->getMasterSubMenuUKM->nm_submenu }}</span></a></li>
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