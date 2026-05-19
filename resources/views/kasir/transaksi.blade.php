@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6 max-w-2xl bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Ringkasan Pesanan</h2>

    <div class="mb-6">
        @foreach($items as $item)
        <div class="flex justify-between py-1">
            <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
            <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
            <span></span>
        </div>
        @endforeach
    </div>
    <div class="mb-6">
        <div class="flex justify-between py-1">
            <span>{{$tipe}}</span>
            <span>{{$metode}}</span>
        </div>
    </div>
    <div class="mb-6">
        <div class="flex justify-between py-1">
            <span>Nomor Meja</span>
            <span>{{$noMeja}}</span>
        </div>
    </div>


    <div class="border-t pt-4 space-y-2">
        <div class="flex justify-between font-bold text-lg">
            <span>Total Tagihan</span>
            <span id="total_tagihan">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="mt-6 p-4 bg-gray-50 rounded-md">
            <label class="block text-sm font-medium text-gray-700">Nominal Uang Diterima</label>
            <input type="number" id="input_bayar" class="w-full mt-1 p-2 border rounded" placeholder="Masukkan angka...">

            <div class="flex justify-between mt-4 text-xl text-green-600 font-bold">
                <span>Kembalian</span>
                <span id="label_kembalian">Rp 0</span>
            </div>
        </div>
    </div>

    <div class="mt-8 flex gap-4 no-print">
        <button onclick="window.history.back()" class="flex-1 bg-gray-500 text-white py-2 rounded">Kembali</button>
        <button onclick="window.print()" class="flex-1 bg-blue-600 text-white py-2 rounded">Cetak Resi</button>
        <button onclick="selesaikanTransaksi()" class="flex-1 bg-green-600 text-white py-2 rounded">Transaksi Selesai</button>
    </div>
</div>

<style>
    /* CSS Khusus agar tombol tidak ikut tercetak di kertas */
    @media print {
        .no-print { display: none; }
        body { background: white; }
    }
</style>

<script>
    document.getElementById('input_bayar').addEventListener('input', function() {
    const total = {{ $total }};
    const bayar = parseInt(this.value) || 0;
    const kembalian = bayar - total;

    if(kembalian >= 0) {
        document.getElementById('label_kembalian').innerText = "Rp " + kembalian.toLocaleString('id-ID');
    } else {
        document.getElementById('label_kembalian').innerText = "Rp 0";
    }
});

function selesaikanTransaksi() {
    const bayar = parseInt(document.getElementById('input_bayar').value);
    const total = {{ $total }};

    if (isNaN(bayar) || bayar < total) {
        alert("Nominal Uang Kurang");
        return;
    }

    // Ambil data tambahan dari variabel Blade yang kita lempar tadi
    const dataTransaksi = {
        items: @json($items),
        total: total,
        tipe: "{{ $tipe }}",
        metode: "{{ $metode }}",
        nomor_meja: "{{ $noMeja }}", // Data nomor meja yang tadi kita input
        bayar: bayar,
        kembalian: bayar - total
    };

    fetch("{{ route('transaksi.simpan') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(dataTransaksi)
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Pembayaran Berhasil.");
            window.location.href = "{{ route('kasir.PointOfSales') }}"; // Balik ke menu awal
        } else {
            alert("Gagal: " + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Terjadi kesalahan koneksi ke server.");
    });
}

</script>

@endsection
