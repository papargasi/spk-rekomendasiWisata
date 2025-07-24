@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-center">Top Picks Wisata</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($hasil as $wisata)
        <div class="bg-white shadow-md rounded-xl p-5 border border-gray-200 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold mb-2 text-indigo-600">{{ $wisata->nama }}</h3>
            <span class="text-sm text-gray-500 px-2 py-1 bg-gray-100 rounded-full">{{ ucfirst($wisata->jenis) }}</span>

            <div class="mt-4 text-sm space-y-1">
                <p>📊 Rating: <span class="font-medium">{{ $wisata->penilaian->rating }}</span></p>
                <p>📍 Jarak: <span class="font-medium">{{ $wisata->penilaian->jarak }} km</span></p>
                <p>🧼 Kebersihan: <span class="font-medium">{{ $wisata->penilaian->kebersihan }}</span></p>
            </div>

            <div class="mt-4">
                <strong class="text-md">⭐ Skor SMART:</strong>
                <span class="text-xl font-bold text-green-600">{{ number_format($wisata->penilaian->nilai_total, 2) }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
