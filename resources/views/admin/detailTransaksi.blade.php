@extends('layouts.adminApp')

@section('title', 'Detail Transaksi #' . $pesanan->id_pesanan)

@section('content')
<div class="mb-8 flex items-center">
    <a href="{{ route('admin.transaksi') }}" class="mr-4 text-gray-400 hover:text-orange-500 transition">
        <i class="fas fa-arrow-left text-2xl"></i>
    </a>
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Detail Transaksi #{{ $pesanan->id_pesanan }}</h2>
        <p class="text-gray-500">Informasi lengkap pesanan pelanggan.</p>
    </div>
</div>

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-4 space-y-6">
        <div class="bg-white p-8 rounded-[7px] shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Utama</h4>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-400">Waktu Transaksi</p>
                    <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($pesanan->tanggal_jam)->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Tipe Pesanan</p>
                    <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-bold">{{ $pesanan->tipe_pesanan }}</span>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Nomor Meja</p>
                    <p class="font-bold text-gray-800">{{ $pesanan->nomor_meja ?? 'Take Away' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-8">
        <div class="bg-white p-8 rounded-[7px] shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-6">Rincian Pesanan</h4>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-50">
                        <th class="pb-4 font-medium">Menu</th>
                        <th class="pb-4 font-medium text-center">Harga Satuan</th>
                        <th class="pb-4 font-medium text-center">Qty</th>
                        <th class="pb-4 font-medium text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach($details as $item)
                    <tr class="border-b border-gray-50">
                        <td class="py-4 font-bold text-gray-800">{{ $item->nama_menu }}</td>
                        <td class="py-4 text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="py-4 text-center">{{ $item->qty }}x</td>
                        <td class="py-4 text-right font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-8 flex justify-between items-center bg-gray-50 p-6 rounded-[7px]">
                <span class="text-gray-500 font-medium">Total Pembayaran</span>
                <span class="text-3xl font-bold text-orange-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
