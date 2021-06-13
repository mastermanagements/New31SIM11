<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>aturusaha.com - ERP For UMKM -</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="keywords" content="ERP, Enterprice Resource Planning, UMKM, Usaha Mikro Kecil Menengah,
	manajemen perusahaan satu pintu, merancang usaha, strategi usaha" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!---script src='https://www.google.com/recaptcha/api.js'></script>-->
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
                    <h1><a href="{{'/'}}">aturusaha.com</a></h1>
                </div>
                <!-- //logo -->
                <!-- nav -->
                <div class="nav_w3ls ml-lg-5">
                    <nav>
                        <label for="drop" class="toggle">Menu</label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li><a href="{{'/'}}" class="active klik_menu" id="home">Home</a></li>
                            <!--<li><a href="#" >Blog</a></li>-->
							<li><a href="#" class="klik_menu" id="event" >Event</a></li>
                            <li><a href="#" class="klik_menu" id="pelatihan" >Pelatihan</a></li>
                            <li><a href="#" class="klik_menu" id="kontak">Kontak</a></li>
                            <li class="nav-right-sty mt-lg-0 mt-sm-4 mt-2">
                                <a href="#regis" class="reqe-button text-uppercase page-scroll regis">Registrasi</a>
                            </li>
                            <li class=" mt-lg-0 mt-sm-4 mt-4">
                                <!-- <a href="login.html" class="reqe-button text-uppercase">Login</a> -->

                                <a href="" class="reqe-button text-uppercase page-scroll">Login <span class="fa fa-angle-down" aria-hidden="true"></span></a>
                                <input type="checkbox" id="drop-2" />
                                <ul>
                                    <li><a href="#owner" class="drop-text owner">Owner</a></li>
                                    <li><a href="#karyawan" class="drop-text karyawan">Karyawan</a></li>
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
                    <h3 class="home-banner-w3">Jalankan Bisnismu dengan satu aplikasi</h3>
                    <p class="bnr-txt">
						Anda sebagai pelaku Usaha Mikro, Kecil dan Menengah (UMKM), sering mengalami kesulitan mengontrol
						jalannya perusahaan?, Anda kesulitan mengontrol
						administrasi, produk, keuangan, kinerja karyawan, marketing, penggajian dan semua bagian di perusahaan?
						Hal tersebut tentunya membuat usaha Anda sulit untuk berkembang. Aturusaha.com, sebuah aplikasi Enterprice Resource Planning (ERP) hadir
						sebagai solusi permasalahan UMKM. ERP mengintegrasikan jalannya semua bagian di perusahaan Anda mulai
						dari Perencanaan, Pelaksanaan, Monitoring sampai Laporan (Evaluasi). Menjalankan bisnis semakin mudah dengan menggunakan
						aplikasi ini.

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
                                <h3>Perencanaan</h3>
								<p>
									Perencanaan akan mengarahkan jalannya perusahaan Anda ke depan.
								</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a2.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Pelaksanaan</h3>
								<p>
									Implementasikan rencana kerja semua bagian di perusahaan Anda.
								</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mx-auto mt-sm-0 mt-4">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a1.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Monitoring</h3>
								<p>
									Kontrol kinerja semua bagian sesuai dengan target yang telah direncanakan.
								</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mx-auto mt-sm-0 mt-4">
                            <div class="bb-img">
                                <img src="{{ asset('frontend/images/a0.jpg') }}" class="img-fluid img-thumbnail" alt="" />
                                <h3>Evaluasi</h3>
								<p>
									Laporan kinerja karyawan tersedia oleh sistem, evaluasi bisnis semakin mudah.
								</p>
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
                        <p class="mb-5"><b>Login Owner/Founder</b></p>
						<form method="POST" action="{{ url('login-page') }}" id="appointment-form">
                            <span id="notif_login_owner" style="color: red;"></span>
                            <input type="email" name="alamat_email" id="email" class="mx-auto nama" placeholder="Email" required />
                            <br/>
                            <input type="password" name="kata_kunci" id="name" class="mx-auto pass" placeholder="Password">
							{{ csrf_field() }}
							<br>
							<div class="col-md-9 text-right">
                            <a href="#lupa_pass" class="lupa_pass"> Lupa password</a>
							</div>
                           
							<button type="button" name="submit" id="submit_owner" class="btn btn-primary mt-5 tombol">Login</button>
                        </form>

						<div>
						<br>
						@if(!empty(session('message_success')))
							<p style="color: green; text-align: center">*{{ session('message_success')}}</p>
						@elseif(!empty(session('message_fail')))
							<p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
						@endif
						</div>
                    </div>
                </div>
				<div class="row mb-5 f-lupa_pass" id="lupa_pass">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <p class="mb-5"><b>Reset Password Owner</b></p>
						<form method="POST" action="{{ url('lupa-password') }}" id="form-reset-pass">
                            <span id="notif_email_reset" style="color: red;"></span>
							<span style="color: green" id="notif_reset_success"></span>
                            <span style="color: red" id="notif_reset_fail"></span>
							<br>
                            <input type="email" name="email" id="email_reset" class="mx-auto nama" placeholder="Masukkan Email Anda" required />
                            <br/>
                            
							{{ csrf_field() }}
							<br>							          
							<button type="button" name="submit" id="submit_lupa_pass" class="btn btn-primary mt-5 tombol">Kirim</button>
                        </form>

						<div>
						<br>
						@if(!empty(session('message_success')))
							<p style="color: green; text-align: center">*{{ session('message_success')}}</p>
						@elseif(!empty(session('message_fail')))
							<p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
						@endif
						</div>
                    </div>
                </div>
                <div class="row mb-5 f-karyawan" id="karyawan">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <p class="mb-5"><b>Login Karyawan</b></p>
                        <form action="{{ url('cek-karyawan') }}" method="post" id="login_karyawan">
                            <span id="notif_login_karyawan" style="color: red;"></span>
                            <input type="text" class="mx-auto nama" placeholder="Username" name="user_nm" required>
                            <br/>
                            <input type="password" class="mx-auto pass" placeholder="password" name="pass" required>
							{{ csrf_field() }}
							
							<button type="button" id="login_karyawan_button" class="btn btn-primary mt-5 tombol">Login</button>
                        </form>

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
                        <p class="mb-5"><font color="2381EE"><b>Register Owner/Founder Perusahaan</b></font></p>
                        <form method="POST" action="{{ url('registered') }}" id="form-regist">
                            <span style="color: green" id="notif_registered_success"></span>
                            <span style="color: red" id="notif_registered_fail"></span>
                            <input type="text" name="nama" id="title" class="mx-auto nama" placeholder="Nama" required>
                            <br/>
                            <input type="email" name="alamat_email" id="email_regist"class="mx-auto nama" placeholder="email" required>
                            <small style="color: red" id="notif_regis_email"></small>
                            <br/>
                            <input type="password" name="kata_kunci" id="name" class="mx-auto pass" placeholder="password">

                        <!--<br>
                        <div class="g-recaptcha move-left" data-sitekey="6LcTOr0UAAAAAGcl4liqP6-IPIvHpdr_m8jke99Y"></div>-->
                            <br>
                            <input type="checkbox" name="agree_term" class="move-left" checked required> Saya sudah membaca <a href="#" class="sarat"> syarat dan ketentuan</a>
                            <br>
                            <button type="button" class="btn btn-primary mt-5 tombol" id="tombol-regis">Register</button>
						{{ csrf_field() }}
						</form>
						<div>
						<br>
						@if(!empty(session('message_success')))
							<p style="color: green; text-align: center">*{{ session('message_success')}}</p>
						@elseif(!empty(session('message_fail')))
							<p style="color: red;text-align: center">*{{ session('message_fail') }}</p>
						@endif
						</div>
                    </div>
                </div>
                <div class="wthree_pvt_title text-center">
                    <h4 class="w3pvt-title">Apakah Perusahaan Anda Sering Mengalami Masalah Seperti ?</h4>
                    <p class="sub-title"></p>
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
                                        <p>
											Perusahaan yang penting jalan saja?,
											tidak mempunyai struktur dan bagian/departemen serta divisinya?, tidak ada analisa SWOT,
											 tidak ada jobdesc yang jelas, tidak ada tanggung jawab dan wewenang karyawan, tidak tidak mengetahui
											siapa kompetitor Anda?, tidak mempunyai sasaran, target tahunan, bulanan per bagian, per divisi dan
											strategi untuk mencapainya?.
										</p>
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
                                        <h5>Administrasi amburadul?</h5>
                                        <br>
                                        <p>
											Arsip perusahaan: badan hukum, data perizinan, data proposal, data kontrak pekerjaan,
											surat masuk dan keluar, inventaris peralatan,
											serta file arsip lainnya tersebar di berbagai komputer karyawan,
											dan Anda kesulitan mencari file dan hard copy jika membutuhkannya?, dan itu membuat waktu anda
											terbuang banyak untuk urusan administrasi?
										</p>
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
                                        <h5>Kesulitan mengontrol Produk ?</h5>
                                        <br>
                                        <p>
											Anda kesulitan mengetahui data pembelian ke supplier?, penjualan harian, bulanan tidak terupdate?,
											Anda tidak tahu barang apa yang paling laku, yang tidak laku?,
											Anda kesulitan mengontrol persediaan barang? berapa sisa?, berapa kedaluarsa?,
											Kesulitan mengetahui layanan jasa yang paling banyak peminatnya?
											Proyek pada klien perusahaan anda tidak terjadwal?, monitoring kemajuan proyek tidak terkontrol?,
											jobdesc tidak jelas dan sering terlambat pengerjaannya?.
										</p>
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
                                        <h5>Kesulitan Mengelola Laporan Keuangan?</h5>
                                        <br>
                                        <p>
											Anda tidak mempunyai Rencana anggaran perusahaan, target pendapatan dan alokasi pengeluaran?,
											tidak tahu berapa jumlah uang cash di kas harian untuk operasional, dan uang di bank?
											uang perusahaan tercampur dengan uang pribadi?,
											tidak tahu posisi kekayaan perusahaan?,
											Anda merasa tidak tahu kenapa pendapatan mudah didapat, tapi uang perusahaan cepat habis? terlebih
											menjelang gajian karyawan,
											Anda tidak tahu berapa laba/rugi perusahaan anda setiap saat?

										</p>
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
                                        <h5>Marketing Asal Jalan?</h5>
                                        <br>
                                        <p>Anda tidak mempunyai data pelanggan, siapa leads anda, berapa yg sudah melakukan konversi?,
											tidak mempunyai data valid, pelanggan mana saja yang sering belanja barang atau layanan Anda?
											Anda tidak melakukan STP (segmenting, Targeting dan  Positioning)?,
											kegiatan marketing  bulanan tidak di rencanankan dengan baik, yang penting asal jalan.
											fase pengenalan, branding, converting dan maintenance pelanggan tidak terpantau dengan cepat.</p>
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
                                        <h4>Pengelolaan SDM Asal-Asalan</h4>
                                        <p>
											Tidak ada divisi HRD di perusahaan Anda? dan Anda tidak mengetahui solusinya?,
											kesulitan menghire seleksi karyawan?, bingung membuat kontrak kerja?,
											tidak ada SOP yg jelas, kesulitan mengatur absensi dan cuti karyawan,
											menilai kinera karyawan berdasarkan feeling?, aspek apa yang akan di nilai, kapan harus naik gaji?,
											bagaimana memberikan kompensasi kinerja karyawan (bonus, keniakan gaji, tunjangan, dll).

										</p>
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
                                        <h4>Penggajian Tidak Terstruktur</h4>
                                        <p>
											Anda kesulitan mengalokasikan pendapatan perusahaan untuk gaji karyawan?,
											berapa menentukan jumlah alokasi gaji setiap tahun sesuai dengan perubahan pendapatan perusahaan?,
											tidak ada standar baku menentukan gaji pokok karyawan,
											bagaimana menentukan dan menghitung compansable factor untuk menentukan nilai gaji setiap jabatan?,
											apa saja standar penilaiannya?,
											bagaimana menentukan tunjangan karyawan sesuai dengan jabatan?  item apa saja yang dinilai,
											bagaimana menentukan skala gaji, bonus proyek, kelas proyek?.
										</p>
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
                                        <h4>Ingin Menggaet Investor, Tapi Kesulitan Pelaporannya?</h4>
                                        <p>
											Anda tidak mengetahui bentuk investasinya seperti apa? kepemilikan saham atau syirkah (Mudharabah/Musyarakah?), dan bagaimana menentukan bagi hasilnya?,
											kesulitan menentukan persentase saham?, bagaimana mengkonversi keahlian menjadi bentuk saham,
											bagaimana jika ada investor yang menjual sahamnya, berapa alokasi laba untuk operasional perusahaan sebelum dividen di bagikan?,
											kesulitan membuat laporan keuangan dan laporan dividen untuk investor, sehingga kepercayaan investor menjadi berkurang?.
										</p>
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
                    <h4>
						Jangan menunggu perusahaan menjadi besar untuk menggunakan sistem, tapi
						gunakanlah sistem agar perusahaan anda menjadi besar.
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
                                <h6>
                                    ERP untuk UMKM ini adalah sistem yang akan mengotomasisi dan mengintegrasikan bisnis anda.
                                    Anda dapat mengelola lebih dari satu perusahaan baik perusahaan pusat dan cabang untuk perusahaan sejenis maupun berbeda jenis
									perusahaan cukup dari satu aplikasi.
									Pengguna Aplikasi ini terdiri dari:

                                </h6>
                            </div>
                            <div class="row flex-column">
                                <div class="abt-grid">
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h6><b>Owner/Founder/Co Founder Perusahaan</b></h6>
												<p>
													Untuk menggunakan aplikasi ini, Anda sebagai owner perusahaan silahkan melakukan registrasi.
													Setelah melakukan login ke sistem, Anda dapat menambahkan perusahaan apa saja yang ingin Anda tambahkan.
													Kemudian Anda dapat memilih menu aplikasi sesuai dengan kebutuhan perusahaa Anda, menambahkan karyawan
													dan mengatur hak akses mereka sesuai dengan menu yang di izinkan. Anda juga dapat menambahkan data investor jika
													ada.
												</p>
                                            </div>
                                        </div>
                                    </div>
									<br>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h6><b>Karyawan</b></h6>
												<p>
													Karyawan login ke sistem menggunakan akun yang diberikan oleh owner.Karyawan dapat mengakses menu aplikasi
													sesuai dengan hak akses masing - masing.
												</p>
                                            </div>
                                        </div>
                                    </div>
									<br>
                                    <div class="row">
                                        <div class="col-1">
                                            <span class="fa fa-ravelry"></span>
                                        </div>
                                        <div class="col-9">
                                            <div class="abt-txt ml-0">
                                                <h6><b>Investor</b></h6>
												<p>
													Invstor login ke sistem menggunakan akun yang diberikan oleh owner. Investor dapat melihat perkembangan perusahaan
													seperti laporan keuangan dan menu lainnya yang ditentukan oleh owner.
												</p>
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
                                <h6>
                                    Pengguna aplikasi ini adalah semua UMKM yang bergerak di bidang perdagangan dan jasa. Sedangkan untuk perusahaan
									manufaktur beberapa menu dapat digunakan untuk menjalankan proses bisnis sesuai dengan kebutuhannya.
                                </h6>
                            </div>
                            <!--<div class="row flex-column">
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
                            </div>-->
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
                                    <span class="post-icon">Efektif</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="single.html">Anda lebih fokus ke core bisnis.</a>
                                </h5>
                                <p>Dengan menggunakan aplikasi ini anda tidak perlu membuat dan mengembangkan sistem
								   yang membutuhkan waktu dan biaya mahal. Kerja Anda dan tim lebih fokus meningkatkan pendapatan
								   sesuai dengan core bisnis Anda. Dengan fokus ke core bisnis, hasil bisnis Anda lebih optimal.
								</p>
                                <!--<a href="single.html" class="blog_link">Read more</a>-->
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
                                    <span class="post-icon">Efesien</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="single.html">Mengatur Perusahaan Menjadi lebih cepat</a>
                                </h5>
                                <p>
								   Monitoring semua proses dan hasil kinerja karyawan untuk semua bagian/departemen menjadi lebih cepat.
								   Perusahaan Anda lebih terarah dalam melakukan kerja - kerja harian untuk mencapai target bulanan dan tahunan.
								</p>
                                <!--<a href="single.html" class="blog_link">Read more</a>-->
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
                                    <span class="post-icon">Scale Up</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="single.html">Bisnis Anda bisa naik kelas menjadi lebih cepat.</a>
                                </h5>
                                <p>
								   Syarat scale up adalah bisnis Anda sudah harus tersistem. Anda tidak lagi menggunakan cara konvensional, yaitu
								    menjalankan bisnis secara manual. Proses bisnis   dan hasilnya sudah real time tersaji di aplikasi ini.

								</p>
                                <!--<a href="single.html" class="blog_link">Read more</a>-->
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
                            <a href="#regis" class="btn btn-primary"> <b> Daftar Gratis !!!</b> </a>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- akhir iklan -->
            <div class="container">
                <div class="row email">
                    <div class="col-md-6">
                        <h4 class="text-email">
                            Dapatkan informasi terkini mengenai aplikasi, event - event dan pelatihan, silahkan isi nama dan email Anda.
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
                                <button type="submit" class="btn btn-info pull-right">Subcrise</button>
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
                            <a href="mailto:example@email.com">Email : info@aturusaha.com</a>
                        </p>
                    </div>
                    <div class="fv3-contact my-2">
                        <p>Phone : 0427-5343434</p>
                    </div>
                    <div class="fv3-contact">
                        <p>Alamat : <br>Sekip, Sinduadi, Mlati, Sleman
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
        <p class="text-bl">© 2019 aturusaha.com All rights reserved
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

        $('#email_regist').keyup(function(){
            var data = $('#form-regist').serialize()
            $.ajax({
                url:'{{ url('cek-email') }}',
                type: 'post',
                data : data,
                success: function(result){
                    console.log(result);
                    $('#notif_regis_email').text(result.message);
                    if(result.status==true){
                        $('#tombol-regis').attr('disabled',true);
                    }else{
                        $('#tombol-regis').attr('disabled',false);
                    }
                }
            });

        });

        $('#notif_registered').text("test")
        $('#tombol-regis').click(function(){
            
            $.ajax({
                url: $('#form-regist').attr('action'),
                type: 'post',
                data:$('#form-regist').serialize(),
                success: function(result){
                    if(result.status==true){
                        $('#notif_registered_success').text(result.message)
                    }else{
                        $('#notif_registered_fail').text(result.message)
                    }
                }
            })
        });
		
		$('#email_reset').keyup(function(){
            var data = $('#form-reset-pass').serialize()
            $.ajax({
                url:'{{ url('cek-email-reset') }}',
                type: 'post',
                data : data,
                success: function(result){
                    console.log(result);
                    $('#notif_email_reset').text(result.message);
                    if(result.status==true){
                        $('#submit_lupa_pass').attr('disabled',true);
                    }else{
                        $('#submit_lupa_pass').attr('disabled',false);
                    }
                }
            });

        });
		
		$('#submit_lupa_pass').click(function(){
         
            $.ajax({
                url: $('#form-reset-pass').attr('action'),
                type: 'post',
                data:$('#form-reset-pass').serialize(),
                success: function(result){
                    if(result.status==true){
                        $('#notif_reset_success').text(result.message)
                    }else{
                        $('#notif_reset_fail').text(result.message)
                    }
                }
            })
        });

        $('#login_karyawan_button').click(function () {
            $.ajax({
                url:$('#login_karyawan').attr('action'),
                type:'post',
                data : $('#login_karyawan').serialize(),
                success:function(result){
                    if(result.status==true){
                        window.location.href="{{ url('welcome-page') }}";
                    }else{
                        $('#notif_login_karyawan').text(result.message);
                    }
                }
            });
        });

        $('#submit_owner').click(function () {
            $.ajax({
                url:$('#appointment-form').attr('action'),
                type:'post',
                data : $('#appointment-form').serialize(),
                success:function(result){
                    if(result.status==true){
                        window.location.href="{{ url('dashboard') }}";
                    }else{
                        $('#notif_login_owner').text(result.message);
                    }
                }
            });
        });
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
			else if(menu == "kontak"){
				$('.content').load('{{ url('kontak') }}');
			}
		});
		$('.sarat').click(function(){
			$('.content').load('{{ url('syarat') }}');
		});

        // Form login dan register
        $(".owner").click(function(){
            $(".f-regis").hide();
            $(".f-karyawan").hide();
            $(".f-investor").hide();
			$(".f-lupa_pass").hide();
            $(".f-owner").show();
        });
        $(".karyawan").click(function(){
            $(".f-regis").hide();
            $(".f-owner").hide();
            $(".f-investor").hide();
			$(".f-lupa_pass").hide();
            $(".f-karyawan").show();
        });
        $(".investor").click(function(){
            $(".f-regis").hide();
            $(".f-owner").hide();
            $(".f-karyawan").hide();
			$(".f-lupa_pass").hide();
            $(".f-investor").show();
        });
        $(".regis").click(function(){
            $(".f-owner").hide();
            $(".f-karyawan").hide();
            $(".f-investor").hide();
			$(".f-lupa_pass").hide();
            $(".f-regis").show();
        });
		$(".lupa_pass").click(function(){
            $(".f-owner").hide();
            $(".f-karyawan").hide();
            $(".f-investor").hide();
            $(".f-regis").hide();
			$(".f-lupa_pass").show();
        });
    });

</script>
