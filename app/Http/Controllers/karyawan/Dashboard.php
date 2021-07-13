<?php

namespace App\Http\Controllers\karyawan;

use function Complex\theta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Model\Administrasi\AgendaHarian;
use App\Model\Manufaktur\P_tambah_produksi;
use App\Http\utils\data\LabaRugi as laba;
use App\Http\utils\data\SettingTahunBuku;

class Dashboard extends Controller
{
    private $id_karyawan;
    private $id_superadmin_karyawan;
    private $current_date;
    private $current_mont;

    private $tgl_awal_di_setiap_bulan;
    private $tgl_akhir_di_setiap_bulan;

    public function __construct()
    {
        $this->middleware(function ($req, $next) {
            if (empty(Session::get('id_karyawan'))) {
                return redirect('/')->with('message_login_fail', 'Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->current_date = date('Y-m-d');
            $this->current_mont = date('m');

            $this->tgl_awal_di_setiap_bulan = date('Y-m-01');
            $this->tgl_akhir_di_setiap_bulan = date('Y-m-t');

            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_superadmin_karyawan = Session::get('id_superadmin_karyawan');
            return $next($req);
        });
    }

    public function index()
    {
        $data = [
            'agenda' => AgendaHarian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereDate('tgl_agenda', $this->current_date)->get(),
            'produksi_harian' => P_tambah_produksi::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereDate('tgl_selesai', $this->current_date)->get(),
            'produksi_bulanan' => $this->produksi_bulanan(),
            'pengeluaran_harian' => $this->pengeluaran($this->current_date, null),
            'pengeluaran_bulanan' => $this->pengeluaran(null, $this->current_mont),
            'biaya_harian' => $this->biaya_pengeluaran($this->current_date, null),
            'biaya_bulanan' => $this->biaya_pengeluaran(null, $this->current_mont),
			
            'laba_harian' => $this->laba_rugi($this->current_date),
            'laba_bulanan' => $this->laba_rugi(),
        ];
         return view('user.karyawan.section.default.page_default', $data);
    }

    private function produksi_bulanan()
    {
        $model = DB::select('SELECT p_barang.nm_barang, sum(p_tambah_produksi.jumlah_brg_jadi_bagus) as total_produksi FROM p_tambah_produksi 
                  join p_barang on p_tambah_produksi.id_barang = p_barang.id 
                  WHERE month(p_tambah_produksi.tgl_selesai) = ' . $this->current_mont . ' GROUP BY p_tambah_produksi.id_barang');
        return $model;
    }

    private function pengeluaran($current_date = null, $current_month = null)
    {
        $plug_query = "";
        if (!empty($current_date)) {
            $plug_query = 'and date(tgl_sales) = "' . $current_date . '" group by date(tgl_sales)';
        }
        if (!empty($current_month)) {
            $plug_query = 'and month(tgl_sales) = "' . $current_month . '" group by month(tgl_sales)';
        }

        $query = DB::select('SELECT p_sales.tgl_sales,sum(p_sales.total) as total_biaya FROM p_sales where id_perusahaan = ' . Session::get('id_perusahaan_karyawan') . ' ' . $plug_query);
        return $query;
    }

	
	/* private function biaya_pengeluaran($current_date = null, $current_month = null)
    {

        $query_plug = '';
        if ($current_date != null) {
            $query_plug = ' date(k_jurnal.tgl_jurnal)="' . $this->current_date . '"';
        }

        if ($current_month != null) {
            $query_plug = ' month(k_jurnal.tgl_jurnal)="' . $this->current_date . '"';
        }

        $query = 'SELECT sum(jumlah_transaksi) as total FROM k_ket_transaksi 
                  join k_jurnal on k_jurnal.id_ket_transaksi = k_ket_transaksi.id where 
                 ' . $query_plug . ' and k_jurnal.id_perusahaan = ' . Session::get('id_perusahaan_karyawan') . ' 
                  GROUP by debet_kredit = 0';
        $data = DB::select($query);
        return $data;
    } */
	
    private function biaya_pengeluaran($current_date = null, $current_month = null)
    {

        $query_plug = '';
        if ($current_date != null) {
            $query_plug = ' date(k_jurnal.tgl_jurnal)="' . $this->current_date . '"';
        }

        if ($current_month != null) {
            $query_plug = ' month(k_jurnal.tgl_jurnal)="' . $this->current_date . '"';
        }
      
   		  
        $data = DB::table('k_jurnal')
				->selectRaw('sum(k_jurnal.jumlah_transaksi) as total')
				->join('k_ket_transaksi', 'k_jurnal.id_ket_transaksi', '=', 'k_ket_transaksi.id') 			
				->where('k_ket_transaksi.jenis_transaksi', '=', '1')
				->where('k_jurnal.debet_kredit', '=', '0')
				//->where($query_plug)
				->where('k_jurnal.id_perusahaan', '=', Session::get('id_perusahaan_karyawan'))
				->get();  
				
				
		//dd($plug_query);
        return $data;
		
    }

    private function laba_rugi($_current_date = null)
    {
        $data_tahun = SettingTahunBuku::tahun_buku();
        if ($_current_date != null) {
            $data_tahun['tgl_awal'] = $this->current_date;
            $data_tahun['tgl_akhir'] = $this->current_date;
        }else{
            $data_tahun['tgl_awal'] = $this->tgl_awal_di_setiap_bulan;
            $data_tahun['tgl_akhir'] = $this->tgl_akhir_di_setiap_bulan;
        }
        $data = laba::LabaRugi($data_tahun);
        $akun = laba::$akun_focus;
        $total_laba = 0;
//        $total_laba = $this->total_laba($akun, $data);
        $total_laba = laba::hitungjumlah_laba();
        return $total_laba;
    }

    private function total_laba($akun, $data)
    {
        $total_laba = 0;
        foreach ($akun as $key => $data_laba_rugi) {
            $total_sub = 0;
            if (!empty($data[$key])) {
                foreach ($data[$key] as $data_group) {
                    if ($data_group['posisi_saldo'] == "K") {
                        $total_sub += $data_group['saldo_kredit'];
                        $total_laba += $data_group['saldo_kredit'];
                    } else {
                        $total_laba -= $data_group['saldo_debet'];
                        $total_sub += $data_group['saldo_debet'];
                    }
                }
            }
        }
        return $total_laba;
    }
}