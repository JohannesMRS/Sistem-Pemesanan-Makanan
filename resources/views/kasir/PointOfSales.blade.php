@extends('layouts.app')

@section('content')
<div class="flex w-full h-screen bg-gray-50 overflow-hidden font-sans">

    <div class="p-6 w-full overflow-y-auto">
         <div class="mt-auto pb-6">
            <a href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-[7px] transition-all group">

                <div class="bg-gray-100 group-hover:bg-red-100 p-2 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="font-medium">Keluar Sistem</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>


        <h1 class = "text-center text-4xl mb-10 font-bold bg-gray-100 border border-gray-200 rounded-md p-5">Makanan</h1>
        <div class="flex flex-row flex-wrap w-[999px] gap-10 justify-center">
            @foreach($dataMakanans as $item)
            <div class="bg-white w-[400px] h-[450px] p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition cursor-pointer group mr-0 mb-2.5">
                <div class="h-[280px] bg-gray-100 rounded-[7px] mb-4 overflow-hidden relative">
                    <img src="{{ asset('img/'.$item->gambar) }}" alt="Menu" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">

                </div>
                <h3 class="font-bold text-gray-800 text-lg">{{ $item->nama_menu }}</h3>
                <p class="text-sm text-gray-500 mb-4 text-line-clamp-2">{{ $item->deskripsi }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-orange-600 font-bold">{{ $item->harga }}</span>
                    <button class="bg-gray-100 text-gray-800 w-20 h-10 rounded-lg hover:bg-orange-500 hover:text-white transition flex items-center justify-center"
                    onclick = "addToCart('{{$item->id_menu}}', '{{$item->nama_menu}}', {{$item->harga}} )">
                        Tambah
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <h1 class = "text-center text-4xl mt-24 mb-10 font-bold bg-gray-100 border border-gray-200 rounded-md p-5">Minuman</h1>
        <div class="flex flex-row flex-wrap w-[999px] gap-10 justify-center">
            @foreach($dataMinumans as $item)
            <div class="bg-white w-[400px] h-[450px] p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition cursor-pointer group mr-0 mb-2.5">
                <div class="h-[280px] bg-gray-100 rounded-[7px] mb-4 overflow-hidden relative">
                    <img src="{{ asset('img/'.$item->gambar) }}" alt="Menu" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">

                </div>
                <h3 class="font-bold text-gray-800 text-lg">{{ $item->nama_menu }}</h3>
                <p class="text-sm text-gray-500 mb-4 text-line-clamp-2">{{ $item->deskripsi }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-orange-600 font-bold">{{ $item->harga }}</span>
                    <button class="bg-gray-100 text-gray-800 w-20 h-10 rounded-lg hover:bg-orange-500 hover:text-white transition flex items-center justify-center"
                    onclick = "addToCart('{{$item->id_menu}}', '{{$item->nama_menu}}', {{$item->harga}} )">
                        Tambah
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
<div class="w-1/3 bg-white border-l border-gray-100 p-6 flex flex-col shadow-2xl">
    <div class="flex items-center gap-3 mb-8">
        <div class="bg-orange-100 p-3 rounded-[7px]">
            <i class="fas fa-shopping-cart text-orange-600"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-800">Detail Pesanan</h2>
    </div>

    <div id="cart-items" class="flex-1 overflow-y-auto space-y-4">
        <div class="text-center py-10 text-gray-400 italic">
            Belum ada pesanan...
        </div>
    </div>

    <div class="mt-6 pt-6 border-t border-dashed border-gray-200 space-y-3">
        <div class="flex justify-between text-gray-600">
            <span>Subtotal</span>
            <span id="subtotal" class="font-medium">Rp 0</span>
        </div>
        <div class="flex justify-between text-gray-600">
            <span>Pajak (10%)</span>
            <span id="tax" class="font-medium">Rp 0</span>
        </div>
        <div class="flex justify-between text-2xl font-black text-gray-800 pt-2">
            <span>Total</span>
            <span id="total" class="text-orange-600">Rp 0</span>
        </div>
    </div>

    <button type ="button" onclick="prosesPembayaran()" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-[7px] mt-8 shadow-lg shadow-orange-200 transition-all active:scale-95">
        PROSES PEMBAYARAN
    </button>
</div>



<div id="modalOpsi" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-[7px] p-8 w-full max-w-md shadow-2xl transform transition-all">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Detail Transaksi</h3>
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Nomor Meja</label>
            <input type="number" id="inputNomorMeja" placeholder="Masukkan nomor Meja"
                   class="w-full border-2 border-gray-200 rounded-[7px] p-3 focus:border-orange-500 outline-none text-lg">
            <p class="text-xs text-gray-400 mt-1">*Input 0 atau kosong jika Take Away</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-semibold  text-gray-600 mb-3">Tipe Pesanan</label>
            <div class="grid grid-cols-2 gap-4">
                <button onclick="setTipe('Dine In')" id="btnDineIn" class="border-2 border-orange-500 bg-orange-50 text-orange-600 py-3 rounded-[7px]  transition-all">Dine In</button>
                <button onclick="setTipe('Take Away')" id="btnTakeAway" class="border-2 border-gray-200 py-3 rounded-[7px]  text-gray-500 transition-all">Take Away</button>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-600 mb-3">Metode Pembayaran</label>
            <select id="selectMetode" class="w-full border-2 border-gray-200 rounded-[7px] p-3 focus:border-orange-500 outline-none font-medium">
                <option value="Tunai">Tunai (Cash)</option>
                <option value="Transfer">Transfer Bank</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button onclick="tutupModal()" class="flex-1 py-3 text-gray-500 font-bold hover:text-gray-700">Batal</button>
            <button onclick="konfirmasiKeCheckout()" class="flex-1 bg-orange-500 text-white py-3 rounded-[7px] font-bold shadow-lg shadow-orange-200 hover:bg-orange-700 hover:text-gray-200 duration-200">Lanjut ke Checkout</button>
        </div>
    </div>
</div>

</div>

<form id="formTransaksi" action="{{ route('kasir.transaksi') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="cart_data" id="cart_data">
    <input type="hidden" name="total_tagihan" id="form_total">
</form>


<script>
let cart = [];

function addToCart(id, name, price) {
    // Cek apakah item sudah ada di keranjang
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, quantity: 1 });
    }
    renderCart();
}

function updateQuantity(id, delta) {
    const item = cart.find(item => item.id === id);
    if (item) {
        item.quantity += delta;
        // Hapus item jika jumlahnya 0
        if (item.quantity <= 0) {
            cart = cart.filter(i => i.id !== id);
        }
    }
    renderCart();
}

function renderCart() {
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = '';
    let subtotal = 0;

    cart.forEach(item => {
        subtotal += item.price * item.quantity;
        cartContainer.innerHTML += `
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded-[7px] border border-gray-100 animate-fade-in">
                <div class="flex gap-3">
                    <div>
                        <h4 class="font-bold text-gray-800 text-sm">${item.name}</h4>
                        <p class="text-xs text-gray-500">Rp ${item.price.toLocaleString('id-ID')}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button onclick="updateQuantity('${item.id}', -1)" class="w-6 h-6 rounded border border-gray-300 flex items-center justify-center text-xs hover:bg-red-500 hover:text-white transition">-</button>
                    <span class="font-bold text-sm">${item.quantity}</span>
                    <button onclick="updateQuantity('${item.id}', 1)" class="w-6 h-6 rounded bg-gray-800 text-white flex items-center justify-center text-xs hover:bg-orange-500 transition">+</button>
                </div>
            </div>
        `;
    });

    const tax = subtotal * 0.1;
    const total = subtotal + tax;

    document.getElementById('subtotal').innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;
    document.getElementById('tax').innerText = `Rp ${tax.toLocaleString('id-ID')}`;
    document.getElementById('total').innerText = `Rp ${total.toLocaleString('id-ID')}`;
}

let tipePesanan = "Dine In";


function prosesPembayaran() {
    // if (e) e.preventDefault();
    // 1. Validasi Keranjang
    if (cart.length === 0) {
        alert("Keranjang masih kosong, Partner!");
        return;
    }
   const modal = document.getElementById('modalOpsi');
    if (modal) {
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    // 2. Ambil elemen total (Pastikan ID 'total' ada di HTML kamu)
    const totalElement = document.getElementById('total');
    if (!totalElement) {
        console.error("Elemen dengan ID 'total' tidak ditemukan!");
        return;
    }

    const total = parseInt(totalElement.innerText.replace(/\D/g, ''));

    // 3. Masukkan data ke form hidden
    const cartDataInput = document.getElementById('cart_data');
    const formTotalInput = document.getElementById('form_total');
    const formTransaksi = document.getElementById('formTransaksi');

    if (cartDataInput && formTotalInput && formTransaksi) {
        cartDataInput.value = JSON.stringify(cart);
        formTotalInput.value = total;

        // 4. Gas ke halaman checkout!
        // formTransaksi.submit();
    } else {
        alert("Form checkout tidak ditemukan di halaman ini!");
    }
}

function setTipe(tipe) {
    tipePesanan = tipe;
    // Animasi tombol aktif
    const btnDine = document.getElementById('btnDineIn');
    const btnTake = document.getElementById('btnTakeAway');

    if(tipe === 'Dine In') {
        btnDine.className = "border-2 border-orange-500 bg-orange-50 text-orange-600 py-3 rounded-[7px] font-bold transition-all";
        btnTake.className = "border-2 border-gray-200 py-3 rounded-[7px] font-bold text-gray-500 transition-all";
    } else {
        btnTake.className = "border-2 border-orange-500 bg-orange-50 text-orange-600 py-3 rounded-[7px] font-bold transition-all";
        btnDine.className = "border-2 border-gray-200 py-3 rounded-[7px] font-bold text-gray-500 transition-all";
    }
}

function tutupModal() {
    const modal = document.getElementById('modalOpsi');
    modal.classList.add('hidden');
    modal.style.display = 'none';
}

function konfirmasiKeCheckout() {
    const total = parseInt(document.getElementById('total').innerText.replace(/\D/g, ''));
    const metode = document.getElementById('selectMetode').value;
    let noMeja = document.getElementById('inputNomorMeja').value;
    if (noMeja === "" || tipePesanan === 'Take Away') {
        noMeja = 0; // Jika kosong atau take away, set status meja jadi 0
    }
    // Masukkan semua data ke form hidden
    document.getElementById('cart_data').value = JSON.stringify(cart);
    document.getElementById('form_total').value = total;

    // Tambahkan input hidden baru secara dinamis untuk tipe dan metode
    const form = document.getElementById('formTransaksi');

    // Kita buatkan input tambahan agar terbawa ke controller
    form.innerHTML += `<input type="hidden" name="tipe_pesanan" value="${tipePesanan}">`;
    form.innerHTML += `<input type="hidden" name="metode_bayar" value="${metode}">`;
    formTransaksi.innerHTML += `<input type="hidden" name="nomor_meja" value="${noMeja}">`;

    form.submit();
}


</script>



@endsection



