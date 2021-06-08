   
	
	<!-- banner hal syarat -->
        <section>
			<div class="container">
				<div class="row mb-5 f-regis" id="regis">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <br>
                        <div class="text-center mb-5 mt-3">
							<h5><b>Register Owner/Founder Perusahaan</b></h5>
						</div>
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
				<div class="row mb-5 f-owner" id="owner">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <br>
                        <div class="text-center mb-5 mt-3">
							<h5><b>Login Owner/Founder</b></h5>
						</div>
						<form method="POST" action="{{ url('login-page') }}" id="appointment-form">
                            <span id="notif_login_owner" style="color: red;"></span>
                            <input type="email" name="alamat_email" id="email" class="mx-auto nama" placeholder="Email" required />
                            <br/>
                            <input type="password" name="kata_kunci" id="name" class="mx-auto pass" placeholder="Password">
							{{ csrf_field() }}
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
                <div class="row mb-5 f-karyawan" id="karyawan">
                    <div class="col-md-12 wthree_pvt_title text-center">
                        <br>
                        <div class="text-center mb-5 mt-3">
							<h5><b>Login Karyawan</b></h5>
						</div>
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
                        <br>
                        <div class="text-center mb-5 mt-3">
							<h5><b>Login Investor</b></h5>
						</div>
                        <form>
                            <input type="text" class="mx-auto nama" placeholder="email">
                            <br/>
                            <input type="text" class="mx-auto pass" placeholder="password">
                        </form>
                        <button class="btn btn-primary mt-5 tombol">Login</button>
                    </div>
                </div>
			</div>
            <div class="container">
				<br><br>
                <div class="text-center mb-5 mt-3">
                    <h5><b>Syarat dan Ketentuan</b></h5>
                </div>
                <div class="row">
                    <div class="col-md-9 mb-5 offset-2">
                        <div class="container mt-2">
                            <h5><b>Syarat dan Ketentuan ini berlaku selama Syarat dan Ketentuan ini berlaku selama dan Ketentuan ini berlaku selama</b></h5>
                            <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat quisquam dolorem delectus unde magnam soluta eveniet aspernatur animi, porro labore, officiis iusto nostrum libero quod culpa dolor asperiores. Architecto, nobis!</p>
                            <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat quisquam dolorem delectus unde magnam soluta eveniet aspernatur animi, porro labore, officiis iusto nostrum libero quod culpa dolor asperiores. Architecto, nobis!</p>
                        </div>
                        <div class="container">
                            <p><b>1. Syarat dan Ketentuan</b></p>
                            <p class="ml-4"><b>1.1 Perjanjian</b></p>
                            <p class="ml-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem est explicabo, nemo animi libero voluptates blanditiis soluta obcaecati sed numquam minus temporibus reprehenderit assumenda expedita vitae quasi adipisci delectus dicta.</p>
                            <p class="ml-5 mt-1">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem est explicabo, nemo animi libero voluptates blanditiis soluta obcaecati sed numquam minus temporibus reprehenderit assumenda expedita vitae quasi adipisci delectus dicta.</p>
                            <p class="ml-5"> <b>a. &nbsp; </b>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="ml-5"> <b>b. &nbsp; </b>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="ml-5"> <b>c. &nbsp; </b>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="ml-5"> <b>d. &nbsp; </b>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="offset-2"> <span> &#8226; &nbsp;</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="offset-2"> <span> &#8226; &nbsp;</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="offset-2"> <span> &#8226; &nbsp;</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="offset-2"> <span> &#8226; &nbsp;</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <p class="offset-2"> <span> &#8226; &nbsp;</span> Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                            <!--  -->
                            <!--  -->
                            <p class="ml-4"><b>1.2 Tata Cara</b></p>
                            <p class="ml-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem est explicabo, nemo animi libero voluptates blanditiis soluta obcaecati sed numquam minus temporibus reprehenderit assumenda expedita vitae quasi adipisci delectus dicta.</p>
                            <!--  -->
                            <p class="ml-4"><b>1.3 Syarat</b></p>
                            <p class="ml-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem est explicabo, nemo animi libero voluptates blanditiis soluta obcaecati sed numquam minus temporibus reprehenderit assumenda expedita vitae quasi adipisci delectus dicta.</p>
                            <p><b>2. Hak</b></p>
                            <p><b>3. Kewajiban</b></p>
                            <p><b>4. Hukum</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //banner -->
	
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
            {{--method="POST" action="{{ url('registered') }}" id="form-regist"--}}
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
		});
		$('.sarat').click(function(){
			$('.content').load('{{ url('pelatihan') }}');
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

	
		