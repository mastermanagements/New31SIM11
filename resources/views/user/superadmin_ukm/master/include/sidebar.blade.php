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
            <li class="header">LIST MENU</li>
            <!-- Optionally, you can add icons to the links -->
            @if(!empty($main_menu=Session::get('main_menu')))
                @php($explode = explode('-', $main_menu))
            @else
                @php($explode = null)
            @endif

            <li class="treeview @if($explode[0]=="pengaturan_awal") active menu-open @endif" >
                <a href="#">
                    <i class="fa fa-gears"></i> <span>Pengaturan Awal</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if($explode[1]=="data_perusahaan") active @endif"><a href="{{ url('dashboard') }}" ><i class="fa fa-building"></i> <span>Data Perusahaan</span></a></li>
                    <li class="@if($explode[1]=="pengguna_karyawan") active @endif"><a href="{{ url('pengguna-karyawan') }}" ><i class="fa fa-users"></i> <span>Pengguna Karyawan</span></a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>