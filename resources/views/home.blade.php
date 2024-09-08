@extends('layout')

@section('content')
    <div class="w-full flex justify-center">
        <div class="max-w-4xl w-full flex flex-col">
            <h1 class="text-3xl font-bold underline">Items</h1>

            <!-- Sorting Buttons -->
            <div class="mt-4 flex-col flex gap-2 w-64 border shadow p-4">
                <h3 class="text-gray-800 text-2xl font-semibold">Sort</h3>
                <a class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white"
                   href="{{ url('/home') }}">Created At</a>
                <a class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white"
                   href="{{ url('/home/revasc') }}">Review Count Ascending</a>
                <a class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white"
                    href="{{ url('/home/revdesc') }}">Review Count Descending</a>
                <a  class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white"
                    href="{{ url('/home/rateasc') }}">Rating Ascending</a>
                <a class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white"
                    href="{{ url('/home/ratedesc') }}">Rating Descending</a>
            </div>

            <!-- Items Table -->
            <table class="min-w-full border-collapse border border-gray-300 mt-4">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-2">Name</th>
                    <th class="border border-gray-300 p-2">Manufacturer</th>
                    <th class="border border-gray-300 p-2">Created At</th>
                    <th class="border border-gray-300 p-2">Number of Reviews</th>
                    <th class="border border-gray-300 p-2">Average Rating</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->manufacturer }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->created_at }}</td>
                        <td class="border border-gray-300 p-2">{{ $item->review_count }}</td>
                        <td class="border border-gray-300 p-2">{{ number_format($item->average_rating, 2) }}</td>
                        <td class="border border-gray-300 p-2 space-x-2">
                            <a href="{{ url('/item/' . $item->id) }}" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white">View</a>
                            <a href="{{ url('/item/del/' . $item->id) }}" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
