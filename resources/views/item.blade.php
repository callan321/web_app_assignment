@extends('layout')

@section('content')
<div class=" mx-auto px-8 flex space-y-6 max-w-6xl flex-col">
    @if (request()->has('name_changed'))
        <div class="bg-orange-100 border border-orange-500 text-gray-800 p-4 rounded  mb-4">
            Your username was changed to: {{ request('name_changed') }}
        </div>
    @endif
    <div class="grid grid-cols-1  md:grid-cols-2">
        <div class="max-w-lg  ">
            <section aria-labelledby="information-heading" class="mt-4">
                <div class="mt-16">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 ">{{ $item->name }}</h1>
                </div>
                <div class="mt-4">
                    <h3 class="font-semibold tracking-tight text-gray-900 text-xl">{{ $item->manufacturer }}</h3>
                </div>
                <div class="mt-2">
                    <p>Average Rating: {{ collect($reviews)->avg('rating') }} / 5</p>
                </div>
                <div class="mt-4">
                    <p class="text-base text-gray-500">Product description and other details can go here.</p>
                </div>
                <div class="mt-4">

                </div>
            </section>
        </div>
        <div class=" w-full h-[30rem]  md:px-8">
            <img src="https://via.placeholder.com/150" alt="{{ $item->name }}" class="h-full w-full object-cover object-center">
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-semibold">Reviews</h2>
        <a href="{{ url('review/' . $item->id) }}">Add a Review</a>

        <ul>
            @forelse($reviews as $review)
                <li class="mt-4 border p-4 rounded-md">
                    <p class="font-bold">{{ $review->user_name }} (Rating: {{ $review->rating }} / 5)</p>
                    <p>{{ $review->review_text }}</p>
                    <p class="text-sm text-gray-500">{{ $review->created_at }}</p>
                </li>
            @empty
                <p>No reviews yet.</p>
            @endforelse
        </ul>
    </div>
</div>
@endsection
