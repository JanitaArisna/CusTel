<!-- resources/views/account-manager/account-manager.blade.php -->
<x-app-layout>
    @extends('layouts.template')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Manager Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Welcome to the Account Manager page!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>