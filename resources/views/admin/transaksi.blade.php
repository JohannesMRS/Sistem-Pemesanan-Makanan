@extends('layouts.adminApp')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="mb-10">
    <h2 class="text-4xl font-bold text-gray-800">Transaksi</h2>
</div>

<div class="bg-white  shadow-sm border border-gray-300 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-sm">
            <tr class = "border-b border-gray-200">
                <th class="p-6 font-medium">ID PESANAN</th>
                <th class="p-6 font-medium">WAKTU</th>
                <th class="p-6 font-medium">MEJA</th>
                <th class="p-6 font-medium">TIPE</th>
                <th class="p-6 font-medium">TOTAL HARGA</th>
                <th class="p-6 font-medium">STATUS</th>
                <th class="p-6 font-medium text-center">DETAIL</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 divide-y divide-gray-100">
            @foreach($daftarTransaksi as $t)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-6 font-bold text-gray-800">#{{ $t->id_pesanan }}</td>
                <td class="p-6 text-sm">{{ \Carbon\Carbon::parse($t->tanggal_jam)->format('d M, H:i') }}</td>
                <td class="p-6 italic">Meja {{ $t->nomor_meja ?? '-' }}</td>
                <td class="p-6">
                    <span class="px-3 py-1 rounded-full text-xs {{ $t->tipe_pesanan == 'Dine In' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                        {{ $t->tipe_pesanan }}
                    </span>
                </td>
                <td class="p-6 font-bold text-gray-800">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                <td class="p-6">
                    <span class="text-green-500 flex items-center font-medium">
                        <i class="fas fa-check-circle mr-2"></i> Selesai
                    </span>
                </td>
                <td class="p-6 text-center">
                    <a href="{{ url('/admin/transaksi/detail/'.$t->id_pesanan) }}" ...>
                    <a href="{{ route ('transaksi.detail', $t->id_pesanan)}}">
                        <button  class="bg-gray-100 hover:bg-orange-500 hover:text-white p-2 px-4 rounded-xl transition">
                            <i class="fas fa-eye"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<div class="mt-8">
    {{ $daftarTransaksi->links() }}
</div>
@endsection
