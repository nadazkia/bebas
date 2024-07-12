<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Brands') }}
        </h2>
    </x-slot>

    <!-- Tabel -->
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between items-center overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full flex-auto block pt-10 pb-10 rounded-xl">
                    <div class="flex justify-between items-center mb-10 bg-white px-4 rounded-xl h-20">
                        <div class="ml-2 text-gray-900 w-2/3 rounded-lg py-6">
                            {{ __("You're logged in!") }}
                        </div>

                    </div>

                    <div class="bg-white py-6 px-9 rounded-xl">
                        <div class="pt-2 pb-8 flex justify-end md:justify-between items-center">
                            <div class="hidden md:inline">
                                <h1 class="font-bold text-3xl">Data Brands</h1>
                            </div>
                            <div class="flex justify-end items-center space-x-3">
                                <!-- search Input -->
                                <div class="w-full">
                                    <label for="search" class="hidden md:inline">Search: </label>
                                    <input type="text" id="search" name="search"
                                        class="border border-transparent p-2 rounded bg-gray-100 focus:outline-none focus:border-teal-200 focus:bg-white"
                                        placeholder="Search here...">
                                </div>
                                <button id="import"
                                    class="px-3 py-2 bg-teal-700 text-white rounded-lg  hover:bg-teal-600 hover:outline-none hover:rounded-0 transition duration-150 ease-in-out whitespace-nowrap">
                                    IMPORT
                                </button>
                                <button id="export"
                                    class="px-3 py-2 bg-teal-700 text-white rounded-lg  hover:bg-teal-600 hover:outline-none hover:rounded-0 transition duration-150 ease-in-out whitespace-nowrap">
                                    EXPORT
                                </button>
                            </div>
                        </div>


                        <!-- Table -->
                        <table class="w-full my-0 align-middle text-dark border-gray-200 table-fixed">
                            <thead class="align-bottom">
                                <tr class="font-bold text-slate-400 table-row">
                                    <th class="w-14 cursor-pointer pb-3 text-center table-cell sort " data-sort-by="id">
                                        #</th>
                                    <th class="truncate cursor-pointer pb-3 text-left pr-12 pl-3 table-cell sort"
                                        data-sort-by="name">NAME</th>
                                    <th class="cursor-pointer pb-3 text-left pl-3 hidden md:table-cell sort"
                                        data-sort-by="category">
                                        CATEGORY</th>
                                    <th class="cursor-pointer pb-3 text-left px-4 truncate hidden md:table-cell sort"
                                        data-sort-by="description">DESCRIPTION
                                    </th>
                                    <th class="pb-3 text-right table-cell w-16 md:w-64">ACTION </th>
                                </tr>
                            </thead>
                            <tbody id="brandTableBody">
                                <!-- Brand rows will be appended here -->
                                @foreach ($brands as $brand)
                                    <tr class="border-b last:border-b-0 border-slate-300 table-row">
                                        <td class="my-2 w-14 text-center table-cell">{{ $brand->id }}</td>
                                        <td class="py-2 table-cell whitespace-nowrap truncate">{{ $brand->name }}</td>
                                        <td class="px-4 py-2 hidden md:flex flex-wrap gap-1">
                                            <a href='#'
                                                class='showCategory cursor-pointer text-sm text-emerald-700 bg-emerald-50 border border-emerald-700 rounded-full px-2 py-1 hover:bg-emerald-700 hover:text-white duration-300 ease-in-out truncate'>{{ $brand->barcode }}</a>
                                        </td>
                                        <td class="px-4 py-2 text-left hidden md:table-cell truncate">
                                            {{ $brand->description }}
                                        </td>
                                        <td class="py-2 flex flex-wrap justify-end text-right h-full gap-2 md:gap-2">
                                            <button
                                                class="showBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-700 hover:text-white duration-300 transition ease-in-out">Show</button>

                                            <button
                                                class="editBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-orange-700 bg-orange-100 rounded-lg hover:bg-orange-700 hover:text-white duration-300 transition ease-in-out">Edit</button>

                                            <button
                                                class="deleteBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-red-700 bg-red-100 rounded-lg hover:bg-red-700 hover:text-white duration-300 transition ease-in-out">Delete</button>
                                        </td>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div id="pagination" class="mt-5 flex justify-end gap-2 outline-none">
                            <!-- Pagination links will be appended here -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="brandModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center font-sans text-gray-900 antialiased animate-fade-in">
        <div
            class="bg-white p-6 rounded-lg flex flex-col sm:justify-center items-center w-full max-w-72 animate-slide-up">
            {{-- <div class="w-full sm:max-w-md my-6 px-10 pt-14 pb-6 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
            <h2 id="judulModal" class="text-xl font-bold text-center mb-3">IMPORT/EXPORT Title</h2>
            <form action="{{ route('brands.import') }}" id="brandForm" class="w-full" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="parentBrandName" class="relative w-full min-w-[200px] h-10 mb-5">
                    <label for="file">Pilih File</label>
                    <input type="file" name="file" id="file" required>
                    {{-- <x-admin.input id="brandName" name="name" />
                    <x-admin.label for="brandName">Pilih File</x-admin.label> --}}
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit" id="saveModal"
                        class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 ">Submit</button>
                    <button type="button" id="closeModal"
                        class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md text-white hover:bg-red-600 focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                </div>
            </form>
            {{-- </div> --}}
        </div>
    </div>


    <script>
        // Open Modal
        $(document).on('click', '#import', function() {
            $('#brandModal').removeClass('hidden').addClass('flex');
            $('#judulModal').html('Import Brand');
        });

        $(document).on('click', '#export', function() {
            $('#brandModal').removeClass('hidden').addClass('flex');
            $('#judulModal').html('Export Brand');
        });

        // Close modal
        $('#closeModal').on('click', function() {
            $('#brandModal').addClass('hidden').removeClass('flex');
        });
    </script>
</x-app-layout>
