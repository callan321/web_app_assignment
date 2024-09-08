@extends('layout')

@section('content')

    <div class="mx-auto px-4 space-x-8 grid max-w-6xl grid-cols-1 md:grid-cols-2">
        <div class="max-w-lg ">
            <section aria-labelledby="information-heading" class="mt-4">
                <div class="mt-16">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 ">Items Name</h1>
                </div>
                <div class="mt-4">
                    <h3 class="font-semibold tracking-tight text-gray-900 text-xl">Manufactor</h3>
                </div>
                <div class="mt-2">
                    <p>5 / 10</p>
                </div>
                <div class="mt-4">
                    <p class="text-base text-gray-500">Store all the product information here.</p>
                </div>
                <div class="mt-10">
                    <button type="submit" class="flex items-center justify-center rounded-md bg-indigo-600 px-12  py-3 font-medium text-white hover:bg-indigo-700">Review</button>
                </div>
            </section>
        </div>
        <div class=" w-[30rem] h-[30rem]">
            <img src="https://via.placeholder.com/150" alt="Placeholder Image" class="h-full w-full object-cover object-center">
        </div>

    </div>
@endsection


