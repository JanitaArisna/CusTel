<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Non-Datin Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Button Cards Section -->
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Card Button for Batam Kota -->
                        <div class="bg-gray-100 p-6 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            <a href="#" class="block text-center text-xl font-semibold text-gray-700">
                                Nongsa
                            </a>
                        </div>

                        <!-- Card Button for Batu Aji -->
                        <div class="bg-gray-100 p-6 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            <a href="#" class="block text-center text-xl font-semibold text-gray-700">
                                Panbil
                            </a>
                        </div>

                        <!-- Card Button for Batu Ampar -->
                        <div class="bg-gray-100 p-6 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            <a href="#" class="block text-center text-xl font-semibold text-gray-700">
                                Batam Centre
                            </a>
                        </div>

                        <!-- Card Button for Belakang Padang -->
                        <div class="bg-gray-100 p-6 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            <a href="#" class="block text-center text-xl font-semibold text-gray-700">
                                Kabil
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
