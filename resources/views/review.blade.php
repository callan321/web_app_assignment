@extends('layout')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">
            {{ request()->query('edit') ? 'Edit Review' : 'Add Review' }}
        </h1>

        <form action="{{ url('/submit-review') }}" method="POST">

            @csrf

            @if(request()->query('edit'))
                <input type="hidden" name="edit" value="true">
                <input type="hidden" name="review_id" value="{{ request()->query('review_id') }}">
            @else
                <input type="hidden" name="edit" value="false">
                <input type="hidden" name="review_id" value="">
            @endif


            <input type="hidden" name="item_id" value="{{ $itemId }}">

            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="user_name" id="user_name" value="{{ request()->query('edit') ? request()->query('user_name') : '' }}" class="mt-1 p-2 w-full border rounded-lg shadow-sm sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1 to 5)</label>
                <select name="rating" id="rating" class="mt-1 p-2 w-full border rounded-lg shadow-sm sm:text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" @selected(request()->query('rating') == $i)>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-4">
                <label for="review_text" class="block text-sm font-medium text-gray-700">Review</label>
                <textarea name="review_text" id="review_text" rows="4" class="mt-1 p-2 w-full border rounded-lg shadow-sm sm:text-sm" required>{{ request()->query('edit') ? request()->query('review_text') : '' }}</textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 ">
                    {{ request()->query('edit') ? 'Update Review' : 'Submit Review' }}
                </button>
            </div>
        </form>
    </div>
@endsection
