<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ @asset('component/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Avatar</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU OWNER/FOUNDER</li>

            <!-- Optionally, you can add icons to the links -->
            @if(!empty($main_menu=Session::get('main_menu')))
                @php($explode = explode('-', $main_menu))
            @else
                @php($explode = null)
            @endif

            <li class="treeview-menu">
                <li class="@if($explode[1]=="data_perusahaan") active @endif"><a href="{{ url('pengaturan-perusahaan') }}" ><i class="fa fa-building"></i> <span>Data Perusahaan</span></a></li>
                <li class="@if($explode[1]=="menu_perusahaan") active @endif"><a href="{{ url('menu-perusahaan') }}" ><i class="fa fa-list"></i> <span>Menu Aktif Perusahaan</span></a></li>
                <li class="@if($explode[1]=="pengguna_karyawan") active @endif"><a href="{{ url('pengguna-karyawan') }}" ><i class="fa fa-users"></i> <span>Pengguna Aplikasi</span></a></li>
                <li class="@if($explode[1]=="pengguna_karyawan") active @endif"><a href="{{ url('mentoring-bisnis') }}" ><i class="fa fa-fw fa-cube"></i> <span>Pendampingan Bisnis</span></a></li>
                <li class="@if($explode[1]=="pengguna_karyawan") active @endif"><a href="{{ url('pendanaan') }}" ><i class="fa fa-fw fa-dollar"></i> <span>Pendanaan</span></a></li>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
