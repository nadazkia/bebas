<x-app-layout>
    <x-slot name="header" class="relative">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands') }}
        </h2>

        <div class="fixed top-0 right-2 w-11/12">
            <div id="divSuccess" class="absolute w-11/12 md:w-1/3 block right-0 md:right-2 top-7">
                <!-- jika Sukses append disini -->
            </div>
        </div>
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
                                <h1 class="font-bold text-3xl">Brands</h1>
                            </div>
                            <div class="flex justify-end items-center space-x-3">
                                <!-- search Input -->
                                <div class="w-full">
                                    <label for="search" class="hidden md:inline">Search: </label>
                                    <input type="text" id="search" name="search"
                                        class="border border-transparent p-2 rounded bg-gray-100 focus:outline-none focus:border-teal-200 focus:bg-white"
                                        placeholder="Search here...">
                                </div>
                                <button id="addBrand"
                                    class="px-3 py-2 bg-teal-700 text-white rounded-lg  hover:bg-teal-600 hover:outline-none hover:rounded-0 transition duration-150 ease-in-out whitespace-nowrap">
                                    Add Brand
                                </button>
                                <button id="import"
                                    class="px-3 py-2 bg-teal-700 text-white rounded-lg  hover:bg-teal-600 hover:outline-none hover:rounded-0 transition duration-150 ease-in-out whitespace-nowrap">
                                    Import
                                </button>
                                <button id="export"
                                    class="px-3 py-2 bg-teal-700 text-white rounded-lg  hover:bg-teal-600 hover:outline-none hover:rounded-0 transition duration-150 ease-in-out whitespace-nowrap">
                                    Export
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
            <h2 id="judulModal" class="text-xl font-bold text-center mb-3">Modal Title</h2>
            <form id="brandForm" class="w-full">
                @csrf
                @method('PUT')
                <input type="hidden" id="brandId">
                <div id="parentBrandName" class="relative w-full min-w-[200px] h-10 mb-5">
                    <x-admin.input id="brandName" name="name" />
                    <x-admin.label for="brandName">Brand Name</x-admin.label>
                </div>

                <div id="parentBrandDescription" class="relative w-full min-w-[200px] h-10 mb-5">
                    <x-admin.input name="description" id="brandDescription" />
                    <x-admin.label for="brandDescription">Description</x-admin.label>
                </div>

                <div class="relative w-full min-w-[200px] mb-5">
                    <div class="flex flex-col rounded">
                        <div id="parentCategorySearch" class="relative w-full min-w-[200px] h-10 mb-2">
                            <x-admin.input type="search" id="categorySearch" class="border-b-0" />
                            <x-admin.label for="categorySearch">Search to Add Category</x-admin.label>
                        </div>
                        <div id="selectedCategories" class="flex flex-wrap gap-1 max-h-24 overflow-y-auto">
                            <!--  Append Category in Category Modal -->
                        </div>
                        <div id="brandCategoriesContainer"
                            class="hidden absolute shadow-xl top-11 bg-white z-40 w-full left-0 rounded max-h-[300px] overflow-y-auto">
                            <div id="brandCategories"
                                class="flex flex-col items-center w-full shadow cursor-pointer border-gray-100 rounded-t border-b">
                                <!--  Append Multiselect Category in Brand Modal -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit" id="saveModal"
                        class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 ">Save</button>
                    <button type="button" id="closeModal"
                        class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md text-white hover:bg-red-600 focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                </div>
            </form>
            {{-- </div> --}}
        </div>
    </div>

    <!-- Modal Import-->
    <div id="brandModalImport"
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
                    <button type="submit" id="saveModalImport"
                        class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 ">Submit</button>
                    <button type="button" id="closeModalImport"
                        class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md text-white hover:bg-red-600 focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                </div>
            </form>
            {{-- </div> --}}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch brands
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // Fetch brands with pagination, search, and sort
            function fetchBrands(page = 1, search = '', sortBy = 'id', sortDirection = 'desc') {
                $.ajax({
                    url: "/brand?page=" + page + '&search=' + search + '&sortBy=' + sortBy +
                        '&sortDirection=' + sortDirection,
                    method: 'GET',
                    success: function(brands) {
                        let rows = '';
                        [...brands.data].forEach(brand => {
                            let xbrands = [...brand.categories];
                            rows += `
                            <tr class="border-b last:border-b-0 border-slate-300 table-row" data-id="${brand.id}">
                                <td class="my-2 w-14 text-center table-cell">${brand.id}</td>
                                <td class="py-2 table-cell whitespace-nowrap truncate">${brand.name}</td>
                                <td class="px-4 py-2 hidden md:flex flex-wrap gap-1">` +
                                // LIST BRAND START
                                $.map(
                                    xbrands,
                                    function(category, i) {
                                        return `<a href='#' data-id='` + category.id +
                                            `' class='showCategory cursor-pointer text-sm text-emerald-700 bg-emerald-50 border border-emerald-700 rounded-full px-2 py-1 hover:bg-emerald-700 hover:text-white duration-300 ease-in-out truncate'>` +
                                            category.name +
                                            `</a>`
                                    }).join('')
                                // LIST BRAND END
                                +
                                `</td>
                                <td class="px-4 py-2 text-left hidden md:table-cell truncate">${brand.description}</td>
                                <td class="py-2 flex flex-wrap justify-end text-right h-full gap-2 md:gap-2">
                                    <button class="showBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-700 hover:text-white duration-300 transition ease-in-out">Show</button>
    
                                    <button class="editBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-orange-700 bg-orange-100 rounded-lg hover:bg-orange-700 hover:text-white duration-300 transition ease-in-out">Edit</button>
    
                                    <button class="deleteBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-red-700 bg-red-100 rounded-lg hover:bg-red-700 hover:text-white duration-300 transition ease-in-out">Delete</button>
                                </td>
                            </tr>
                        `;
                        });
                        $('#brandTableBody').html(rows);

                        // Render pagination links
                        let pagination = '';
                        if (brands.prev_page_url) {
                            pagination += `
                                <button class="pagination-link px-2 py-1 hover:bg-teal-700 shadow-md hover:border-teal-700 hover:text-white duration-300 rounded-full bg-slate-200" data-page="${brands.current_page - 1}">
                                        <svg class="h-5 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"/>
                                    </svg>    
                                </button>
                            `;
                        };
                        for (let i = 1; i <= brands.last_page; i++) {
                            pagination += `
                                <button class="pagination-link px-3 py-1 hover:bg-teal-700 shadow-md hover:border-teal-700 hover:text-white duration-300 rounded-full 
                                ${i === brands.current_page ? 'bg-teal-700 text-white' : 'bg-slate-200'}" data-page="${i}">${i}</button>
                            `;
                        };
                        if (brands.next_page_url) {
                            pagination += `
                                <button class="pagination-link px-2 py-1 hover:bg-teal-700 shadow-md hover:border-teal-700 hover:text-white duration-300 rounded-full bg-slate-200" data-page="${brands.current_page + 1}">
                                    <svg class="h-5 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" />
                                    </svg>
                                </button>
                            `;
                        }
                        $('#pagination').html(pagination);
                    },
                    error: function(response) {
                        console.log('Error:', response);
                    }
                });
            }

            function loadCategories(selectedCategories = []) {
                $.ajax({
                    url: '/tag-category',
                    method: 'GET',
                    success: function(categories) {
                        let checkboxes = '';
                        categories.forEach(category => {
                            const checked = selectedCategories.includes(category.id) ?
                                'checked ' : '';
                            checkboxes +=
                                `<label for='${category.name}' 
                                    class="category-label flex flex-row text-sm cursor-pointer has-[:checked]:border-emerald-700 rounded w-full px-2 py-1 duration-300 ease-in-out has-[:checked]:text-emerald-800 hover:bg-teal-100 border-l border-transparent">
                                    <input data-category-id='${category.id}' type="checkbox" ${checked} name="category" id='${category.name}' value='${category.id}'
                                        class="dropdownOption checked:accent-teal-700 cursor-pointer">
                                    <span class="px-2">${category.name}</span>
                                </label>`
                        });
                        $('#brandCategories').html(checkboxes);
                        // Append selected categories to the selected categories list
                        selectedCategories.forEach(id => {
                            const category = categories.find(cat => cat.id === id);
                            appendCategory(category.id, category.name);
                        });
                    }
                })
            }

            // Filter categories in dropdown based on search input
            $('#categorySearch').on('input', function() {
                const search = $(this).val().toLowerCase();
                console.log(search);
                $('#brandCategoriesContainer').removeClass('hidden');
                $('#brandCategories label').each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(search) !== -1);
                });
            });

            $('#categorySearch').on('focus', function() {
                $('#brandCategoriesContainer').removeClass('hidden');
            });


            // Initial fetch without sort
            fetchBrands();

            // Hide brandCategoriesContainer when clicking outside of it and the search input
            $(document).on('click', function(event) {
                const $target = $(event.target);
                if (!$target.closest('#brandCategoriesContainer').length && !$target.closest(
                        '#categorySearch').length) {
                    $('#brandCategoriesContainer').addClass('hidden');
                }
            });


            // Append category to selected categories list
            function appendCategory(id, name, removable = true) {
                if ($(`#selectedCategory_${id}`).length === 0) {
                    const removeButton = removable ? `<button type="button" data-id="${id}" class="removeCategory flex flex-auto flex-row-reverse">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-x cursor-pointer hover:text-teal-400 rounded-full w-4 h-4 ml-2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>` :
                        '';
                    const categoryHtml = `
                            <div id="selectedCategory_${id}"
                                class="flex justify-center items-center font-medium py-1 px-2 rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                                <p class="text-xs font-normal leading-none max-w-full flex-initial">${name}</p>
                                ${removeButton}
                            </div>
            `;
                    $('#selectedCategories').append(categoryHtml);
                }
            }

            // Remove category from selected categories list
            $(document).on('click', '.removeCategory', function() {
                const id = $(this).data('id');
                $(`#selectedCategory_${id}`).remove();
                $(`#brandCategoriesContainer input[value="${id}"]`).prop('checked', false);
            });

            // Handle checkbox changes
            $('#brandCategoriesContainer').on('change', 'input[type="checkbox"]', function() {
                const id = $(this).val();
                const name = $(this).closest('label').text().trim();
                if (this.checked) {
                    appendCategory(id, name);
                } else {
                    $(`#selectedCategory_${id}`).remove();
                }
            });

            // Remove category from selected categories list when the remove button is clicked
            $('#selectedCategories').on('click', '.remove-category', function() {
                const id = $(this).data('id');
                removeCategory(id);
            });


            // Show Brand from Category List
            $(document).on('click', '.showCategory', function() {
                const categoryId = $(this).data('id');
                $('#brandModal').removeClass('hidden').addClass('flex');
                $('#saveModal').addClass('hidden');
                $.ajax({
                    url: `/brands/${categoryId}/categories`,
                    method: 'GET',
                    success: function(brands) {
                        $('#brandId').val(brands.id);
                        $('#brandName').val(brands.name).prop('disabled', true);
                        $('#categorySearch').prop('disabled', true)
                        $('#brandDescription').val(brands.description).prop('disabled', true);
                        loadCategories(); // Load categories
                        $('#brandModal').removeClass('hidden').addClass('flex');
                        $('#brandCategoriesContainer').addClass('hidden');
                        $('#brandCategoriesContainer input').prop('disabled', true);

                        let brandList = '';
                        [...brands.categories].forEach(brand => {
                            brandList += `<li class="list-decimal">${brand.name}</li>`;
                        });
                        $('#selectedCategories').html(brandList);
                        $('#parentCategorySearch').addClass('hidden');
                        $('#parentBrandName').addClass('hidden');
                        $('#parentBrandDescription').addClass('hidden');
                        $('#judulModal').html('Brands in this Category');
                    },
                    error: function(response) {
                        console.log('Error:', response);
                    }
                });
            });

            // Handle sorting
            $(document).on('click', '.sort', function() {
                const sortBy = $(this).data('sort-by');
                let sortDirection = 'asc';

                if ($(this).hasClass('sorted-asc')) {
                    sortDirection = 'desc';
                }

                $('.sort').removeClass('sorted-asc').removeClass('sorted-desc');

                if (sortDirection === 'asc') {
                    $(this).addClass('sorted-asc');
                } else {
                    $(this).addClass('sorted-desc');
                }

                const search = $('#search').val();
                fetchBrands(1, search, sortBy, sortDirection);
            });

            // Handle pagination link click
            $(document).on('click', '.pagination-link', function() {
                const page = $(this).data('page');
                const search = $('#search').val();
                const sortBy = $('.sort.sorted-asc, .sort.sorted-desc').data('sort-by');
                const sortDirection = $('.sort.sorted-asc').length ? 'asc' : 'desc';
                fetchBrands(page, search, sortBy, sortDirection);
            });

            // Handle search input
            $('#search').on('input', function() {
                const search = $(this).val();
                const sortBy = $('.sort.sorted-asc, .sort.sorted-desc').data('sort-by');
                const sortDirection = $('.sort.sorted-asc').length ? 'asc' : 'desc';
                fetchBrands(1, search, sortBy, sortDirection);
            });

            // Add brand
            $('#addBrand').on('click', function() {
                $('#brandForm')[0].reset();
                $('#brandId').val('');
                $('#selectedCategories').empty();
                loadCategories();
                $('#brandModal').removeClass('hidden').addClass('flex');
                $('#saveModal').removeClass('hidden');
                $('#brandName').removeAttr('disabled');
                $('#brandDescription').removeAttr('disabled');
                $('#judulModal').html('Add Brand');
                $('#brandCategories').removeClass('hidden');
                $('#parentCategorySearch').removeClass('hidden');
                $('#parentBrandName').removeClass('hidden');
                $('#parentBrandDescription').removeClass('hidden');
            });

            // Edit brand
            $(document).on('click', '.editBrand', function() {
                $('#saveModal').removeClass('hidden');
                $('#judulModal').html('Edit Brand');
                $('#parentCategorySearch').removeClass('hidden');
                $('#parentBrandName').removeClass('hidden');
                $('#parentBrandDescription').removeClass('hidden');
                $('#categorySearch').val('');
                const id = $(this).closest('tr').data('id');
                $.ajax({
                    url: '/brand/' + id,
                    method: 'GET',
                    success: function(brand) {
                        $('#brandId').val(brand.id);
                        $('#brandName').val(brand.name).removeAttr('disabled');
                        $('#categorySearch').removeAttr('disabled');
                        $('#brandDescription').val(brand.description).removeAttr(
                            'disabled');
                        const selectedCategories = brand.categories.map(cat => cat.id);
                        loadCategories(selectedCategories);
                        $('#selectedCategories').empty();
                        brand.categories.forEach(category => {
                            appendCategory(category.id, category.name);
                        });
                        $('#brandModal').removeClass('hidden').addClass('flex');
                    }
                });
            });

            // Show brand
            $(document).on('click', '.showBrand', function() {
                const id = $(this).closest('tr').data('id');
                $('#parentCategorySearch').addClass('hidden');
                $('#parentBrandName').removeClass('hidden');
                $('#parentBrandDescription').removeClass('hidden');
                $.ajax({
                    url: '/brand/' + id,
                    method: 'GET',
                    success: function(brand) {
                        $('#brandId').val(brand.id);
                        $('#brandName').val(brand.name).prop('disabled', true);
                        $('#categorySearch').attr('disabled',
                            'disabled');
                        $('#brandDescription').val(brand.description).prop('disabled', true);
                        loadCategories(); // Load categories
                        $('#selectedCategories').empty();
                        brand.categories.forEach(category => {
                            appendCategory(category.id, category.name);
                        });
                        $('#selectedCategories .removeCategory')
                            .remove(); // Remove remove buttons
                        $('#brandModal').removeClass('hidden').addClass('flex');
                        $('#brandCategoriesContainer').addClass('hidden');
                        $('#brandCategoriesContainer input').prop('disabled', true);

                        $('#saveModal').addClass('hidden');
                        $('#judulModal').html('Detail Brand');
                    }
                });
            });

            // Save brand (create or update)
            $('#brandForm').on('submit', function(event) {
                event.preventDefault();
                const id = $('#brandId').val();
                const url = id ? '/brand/' + id : '/brand';
                const method = id ? 'PUT' : 'POST';
                const data = {
                    name: $('#brandName').val(),
                    description: $('#brandDescription').val(),
                    categories: $('#brandCategoriesContainer input:checked').map(function() {
                        return $(this).val();
                    }).get() // Get selected categories
                };
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        $('#brandModal').addClass('hidden').removeClass('flex');
                        fetchBrands();
                        let isi = '';
                        isi += `
                            <div id="response" class="relative bg-green-100 border border-green-400 rounded p-6 flex flex-row justify-between items-center w-full h-full text-green-700 animate-slide-right">
                                <p class="text-base md:text-lg">${response.success}</p>
                                <button type="button" id="btnSuccess" class="btnSuccess absolute top-2 right-2 font-semibold py-1 px-2 rounded text-gray-500 hover:text-black hover:transition-all hover:-translate-y-0.5 duration-300 text-lg">X</button>
                            </div>
                        `;
                        $('#divSuccess').html(isi).fadeIn(500).delay(5000).fadeOut(
                            500);
                    },
                    error: function(response) {
                        console.log('Error:', response);
                    }
                });
            });

            $('#divSuccess').delay(2000).hide(300);


            // Delete brand
            $(document).on('click', '.deleteBrand', function() {
                if (confirm('Apakah yakin akan menghapus brand ini secara permanen?') ==
                    true) {
                    const id = $(this).closest('tr').data('id');
                    $.ajax({
                        url: '/brand/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            const search = $('#search').val();
                            const sortBy = $('.sort.sorted-asc, .sort.sorted-desc')
                                .data(
                                    'sort-by');
                            const sortDirection = $('.sort.sorted-asc').length ?
                                'asc' : 'desc';
                            fetchBrands(1, search, sortBy, sortDirection);
                            $('#response').toggleClass('hidden');
                            let isi = '';
                            isi += `
                                <div id="response" class="relative bg-orange-100 border border-orange-400 rounded p-6 flex flex-row justify-between items-center w-full h-full text-orange-700 animate-slide-right">
                                <p class="text-base md:text-lg">${response.success}</p>
                                    <button type="button" id="btnSuccess" class="btnSuccess absolute top-2 right-2 font-semibold py-1 px-2 rounded text-gray-500 hover:text-black hover:transition-all hover:-translate-y-0.5 duration-300 text-lg">X</button>
                                </div>
                            `;
                            $('#divSuccess').html(isi).fadeIn(500).delay(5000)
                                .fadeOut(500);
                        }
                    });
                } else {
                    console.log('Tidak jadi dihapus')
                };
            });

            // Close modal
            $('#closeModal').on('click', function() {
                $('#brandModal').addClass('hidden').removeClass('flex');
            });

            // Close Alert Success
            $(document).on('click', '#btnSuccess', function() {
                $('#response').toggleClass('hidden');
            });

            // Open Modal
            $(document).on('click', '#import', function() {
                $('#brandModalImport').removeClass('hidden').addClass('flex');
                $('#judulModal').html('Import Brand');
            });

            $(document).on('click', '#export', function() {
                $('#brandModalImport').removeClass('hidden').addClass('flex');
                $('#judulModal').html('Export Brand');
            });

            // Close modal
            $('#closeModalImport').on('click', function() {
                $('#brandModalImport').addClass('hidden').removeClass('flex');
            });
        });
    </script>
</x-app-layout>
