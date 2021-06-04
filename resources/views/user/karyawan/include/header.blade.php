<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>MM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>aturusaha.</b>com</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <span class="pull-right"><font color="#F3A112">Keluar</font></span>
                </a>
                <ul class="dropdown-menu"></br>
                    <!-- Menu Body -->
                     <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="{{ url('logout-karyawan') }}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                        <div class="pull-left">
                            <a href="{{ url('ganti-password-karyawan') }}" class="btn btn-default btn-flat">Ganti Password</a>
                        </div>
                    </li>
                </ul>
             </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
