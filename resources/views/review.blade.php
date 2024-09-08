@extends('layout')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Add a Review</h1>

        <form action="{{ url('/add-review') }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $itemId }}">

            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="user_name" id="user_name" class="mt-1 p-2 w-full border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1 to 5)</label>
                <select name="rating" id="rating" class="mt-1 p-2 w-full border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="review_text" class="block text-sm font-medium text-gray-700">Review</label>
                <textarea name="review_text" id="review_text" rows="4" class="mt-1 p-2 w-full border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
@endsection
