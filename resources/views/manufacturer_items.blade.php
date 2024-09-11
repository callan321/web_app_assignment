@extends('layout')

@section('content')
    <div class=" mx-auto px-8 flex space-y-6 max-w-6xl flex-col">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900">Items by {{ $manufacturer }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($items as $item)
                <div class="border p-6 rounded-md shadow-md bg-white">
                    <a href="{{ url('/item/' . $item->id) }}" class="text-lg font-semibold text-indigo-600 hover:underline">
                        {{ $item->name }}
                    </a>
                    <p class="mt-2 text-gray-700">Average Rating: {{ round($item->average_rating, 2) }} / 5</p>
                </div>
            @empty
                <p>No items found for this manufacturer.</p>
            @endforelse
        </div>
    </div>
@endsection
