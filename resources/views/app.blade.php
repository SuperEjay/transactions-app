@extends('layout')
@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-center h-screen gap-4">
            <h1 class="text-4xl font-bold">Welcome to my Technical Test</h1>
            <a href="{{ route('customers.index') }}" class="border border-gray-500 rounded-md text-black px-4 py-2 hover:bg-black hover:text-white transition-all duration-300">
                Start Using App
            </a>
        </div>
    </div>
@endsection
