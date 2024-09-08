@extends('layout')

@section('content')
<h1 class="text-3xl font-bold underline">
    Hello world!
</h1>

<div>
    <h2 class="text-xl font-semibold mt-6">Items</h2>
    <ul>
        @foreach ($items as $item)
            <li>
                <strong>{{ $item->name }}</strong> by {{ $item->manufacturer }} (Created at: {{ $item->created_at }})
            </li>
        @endforeach
    </ul>
</div>

<div>
    <h2 class="text-xl font-semibold mt-6">Reviews</h2>
    <ul>
        @foreach ($reviews as $review)
            <li>
                <strong>{{ $review->user_name }}</strong> rated {{ $review->rating }}:
                "{{ $review->review_text }}" (For item ID: {{ $review->item_id }}, Created at: {{ $review->created_at }})
            </li>
        @endforeach
    </ul>
</div>
@endsection
