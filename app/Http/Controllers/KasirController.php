<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasir;
use App\Models\Meja;
use Illuminate\Support\Facades\DB; // WAJIB ADA
use Illuminate\Support\Facades\Auth; // WAJIB ADA
use Illuminate\Support\Str; // WAJIB ADA

class KasirController extends Controller
{
    public function index(){
        // Menampilkan menu kategori 1 (Makanan)
        $dataMakanans = Kasir::where('id_kategori', 1)->get();
        $dataMinumans = kasir::where('id_kategori', 2)->get();
        $dataMejas = Meja::orderBy('nomor_meja', 'asc')->get();
        return view('kasir.PointOfSales', compact('dataMakanans','dataMinumans', 'dataMejas'));
    }

    public function transaksi(Request $request){
        $items = json_decode($request->cart_data, true);
        $total = $request->total_tagihan;
        $tipe = $request->tipe_pesanan;
        $metode = $request->metode_bayar;
        $noMeja = $request->nomor_meja;
        // dd($tipe);
        return view('kasir.transaksi', compact('items', 'total', 'tipe', 'metode', 'noMeja'));
    }

    public function simpan(Request $request)
{
    // return response()->json($request->all());
    // Gunakan Transaction agar jika 1 tabel gagal, semua dibatalkan (Data aman)
    DB::beginTransaction();
    try {
        // 1. INSERT KE TABEL PESANAN (Header)
        // Kolom sesuai screenshot image_f88f09.png
        $idPesanan = DB::table('PESANAN')->insertGetId([
            'NOMOR_MEJA'     => $request->nomor_meja ?? 0,
            'TANGGAL_JAM'    => now(),
            'TIPE_PESANAN'   => $request->tipe,
            'TOTAL_HARGA'    => $request->total,
            'STATUS_PESANAN' => 'Selesai'
        ], 'ID_PESANAN'); // 'ID_PESANAN' adalah primary key di Oracle

        // 2. INSERT KE TABEL DETAIL_PESANAN (Looping menu)
        // Kolom sesuai screenshot image_f88f81.png
        foreach ($request->items as $item) {
            DB::table('DETAIL_PESANAN')->insert([
                'ID_PESANAN' => $idPesanan,
                'ID_MENU'    => $item['id'],
                'QTY'        => $item['quantity'],
                'SUBTOTAL'   => $item['price'] * $item['quantity'],
                'CATATAN'    => $item['note'] ?? '-'
            ]);
        }

        // 3. INSERT KE TABEL PEMBAYARAN
        // Kolom sesuai screenshot image_f88f61.png
        DB::table('PEMBAYARAN')->insert([
            'ID_PESANAN'   => $idPesanan,
            'METODE_BAYAR' => $request->metode,
            'JUMLAH_BAYAR' => $request->bayar,
            'KEMBALIAN'    => $request->kembalian,
            'WAKTU_BAYAR'  => now()
        ]);

        DB::commit(); // Simpan permanen ke Oracle
        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        DB::rollback(); // Batalkan semua jika ada error
        return response()->json([
            'success' => false,
            'message' => 'Gagal simpan ke Oracle: ' . $e->getMessage()
        ], 500);
    }
}
}
