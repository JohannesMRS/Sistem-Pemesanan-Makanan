@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
        <p class="text-gray-600 text-sm">Silakan login untuk mengakses sistem</p>
    </div>

    @error('loginError')
    <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
@enderror

    <form action="{{ route('login.post') }}" method="POST" autocomplete = "off">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="text" name="username" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" autocomplete="new-password">
        </div>

        <button type="submit"
            class="w-full bg-orange-600 text-white font-bold py-2 rounded-lg hover:bg-orange-700 transition duration-200">
            MASUK
        </button>
    </form>

    <div class="mt-6 text-center text-xs text-gray-400">
        &copy; MasBon - Managed By Johannes
    </div>
</div>
@endsection
