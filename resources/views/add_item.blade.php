@extends('layout')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Add New Item</h1>

        <form action="{{ url('/add-item') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="manufacturer" class="block text-sm font-medium text-gray-700">Manufacturer</label>
                <input type="text" name="manufacturer" id="manufacturer" class="mt-1 p-2 w-full border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Add Item
                </button>
            </div>
        </form>
    </div>
@endsection
