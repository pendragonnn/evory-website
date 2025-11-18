@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Evory Event Booth Booking</h1>

        <p class="text-gray-700 mb-6">
            Hai <span class="font-semibold">{{ auth()->user()->name }}</span>!  
            Selamat datang di platform pemesanan booth event 🎪
        </p>

        <div class="space-y-4">
            <a href="#" class="block p-4 border rounded-lg hover:bg-gray-100 transition">
                <h2 class="font-semibold text-lg">Lihat Event</h2>
                <p class="text-gray-600 text-sm">Jelajahi event yang tersedia</p>
            </a>

            <a href="#" class="block p-4 border rounded-lg hover:bg-gray-100 transition">
                <h2 class="font-semibold text-lg">Pesanan Saya</h2>
                <p class="text-gray-600 text-sm">Cek status penyewaan booth</p>
            </a>
        </div>
    </div>
</div>
@endsection
