<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('component/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">LIST MENU </li>
            @if(!empty($daftar_menu))
                @foreach($daftar_menu as $menus)
                    <li class="treeview" >
                        <a href="#">
                            <i></i> <span style="font-weight: bold">{{ $menus->getMasterMenu->nm_menu }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        @if(!empty($submenu=$menus->getSubMenu))
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
              <p style="color: orange">Daftar menu ini adalah hak akses yang diberikan oleh superadmin</p>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>