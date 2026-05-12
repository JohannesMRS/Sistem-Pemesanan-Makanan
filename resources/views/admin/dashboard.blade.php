@extends('layouts.adminApp')

@section('title', 'Dashboard')

@section('content')
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-bold text-gray-800">Dashboard</h2>
                {{-- <p class="text-gray-500">Inilah performa kedaimu hari ini.</p> --}}
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-600">{{ now()->format('d M Y') }}</span>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold">A</div>
            </div>
        </header>

        <div class="grid grid-cols-12 gap-6 mb-10">
            <div class="col-span-4 bg-white p-6 rounded-[7px] shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <p class="text-gray-400 font-medium">Pendapatan Hari Ini</p>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">Rp {{ number_format($omsetHariIni, 0, ',', '.') }}</h3>
            </div>

            <div class="col-span-4 bg-white p-6 rounded-[7px] shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <p class="text-gray-400 font-medium">Total Pesanan</p>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalPesanan }} Order</h3>
            </div>

            <div class="col-span-4 bg-white p-6 rounded-[7px] shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-400 font-medium">Best Seller</p>
                </div>
                <h3 class="text-xl font-bold text-gray-800">{{ $menuTerlaris->nama_menu ?? 'Belum Ada Data' }}</h3>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[7px] shadow-sm border border-gray-100">
            <h3 class="text-xl font-bold mb-6 text-gray-800">Aktivitas Terbaru</h3>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-50">
                        <th class="pb-4 font-medium">ID PESANAN</th>
                        <th class="pb-4 font-medium">JAM</th>
                        <th class="pb-4 font-medium">TIPE</th>
                        <th class="pb-4 font-medium">TOTAL</th>
                        <th class="pb-4 font-medium">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach($transaksiTerbaru as $tx)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 font-bold">#{{ $tx->id_pesanan }}</td>
                        <td class="py-4 text-sm">{{ \Carbon\Carbon::parse($tx->tanggal_jam)->format('H:i') }}</td>
                        <td class="py-4"><span class="px-3 py-1 bg-gray-100 rounded-full text-xs">{{ $tx->tipe_pesanan }}</span></td>
                        <td class="py-4 font-bold text-gray-800">Rp {{ number_format($tx->total_harga, 0, ',', '.') }}</td>
                        <td class="py-4"><span class="text-green-500"><i class="fas fa-check-circle"></i> Berhasil</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>



@endsection
