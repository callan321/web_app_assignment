@extends('layout')

@section('content')
    <div class=" mx-auto px-8 flex space-y-6 max-w-6xl flex-col">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900">Manufacturers and Average Ratings</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($manufacturers as $manufacturer)
                <div class="border p-6 rounded-md shadow-md bg-white">
                    <a href="{{ url('/manufacturer/' . urlencode($manufacturer->manufacturer)) }}" class="text-lg font-semibold text-indigo-600 hover:underline">
                        {{ $manufacturer->manufacturer }}
                    </a>
                    <p class="mt-2 text-gray-700">Average Rating: {{ round($manufacturer->average_rating, 2) }} / 5</p>
                </div>
            @empty
                <p>No manufacturers found.</p>
            @endforelse
        </div>
    </div>
@endsection
