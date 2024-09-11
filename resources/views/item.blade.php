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
        <div class="pt-2">
        <a
            href="{{ url('review/' . $item->id) }}"
            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm"
        >Add a Review</a>

        </div>
        <ul>
            @forelse($reviews as $review)

                <li class="mt-4 border p-4 rounded-md">
                    <div class="grid grid-cols-[1fr,auto]">
                        <div >
                        <p class="font-bold">{{ $review->user_name }} (Rating: {{ $review->rating }} / 5)</p>
                        <p>{{ $review->review_text }}</p>
                        <p class="text-sm text-gray-500">{{ $review->created_at }}</p>
                        </div>
                        <div class="flex items-center md:px-4">
                            <a
                                href="{{ url('/review/' . $item->id . '?edit=true&review_id=' . $review->id . '&user_name=' . urlencode($review->user_name) . '&rating=' . $review->rating . '&review_text=' . urlencode($review->review_text)) }}"
                                type="button"
                                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm"
                            >
                                Edit
                            </a>
                        </div>
                    </div>
                </li>

            @empty
                <p class="mt-3">No reviews yet.</p>
            @endforelse
        </ul>
    </div>
</div>
@endsection
