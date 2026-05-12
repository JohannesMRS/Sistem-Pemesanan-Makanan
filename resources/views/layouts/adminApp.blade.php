<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | MASBON</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans flex">

    <aside class="w-64 h-screen bg-white shadow-xl fixed left-0 top-0 p-6 flex flex-col rounded-r-[7px] z-50">
        <div class="mb-10">
            <h1 class="text-2xl font-bold text-orange-600">MAS <span class="text-gray-800">BON</span></h1>
            <p class="text-xs text-gray-400">Admin Control Panel</p>
        </div>

        <nav class="flex-grow space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'text-gray-500 hover:bg-orange-50' }} rounded-[7px] transition">
                <i class="fas fa-chart-line mr-3"></i> Dashboard
            </a>
            <a href="{{ route('admin.menu') }}" class="flex items-center p-3 {{ request()->routeIs('admin.menu') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'text-gray-500 hover:bg-orange-50' }} rounded-[7px] transition">
                <i class="fas fa-mug-hot mr-3"></i> Menu
            </a>
            <a href="{{ route('admin.transaksi') }}" class="flex items-center p-3 {{ request()->routeIs('admin.transaksi') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'text-gray-500 hover:bg-orange-50' }} rounded-[7px] transition">
                <i class="fas fa-exchange-alt mr-3"></i> Transaksi
            </a>
            <a href="{{ route('admin.laporan')}}" class="flex items-center p-3 {{ request()->routeIs('admin.laporan') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200' : 'text-gray-500 hover:bg-orange-50' }} rounded-[7px] transition">
                <i class="fas fa-file-invoice mr-3"></i> Laporan
            </a>
        </nav>

        <div class="mt-auto pb-6">
            <a href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all group">

                <div class="bg-gray-100 group-hover:bg-red-100 p-2 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="font-medium">Keluar Sistem</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <main class="ml-64 w-full p-10">
        @yield('content')
    </main>

</body>
</html>
