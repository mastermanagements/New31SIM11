<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Intense Corporate Category Flat Bootstrap Responsive website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="keywords" content="Intense Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Custom Theme files -->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
    <link href="{{ asset('frontend/css/style.css') }}" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
</head>

<body>
<script src='{{ asset('frontend/js/jquery.min.js') }}'></script><script src="{{ asset('frontend/js/monetization.js') }}" type="text/javascript"></script>


<meta name="robots" content="noindex">
<body>
    <!-- header -->
    <header id="home">
        <div class="container">
            <div class="header d-lg-flex justify-content-between align-items-center py-sm-3 py-2 px-sm-2 px-1">
                <!-- logo -->
                <div id="logo">
                    <h1><a href="index.blade.php">ERP</a></h1>
                </div>
                <!-- //logo -->
                <!-- nav -->
                <div class="nav_w3ls ml-lg-5">
                    <nav>
                        <label for="drop" class="toggle">Menu</label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li><a href="index.blade.php" class="active klik_menu" id="home">Home</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#" class="klik_menu" id="pelatihan" >Pelatihan</a></li>
                            <li><a href="#" class="klik_menu" id="event" >Event</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li class="nav-right-sty mt-lg-0 mt-sm-4 mt-2">
                                <a href="#regis" class="reqe-button text-uppercase page-scroll regis">Registrasi</a>
                            </li>
                            <li class=" mt-lg-0 mt-sm-4 mt-4">
                                <!-- <a href="login.html" class="reqe-button text-uppercase">Login</a> -->

                                <a href="" class="reqe-button text-uppercase page-scroll">Login <span class="fa fa-angle-down" aria-hidden="true"></span></a>
                                <input type="checkbox" id="drop-2" />
                                <ul>
                                    <li><a href="{{  url('login-page') }}" class="drop-text owner">Owner</a></li>
                                    <li><a href="{{  url('login-karyawan') }}" class="drop-text karyawan">Karyawan</a></li>
                                    <li><a href="#investor" class="drop-text investor">Investor</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- //nav -->
            </div>
        </div>
    </header>
    <!-- //header -->
    <div class="content">
        <!-- banner -->
        <!-- banner -->
        <section class="banner">
            <!-- banner text -->
            <div class="container">
                <div class="banner_text_wthree_pvt">
                    <h3 class="home-banner-w3">ERP untuk UMKM</h3>

                    <p class="bnr-txt">ERP adalah sistem untuk mengatur operasional perusahaan seperti  pengelolaan administrasi, produksi, keuangan, marketing, SDM, proyek, penggajian, investasi dan lain sebagainya.
                    </p>
                    
                </div>
            </div>
            <!-- //banner text -->
            <!-- banner-bottom -->
            <div class="banner-bottom-w3ls">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a3.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Perancanaan</h3>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a2.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Kontrol</h3>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mx-auto mt-sm-0 mt-4">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a1.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Monitor</h3>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mx-auto mt-sm-0 mt-4">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a0.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Evaluasi</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //banner-bottom -->
        </section>

        <!-- about-->
        <section class="single_grid_w3_main align-w3-abt" id="about">
            <div class="container">
                <div class="row mb-5 f-owner" id="owner">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <p class="mb-5"><b>Login Owner</b></p>
                        <form>
                            <input type="text" class="mx-auto nama" placeholder="email">
                            <br/>
                            <input type="text" class="mx-auto pass" placeholder="password">
                        </form>
                        <button class="btn btn-primary mt-5 tombol">Login</button>
                    </div>
                </div>
                <div class="row mb-5 f-karyawan" id="karyawan">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <p class="mb-5"><b>Login Karyawan</b></p>
                        <form>
                            <input type="text" class="mx-auto nama" placeholder="email">
                            <br/>
                            <input type="text" class="mx-auto pass" placeholder="password">
                        </form>
                        <button class="btn btn-primary mt-5 tombol">Login</button>
                    </div>
                </div>
                <div class="row mb-5 f-investor" id="investor">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <p class="mb-5"><b>Login Investor</b></p>
                        <form>
                            <input type="text" class="mx-auto nama" placeholder="email">
                            <br/>
                            <input type="text" class="mx-auto pass" placeholder="password">
                        </form>
                        <button class="btn btn-primary mt-5 tombol">Login</button>
                    </div>
                </div>
                <div class="row mb-5 f-regis" id="regis">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <p class="mb-5"><b>Register</b></p>
                        <form>
                            <input type="text" class="mx-auto nama" placeholder="Nama">
                            <br/>
                            <input type="text" class="mx-auto nama" placeholder="email">
                            <br/>
                            <input type="text" class="mx-auto pass" placeholder="password">
                            <br/>
                            <input type="text" class="mx-auto pass" placeholder="password">
                        </form>
                        <br>
                        <div class="g-recaptcha move-left" data-sitekey="6LcTOr0UAAAAAGcl4liqP6-IPIvHpdr_m8jke99Y"></div>
                        <br>
                        <input type="checkbox" class="move-left"> Saya sudah membaca <a href="#" class="sarat"> syarat dan ketentuan</a>
                        <br>
                        <button class="btn btn-primary mt-5 tombol">Register</button>
                    </div>
                </div>
                <div class="wthree_pvt_title text-center">
                    <h4 class="w3pvt-title">Apakah Perusahaan Anda Sering Mengalami Masalah Seperti ?</h4>
                    <p class="sub-title">ERP tidak hanya untuk perusahaan besar, tapi UMKM juga perlu ERP untuk melakukan scale up bisnisnya.<br> Penggunaan ERP sejak awal untuk UKM memudahkan melakukan pengembangan usaha untuk  keluar dari zona UMKM. <br>UMKM perlu menggunakan aplikasi ERP karena:</p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-ravelry"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h5>Tidak Tahu Arah Perusahaan ke Depan ?</h5>
                                        <br>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut eaque eum, vitae voluptatem pariatur illo sint deserunt quia magnam, impedit ipsam id, aspernatur quas officiis necessitatibus quasi asperiores? Neque, minima? </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-lg-0 my-4">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-cubes"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h5>Produk Tidak Ada yang Laku ?</h5>
                                        <br>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia ab tenetur deserunt minus consectetur repellat, commodi itaque odit quam hic! Suscipit ipsum doloribus quam quidem, repudiandae autem quos voluptatem laboriosam!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-desktop"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h5>Bingung Monitoring Perusahaan ?</h5>
                                        <br>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam maxime laborum, dicta cupiditate impedit sint ex culpa voluptatibus. Consequuntur eum quaerat quas maxime, repellat explicabo quae asperiores voluptate dolorem cumque.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-lg-0 my-4">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-money"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h5>Keuangan Tidak Stabil ?</h5>
                                        <br>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat veniam ab veritatis, a commodi architecto itaque cumque officia totam repellendus labore repudiandae recusandae hic maiores amet provident tempora quidem dolores!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-group"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h5>HRD ?</h5>
                                        <br>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat veniam ab veritatis, a commodi architecto itaque cumque officia totam repellendus labore repudiandae recusandae hic maiores amet provident tempora quidem dolores!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-lg-0 my-4">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-area-chart"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h4>Marketing</h4>
                                        <p>Kontrol keuangan menjadi lebih mudah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-usd"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h4>Penggajian</h4>
                                        <p>Monitoring target perusahaan semakin cepat </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-lg-0 my-4">
                        <div class="abt-grid">
                            <div class="row">
                                <div class="col-3">
                                    <div class="abt-icon">
                                        <span class="fa fa-handshake-o"></span>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="abt-txt">
                                        <h4>Investor</h4>
                                        <p>Kontrol keuangan menjadi lebih mudah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //about --> 
        <section>
            <div class="container">
                <div class="wthree_pvt_title text-center">
                    <h4>ERP adalah sistem untuk mengatur operasional perusahaan seperti  pengelolaan administrasi, produksi, keuangan, marketing, SDM, proyek, penggajian, investasi dan lain sebagainya.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi dignissimos recusandae ut praesentium, facilis exercitationem eius, alias fuga deserunt minus commodi dolorem eaque pariatur laborum? Earum libero maiores omnis odit!
                    </h4>
                </div>
            </div>
        </section>

        <!-- slide -->
        <section class="wthree-slie-btm py-lg-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="slide-banner pl-0">

                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-4">
                        <div class="container">
                            <div class="wthree_pvt_title">
                                <h4 class="w3pvt-title">Bagaimana Cara Kerja Aplikasi ini?
                                </h4> <br>
                                <h5>
                                    ERP untuk UMKM ini adalah sistem yang akan mengotomasisi bisnis anda.
                                    mengelola bisnis anda cukup dengan satu aplikasi. Anda dapat menghandle semua sisi bisnis secara terintegrasi.
                                </h5>
                            </div>
                            <div class="row flex-column">
                                <div class="abt-grid">
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h3>Aplikasi ini berbasis Cloud, tinggal pakai saja </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h3>Aplikasi ini berbasis Cloud, tinggal pakai saja </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h3>Aplikasi ini berbasis Cloud, tinggal pakai saja </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="d-flex justify-content-start">
                                <a href="about.html" class="btn w3ls-btn">view more</a>
                            </div> -->
                        </div>
                        <div class="container">
                            <div class="wthree_pvt_title mt-4">
                                <h4 class="w3pvt-title">Siapa Pengguna Aplikasi ini ?
                                </h4> <br>
                                <h5>
                                    ERP untuk UMKM ini adalah sistem yang akan mengotomasisi bisnis anda.
                                    mengelola bisnis anda cukup dengan satu aplikasi. Anda dapat menghandle semua sisi bisnis secara terintegrasi.
                                </h5>
                            </div>
                            <div class="row flex-column">
                                <div class="abt-grid">
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h4>Fashion</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h4>Komputer Dan Elektronik</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h4>Pertanian</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h4>Perkebunan</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h4>Otomotif</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="d-flex justify-content-start">
                                <a href="about.html" class="btn w3ls-btn">view more</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //slide -->
        <!-- blog -->
        <section class="blog_w3ls align-w3" id="posts">
            <div class="container">
                <div class="wthree_pvt_title text-center">
                    <h4 class="w3pvt-title">Apa Keuntungannya Menggunakan Aplikasi ini?
                    </h4>
                </div>
                <div class="row space-sec">
                    <!-- blog grid -->
                    <div class="col-lg-4 col-md-6 mt-sm-0 mt-4">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="single.html">
                                    <img class="card-img-bottom" src="{{ asset('frontend/images/g1.jpg') }}" alt="Card image cap">
                                    <span class="post-icon">blog post</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="single.html">Cras ultricies ligula sed.</a>
                                </h5>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit
                                    ametLorem ipsum dolor sit amet,sed diam nonumy.</p>
                                <a href="single.html" class="blog_link">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- //blog grid -->
                    <!-- blog grid -->
                    <div class="col-lg-4 col-md-6 mt-md-0  mt-4">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="single.html">
                                    <img class="card-img-bottom" src="{{ asset('frontend/images/g2.jpg') }}" alt="Card image cap">
                                    <span class="post-icon">blog post</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="single.html">magna porta au blandita.</a>
                                </h5>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit
                                    ametLorem ipsum dolor sit amet,sed diam nonumy.</p>
                                <a href="single.html" class="blog_link">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- //blog grid -->
                    <!-- blog grid -->
                    <div class="col-lg-4 col-md-6 mt-lg-0 mt-4 mx-auto blog-end">
                        <div class="card">
                            <div class="card-header p-0  position-relative">
                                <a href="single.html">
                                    <img class="card-img-bottom" src="{{ asset('frontend/images/g3i.jpg') }}" alt="Card image cap">
                                    <span class="post-icon">blog post</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="single.html">Cras ultricies ligula sed.</a>
                                </h5>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor sit
                                    ametLorem ipsum dolor sit amet,sed diam nonumy.</p>
                                <a href="single.html" class="blog_link">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- //blog grid -->
                </div>
            </div>
        </section>
        <!-- //blog -->
        <section>
            <div class="container">
                <!-- iklan -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="image-ads mb-4 pl-5">
                            <h3 class="text-ads">
                                Tunggu apa lagi ? Saatnya kelola bisnis anda <br> secara terintegrasi agar bisnis anda <br> bisa melakukan scale up secepatnya
                            </h3>
                            <a href="" class="btn btn-primary"> <b> Daftar Gratis !!!</b> </a>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- akhir iklan -->
            <div class="container">
                <div class="row email">
                    <div class="col-md-6">
                        <h4 class="text-email">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo numquam odio fugiat ipsum architecto modi excepturi a aut tenetur ullam.
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="system-email">
                            <form class="f-email"> 
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- footer -->
    <footer class="footer py-md-5 pt-md-3 pb-sm-5">
        <div class="container">
            <div class="row p-sm-4 px-3 py-3">
                <div class="col-lg-4 footer-top mt-md-0 mt-sm-5">
                    <h3 class="mb-3 w3f_title">Kontak</h3>
                    <hr>
                    <div class="fv3-contact mt-2">
                        <p>
                            <a href="mailto:example@email.com">Email : info@erp.com</a>
                        </p>
                    </div>
                    <div class="fv3-contact my-2">
                        <p>Phone : +628975835238</p>
                    </div>
                    <div class="fv3-contact">
                        <p>Alamat : <br>Sukorame RT 17 Mangunan Dlingo Bantul
                            <br>DI Yogyakarta 55783.</p>
                    </div>
                </div>
                <div class="col-lg-8  col-md-6 mt-lg-0 mt-4">
                    <div class="footerv2-w3ls">```
                        <h3 class="mb-3 w3f_title">Ikuti Kami</h3>
                        <hr>
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.648302060571!2d110.43146201477899!3d-7.931751494286534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5366a01fb57b%3A0xa11927486ec839ca!2sQODR%20HQ!5e0!3m2!1sen!2sid!4v1569663844521!5m2!1sen!2sid" width="700" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                    </div>
                    <div class="footers">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-instagram"></a>
                        <a href="#" class="fa fa-youtube"></a>
                        <a href="#" class="fa fa-linkedin"></a>
                        <a href="#" class="fa fa-google"></a>
                    </div>
                    <div class="footerv2-w3ls">
                        
                        <!-- <h4 class="mb-3 w3f_titles">Kerjasama  <span>&emsp;</span> Syarat & Ketentuan <span>&emsp;</span> Kebijakan Privasi</h4> -->
                        <h4 class="w3f_titles">Kerjasama</h4>
                        <h4 class="w3f_titles">Syarat & Ketentuan</h4>
                        <h4 class="w3f_titles">Kebijakan Privasi</h4>
                        <hr>
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.648302060571!2d110.43146201477899!3d-7.931751494286534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5366a01fb57b%3A0xa11927486ec839ca!2sQODR%20HQ!5e0!3m2!1sen!2sid!4v1569663844521!5m2!1sen!2sid" width="700" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- //footer bottom -->
    </footer>
    <!-- //footer -->
    <!-- copyright -->
    <div class="cpy-right text-center">
        <p class="text-bl">© 2019 erp.com . All rights reserved | Design by
            <a href="http://erp.com"> Erp.</a>
        </p>
    </div>
    <!-- //copyright -->
    <!-- move top icon -->
    <a href="#home" class="move-top text-center">
        <span class="fa fa-level-up" aria-hidden="true"></span>
    </a>
    <!-- //move top icon -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        // navbar
		$('.klik_menu').click(function(){
			var menu = $(this).attr('id');
            $('.klik_menu').removeClass('active');
            $(this).addClass('active');
			if(menu == "pelatihan"){
				$('.content').load('{{ url('pelatihan') }}');
			}else if(menu == "event"){
				$('.content').load('event');
			}
		});					
		$('.sarat').click(function(){
			$('.content').load('Syarat.blade.php');
		});					

        // Form login dan register
        $(".owner").click(function(){
            $(".f-regis").hide();
            $(".f-karyawan").hide();
            $(".f-investor").hide();
            $(".f-owner").show();
        });
        $(".karyawan").click(function(){
            $(".f-regis").hide();
            $(".f-owner").hide();
            $(".f-investor").hide();
            $(".f-karyawan").show();
        });
        $(".investor").click(function(){
            $(".f-regis").hide();
            $(".f-owner").hide();
            $(".f-karyawan").hide();
            $(".f-investor").show();
        });
        $(".regis").click(function(){
            $(".f-owner").hide();
            $(".f-karyawan").hide();
            $(".f-investor").hide();
            $(".f-regis").show();
        });
    });

</script>
