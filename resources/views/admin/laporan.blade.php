@extends('layouts.adminApp')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="mb-10 flex justify-between items-end">
    <div>
        <h2 class="text-4xl font-bold text-gray-800">Laporan Pendapatan</h2>
    </div>

    <form action="{{ route('admin.laporan') }}" method="GET" class="flex gap-4">
        <button onclick="window.print()" class="bg-gray-800 text-white p-4 px-8 rounded-[7px] font-bold flex items-center hover:bg-black transition">
            <i class="fas fa-print mr-3"></i> Cetak Laporan
        </button>
        <select name="bulan" class="p-3 rounded-[7px] border-none shadow-sm focus:ring-orange-500">
            @for($i=1; $i<=12; $i++)
                <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
            @endfor
        </select>
        <button type="submit" class="bg-orange-500 text-white px-6 rounded-[7px] font-bold hover:bg-orange-600 transition">Filter</button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    <div class="bg-white p-8 shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center mr-4">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <span class="text-gray-400 font-medium">Total Pendapatan Bulan Ini</span>
        </div>
        <h3 class="text-4xl font-black text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
    </div>

    <div class="bg-white p-8 shadow-sm border border-gray-100">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mr-4">
                <i class="fas fa-shopping-bag text-xl"></i>
            </div>
            <span class="text-gray-400 font-medium">Total Pesanan</span>
        </div>
        <h3 class="text-4xl font-black text-gray-800">{{ $totalTransaksi }} Order</h3>
    </div>
</div>

<div class="bg-white shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-sm">
            <tr class = "border-b border-gray-200">
                <th class="p-6 font-medium">TANGGAL</th>
                <th class="p-6 font-medium">ID PESANAN</th>
                <th class="p-6 font-medium">TIPE</th>
                <th class="p-6 font-medium text-right">PENDAPATAN</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 divide-y divide-gray-200">
            @forelse($laporan as $l)
            <tr class="hover:bg-gray-50 transition ">
                <td class="p-6">{{ \Carbon\Carbon::parse($l->tanggal_jam)->format('d/m/Y') }}</td>
                <td class="p-6 font-bold">#{{ $l->id_pesanan }}</td>
                <td class="p-6">{{ $l->tipe_pesanan }}</td>
                <td class="p-6 text-right font-bold text-gray-800">Rp {{ number_format($l->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr class = "h-40">
                <td colspan="4" class = "text-center  ">Belum Ada Pendapatan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="w-11/12 mt-8 mx-auto">
    {{ $laporan->links() }}
</div>
@endsection
