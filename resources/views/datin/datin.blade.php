<!-- resources/views/datin/datin.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Datin Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Judul Besar dan Bold -->
                    <h1 class="font-bold mb-3" style="font-size: 2rem;">REVENUE DATIN</h1>

                    <!-- Tombol Search dan All untuk Filter -->
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-md" />
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Search</button>
                            <select class="px-4 py-2 border rounded-md">
                                <option value="all">All</option>
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Acc Num</th>
                                    <th class="px-4 py-2 border">Cust Name</th>
                                    <th class="px-4 py-2 border">NIPNAS</th>
                                    <th class="px-4 py-2 border">Segment</th>
                                    <th class="px-4 py-2 border">Witel</th>
                                    <th class="px-4 py-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 border">12345</td>
                                    <td class="px-4 py-2 border">John Doe</td>
                                    <td class="px-4 py-2 border">98765</td>
                                    <td class="px-4 py-2 border">Retail</td>
                                    <td class="px-4 py-2 border">Jakarta</td>
                                    <td class="px-4 py-2 border">
                                        <button class="bg-green-500 text-white px-4 py-2 rounded-md">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">67890</td>
                                    <td class="px-4 py-2 border">Jane Smith</td>
                                    <td class="px-4 py-2 border">12345</td>
                                    <td class="px-4 py-2 border">Corporate</td>
                                    <td class="px-4 py-2 border">Surabaya</td>
                                    <td class="px-4 py-2 border">
                                        <button class="bg-green-500 text-white px-4 py-2 rounded-md">Edit</button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
