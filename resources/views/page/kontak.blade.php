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
                    <div class="col-md-12 wthree_pvt_title text-center"><br><br><br>
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
            <h5><b>Hubungi Kami:</b></h5>
        </div>
       
        <div class="row">
            
            <div class="col-md-4">
                <div class="container">
                    <h5><b><font color="#0B63E1">Aturusaha.com</font></b></h5>
                    <p class="waktu">Jl. Pangeran Antasari Kendari Sultra</p>
                    <p class="waktu">Telp. 0401-358295</p>
                    <p class="waktu">Hp/Wa/Telegram. 085228006675</p>
					<p class="waktu">Email. admin@aturusaha.com</p><br><br>
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