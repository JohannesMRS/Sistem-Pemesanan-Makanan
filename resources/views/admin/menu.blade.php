@extends('layouts.adminApp')

@section('title', 'Kelola Menu')

@section('content')
<div class="flex justify-between items-center mb-10">
    <div>
        <h2 class="text-4xl font-bold text-gray-800">Manajemen Menu</h2>
    </div>
    <button onclick="openModal()" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-[7px] shadow-lg shadow-orange-200 transition flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Menu Baru
    </button>
</div>

<div class="bg-white rounded-[7px] shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-400 text-sm">
            <tr class = "border-b border-gray-200">
                <th class="p-6 font-medium">GAMBAR</th>
                <th class="p-6 font-medium">NAMA MENU</th>
                <th class="p-6 font-medium">KATEGORI</th>
                <th class="p-6 font-medium">HARGA</th>
                <th class="p-6 font-medium text-center">AKSI</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 divide-y divide-gray-50">
            @foreach($dataMenu as $m)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-6">
                    <img src="{{ asset('img/' . ($m->gambar ?? 'default.png')) }}" class="w-16 h-16 object-cover rounded-2xl">
                </td>
                <td class="p-6 font-bold text-gray-800">{{ $m->nama_menu }}</td>
                <td class="p-6">
                    <span class="px-3 py-1 rounded-full text-xs {{ $m->id_kategori == 1 ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                        {{ $m->id_kategori == 1 ? 'Makanan' : 'Minuman' }}
                    </span>
                </td>
                <td class="p-6 font-bold">Rp {{ number_format($m->harga, 0, ',', '.') }}</td>
                <td class="p-6 text-center">
                    <div class="flex justify-center space-x-2">
                        <button class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition"><i class="fas fa-edit"></i></button>
                        <button class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalMenu" class="fixed inset-0 bg-black bg-opacity-50 hidden z-[60] flex items-center justify-center">
    <div class="bg-white w-[500px] p-8 rounded-[10px] shadow-2xl">
        <h3 class="text-2xl font-bold mb-6">Tambah Menu</h3>
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-sm text-gray-500 ml-2">ID Menu</label>
                    <input type="text" name="id_menu" class="w-full bg-gray-100 border-none rounded-2xl p-4 focus:ring-2 focus:ring-orange-500" placeholder="Contoh: Kopi Susu">
                </div>
                <div>
                    <label class="text-sm text-gray-500 ml-2">Nama Menu</label>
                    <input type="text" name="nama_menu" class="w-full bg-gray-100 border-none rounded-2xl p-4 focus:ring-2 focus:ring-orange-500" placeholder="Contoh: Kopi Susu">
                </div>
                <div>
                    <label class="text-sm text-gray-500 ml-2">Kategori</label>
                    <select name="id_kategori" class="w-full bg-gray-100 border-none rounded-2xl p-4 focus:ring-2 focus:ring-orange-500">
                        <option value="1">Makanan</option>
                        <option value="2">Minuman</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm text-gray-500 ml-2">Harga</label>
                    <input type="number" name="harga" class="w-full bg-gray-100 border-none rounded-2xl p-4 focus:ring-2 focus:ring-orange-500" placeholder="15000">
                </div>
                <div>
                    <label class="text-sm text-gray-500 ml-2">Gambar</label>
                    <input type="file" name="gambar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                </div>
            </div>
            <div class="flex space-x-4 mt-8">
                <button type="button" onclick="closeModal()" class="flex-1 p-4 bg-gray-100 rounded-2xl font-bold text-gray-500">Batal</button>
                <button type="submit" class="flex-1 p-4 bg-orange-500 rounded-2xl font-bold text-white shadow-lg shadow-orange-200">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() { document.getElementById('modalMenu').classList.remove('hidden'); }
    function closeModal() { document.getElementById('modalMenu').classList.add('hidden'); }
</script>

<div class = " mt-10">
    {{ $dataMenu->links() }}
</div>
@endsection
