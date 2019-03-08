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
            <li class="active"><a href="{{ url('dashboard') }}"><i class="fa fa-gears"></i> <span>Pengaturan Awal</span></a></li>
            <li><a href="#"><i class="fa fa-group"></i> <span>Pengguna Karyawan</span></a></li>
            <li><a href="#"><i class="fa fa-chain"></i> <span>Pengaturan Menu</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>