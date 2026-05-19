<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Order;


class AdminController extends Controller
{
    public function index(){
        $dataPegawai = User::where('role', 'ADMIN')->get();
        $omsetHariIni = DB::table('PESANAN')->whereDate('TANGGAL_JAM', Carbon::today())->sum('TOTAL_HARGA');

        $totalPesanan = DB::table('PESANAN')->whereDate('TANGGAL_JAM', Carbon::today())->count();

        $menuTerlaris = DB::table('DETAIL_PESANAN')
        ->join('MENU', 'DETAIL_PESANAN.ID_MENU', '=', 'MENU.ID_MENU')
        ->select('MENU.NAMA_MENU', DB::raw('SUM(QTY) AS TOTAL_QTY'))
        ->groupBy('MENU.NAMA_MENU')
        ->first();

        $transaksiTerbaru = DB::table('PESANAN')->orderBy('TANGGAL_JAM', 'desc')->paginate(10);
        return view('admin.dashboard', compact('dataPegawai', 'omsetHariIni','totalPesanan' ,'menuTerlaris', 'transaksiTerbaru'));
    }

    public function menu(){
        $dataMenu = DB::table('MENU')->orderBy('id_menu', 'asc')->paginate(5);
        return view('admin.menu', compact('dataMenu'));
    }

    public function transaksi(){
        $daftarTransaksi = DB::table('PESANAN')->orderBy('tanggal_jam', 'desc')->paginate(5);
        return view('admin.transaksi', compact('daftarTransaksi'));
    }

    public function detailTransaksi($id)
    {
        $pesanan = DB::table('PESANAN')->where('id_pesanan', $id)->first();
        $details = DB::table('DETAIL_PESANAN')
            ->join('MENU', 'DETAIL_PESANAN.ID_MENU', '=', 'MENU.ID_MENU')
            ->where('DETAIL_PESANAN.ID_PESANAN', $id)
            ->select('MENU.NAMA_MENU', 'DETAIL_PESANAN.QTY', 'DETAIL_PESANAN.SUBTOTAL', 'MENU.HARGA')
            ->get();
        return view('admin.detailTransaksi', compact('pesanan','details'));
    }

    public function laporan(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        $query = DB::table('PESANAN')
        ->whereRaw("EXTRACT(MONTH FROM TANGGAL_JAM) = ?", [$bulan])
        ->whereRaw("EXTRACT(YEAR FROM TANGGAL_JAM) = ?", [$tahun]);

        $totalPendapatan = (clone $query)->sum('TOTAL_HARGA');
        $totalTransaksi = (clone $query)->count();

        $laporan = $query->orderBy('TANGGAL_JAM', 'desc')->paginate(5);

        return view('admin.laporan', compact('laporan', 'totalPendapatan', 'totalTransaksi', 'bulan', 'tahun'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_menu'=>'required',
            'nama_menu' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaGambar = null;
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img/menu'), $namaGambar); // Simpan di folder public/img/menu
        }

        DB::table('MENU')->insert([
            'ID_MENU'     =>$request->id_menu,
            'NAMA_MENU'   => $request->nama_menu,
            'ID_KATEGORI' => $request->id_kategori,
            'HARGA'       => $request->harga,
            'GAMBAR'      => $namaGambar,
            'DESKRIPSI'   => $request->deskripsi ?? '-',
        ]);
        return redirect()->back()->with('success', 'Menu berhasil ditambah!');
    }





}
