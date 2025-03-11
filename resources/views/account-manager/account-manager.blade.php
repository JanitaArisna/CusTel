<!-- resources/views/account-manager/account-manager.blade.php -->
<x-app-layout>
    @extends('layouts.template')
    <script src="https://cdn.tailwindcss.com"></script>
    @section('konten')
    <div class="flex flex-wrap justify-center gap-8 p-8">
        <a href="{{ route('business') }}" class="sm:w-full md:w-96 p-8 bg-gradient-to-r from-blue-500 to-blue-700 
            text-white text-xl font-bold text-center rounded-2xl shadow-xl 
            hover:bg-blue-600 hover:scale-105 transition-all duration-300">
            Business Service
        </a>
        <a href="{{ route('government') }}" class="sm:w-full md:w-96 p-8 bg-gradient-to-r from-green-500 to-green-700 
            text-white text-xl font-bold text-center rounded-2xl shadow-xl 
            hover:bg-green-600 hover:scale-105 transition-all duration-300">
            Government
        </a>
        <a href="{{ route('enterprise') }}" class="sm:w-full md:w-96 p-8 bg-gradient-to-r from-purple-500 to-purple-700 
            text-white text-xl font-bold text-center rounded-2xl shadow-xl 
            hover:bg-purple-600 hover:scale-105 transition-all duration-300">
            Enterprise
        </a>
    </div>
    @endsection
</x-app-layout>
