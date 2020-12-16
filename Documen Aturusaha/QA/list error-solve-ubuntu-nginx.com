yg tdk ada di git:
- .env
- vendor

Error:

1. Symfony \ Component \ Debug \ Exception \ FatalThrowableError (E_ERROR)
Class 'App\Model\superadmin_ukm\U_usaha' not found

/var/www/New31SIM11/routes/web.php

line: 29  $data_perusahaan = App\Model\superadmin_ukm\U_usaha::all()->where('id_user_ukm',Session::get('id_superadmin_ukm'));

solusi: App\Model\Superadmin_ukm\U_usaha::all()

ubah: menjadi huruf besar pd: Superadmin_UKM

2. pengaturan awal -data perusahaan
  http://aturusaha.local/pengaturan-perusahaan

  ReflectionException (-1)
   Class App\Http\Controllers\Superadmin_ukm\Superadmin_UKM does not exist

   ubah folder app/App\Http\Controllers\superadmin_ukm\Superadmin_UKM menjadi : huruf besar pd superadmin_ukm

3. Unable to write in the "/var/www/New31SIM11/public/image_superadmin_ukm" directory
   upload gambar:

   solusi:

   chmod 755 /var/www/New31SIM11/public/system/
   chown -R www-data:www-data /var/www/New31SIM11/public/

4. error logout:
    vendor/composer/ClassLoader.php
   ./app/Http/Controllers/superadmin_ukm/LoginAndRegisterController.php): failed to open stream: No such file or directory ◀

   solusi:

   sudo php artisan config:cache
   sudo php artisan config:clear
   sudo composer dump-autoload -o

   berhasil:
   https://stackoverflow.com/questions/53203254/failed-to-open-stream-no-such-file-or-directory-laravel
   
   
 5. . Symfony \ Component \ Debug \ Exception \ FatalThrowableError (E_ERROR)
	Class 'App\Model\superadmin_ukm\U_usaha' not found

	$data_perusahaan = App\Model\superadmin_ukm\U_usaha::all()->where('id_user_ukm',Session::get('id_superadmin_ukm'));
	
	App/Model/superadmin_ukm ===> harusnya App/Model/Superadmin_UKM

6.   2. ErrorException (E_ERROR)
	Trying to access array offset on value of type null
	(View: /var/www/New31SIM11/resources/views/user/superadmin_ukm/master/include/sidebar.blade.php)
	(View: /var/www/New31SIM11/resources/views/user/superadmin_ukm/master/include/sidebar.blade.php)
	(View: /var/www/New31SIM11/resources/views/user/superadmin_ukm/master/include/sidebar.blade.php)

	 <li class="treeview <?php if($explode[0]=="pengaturan_awal"): ?> active menu-open <?php endif; ?>" >

