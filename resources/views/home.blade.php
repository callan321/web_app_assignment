@extends('layout')

@section('content')
    <div class="w-full flex justify-center">

    <div class=" max-w-4xl w-full flex  flex-col">
    <h1 class="text-3xl font-bold underline">Items</h1>
        <h2 class="text-xl font-semibold mt-6">Items</h2>
        <table class="min-w-full border-collapse border border-gray-300 mt-4">
            <thead>
            <tr>
                <th class="border border-gray-300 p-2">Name</th>
                <th class="border border-gray-300 p-2">Manufacturer</th>
                <th class="border border-gray-300 p-2">Created At</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $item->name }}</td>
                    <td class="border border-gray-300 p-2">{{ $item->manufacturer }}</td>
                    <td class="border border-gray-300 p-2">{{ $item->created_at }}</td>
                    <td class="border border-gray-300 p-2 space-x-2">
                        <a
                            href="{{ url('/item/' . $item->id) }}"
                            type="button" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm "
                        >
                            View
                        </a>
                        <a
                            href="{{ url('/item/del/' . $item->id) }}"
                            type="button" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm "
                        >
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
