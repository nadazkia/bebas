<x-app-layout>
    <x-slot name="header" class="relative">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
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
                                <h1 class="font-bold text-3xl">Categories</h1>
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
                                    Add Category
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
                            <tbody id="categoriesTableBody">
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
    <div id="categoryModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center font-sans text-gray-900 antialiased animate-fade-in">
        <div
            class="bg-white p-6 rounded-lg flex flex-col sm:justify-center items-center w-full max-w-72 animate-slide-up">
            {{-- <div class="w-full sm:max-w-md my-6 px-10 pt-14 pb-6 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
            <h2 id="judulModal" class="text-xl font-bold text-center mb-3">Modal Title</h2>
            <form id="categoryForm" class="w-full">
                @csrf
                @method('PUT')
                <input type="hidden" id="categoryId">
                <div id="parentCategoryName" class="relative w-full min-w-[200px] h-10 mb-5">
                    <x-admin.input id="categoryName" name="name" />
                    <x-admin.label for="categoryName">Category Name</x-admin.label>
                </div>

                <div id="parentCategoryDescription" class="relative w-full min-w-[200px] h-10 mb-5">
                    <x-admin.input name="description" id="categoryDescription" />
                    <x-admin.label for="categoryDescription">Description</x-admin.label>
                </div>

                <div class="relative w-full min-w-[200px] mb-5">
                    <div class="flex flex-col rounded">
                        <div id="parentBrandSearch" class="relative w-full min-w-[200px] h-10 mb-2">
                            <x-admin.input type="search" id="brandSearch" class="border-b-0" />
                            <x-admin.label for="brandSearch">Search to Add Brand</x-admin.label>
                        </div>
                        <div id="selectedBrands" class="flex flex-wrap gap-1 max-h-24 overflow-y-auto">
                            <!--  Append Category in Category Modal -->
                        </div>
                        <div id="categoryBrandsContainer"
                            class="hidden absolute shadow-xl top-11 bg-white z-40 w-full left-0 rounded max-h-[300px] overflow-y-auto">
                            <div id="categoryBrands"
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

    <!-- List Brands if Number Brand Count is Click-->
    {{-- <div id="modalList"
        class="flex fixed inset-0 bg-black bg-opacity-50 items-center justify-center font-sans text-gray-900 antialiased animate-fade-in">
        <div
            class="bg-white p-6 rounded-lg flex flex-col sm:justify-center items-center w-full max-w-72 animate-slide-up">
            <h2 id="judulModalList" class="text-xl font-bold text-center mb-3">List Brands</h2>
            <main id="modalListMain" class="w-full">
                <ul id="listModalBrands" class="list-decimal mx-3 mb-5">
                    <!-- List Brands -->
                </ul>
            </main>
            <div class="flex justify-end gap-2">
                <button type="button" id="closeModalList"
                    class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md text-white hover:bg-red-600 focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
            </div>
        </div>
    </div> --}}




    <script>
        $(document).ready(function() {
            // Fetch Setup for All AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Fetch categories with pagination, search, and sort

            function fetchCategories(page = 1, search = '', sortBy = 'id', sortDirection = 'desc') {
                $.ajax({
                    method: 'GET',
                    url: "/category?page=" + page + '&search=' + search + '&sortBy=' + sortBy +
                        '&sortDirection=' + sortDirection,
                    success: function(categories) {
                        let rows = '';
                        [...categories.data].forEach(category => {
                            const description = category.description != null ?
                                category.description : '';
                            let xcategory = [...category.brands];
                            rows +=
                                `
                                    <tr class="border-b last:border-b-0 border-slate-300 table-row" data-id="${category.id}">
                                    <td class="my-2 w-14 text-center table-cell">${category.id}</td>
                                    <td class="py-2 table-cell whitespace-nowrap truncate">${category.name}</td>
                                    <td class="py-2 table-cell whitespace-nowrap truncate text-left">
                                    <button data-id=${category.id} class="showBrand text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-700 hover:text-white duration-300 transition ease-in-out truncate">${xcategory.length}</button>
                                </td>
                                <td class="px-4 py-2 text-left hidden md:table-cell truncate"> ${description} </td>
                                <td class="py-2 flex flex-wrap justify-end text-right h-full gap-2 md:gap-2">
                                <button class="showCategory text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-700 hover:text-white duration-300 transition ease-in-out">Show</button>

                                <button class="editCategory text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-orange-700 bg-orange-100 rounded-lg hover:bg-orange-700 hover:text-white duration-300 transition ease-in-out">Edit</button>

                                <button class="deleteCategory text-center align-baseline inline-flex px-3 py-2 md:px-4 md:py-2 items-center font-semibold text-sm md:text-base leading-none text-red-700 bg-red-100 rounded-lg hover:bg-red-700 hover:text-white duration-300 transition ease-in-out">Delete</button>
                            </td>
                                </tr>`;
                        });

                        $('#categoriesTableBody').html(rows);

                        // Render pagination links
                        let pagination = '';
                        if (categories.prev_page_url) {
                            pagination += `
                                <button class="pagination-link px-2 py-1 hover:bg-teal-700 shadow-md hover:border-teal-700 hover:text-white duration-300 rounded-full bg-slate-200" data-page="${categories.current_page - 1}">
                                        <svg class="h-5 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"/>
                                    </svg>    
                                </button>
                            `;
                        };
                        for (let i = 1; i <= categories.last_page; i++) {
                            pagination += `
                                <button class="pagination-link px-3 py-1 hover:bg-teal-700 shadow-md hover:border-teal-700 hover:text-white duration-300 rounded-full 
                                ${i === categories.current_page ? 'bg-teal-700 text-white' : 'bg-slate-200'}" data-page="${i}">${i}</button>
                            `;
                        };
                        if (categories.next_page_url) {
                            pagination += `
                                <button class="pagination-link px-2 py-1 hover:bg-teal-700 shadow-md hover:border-teal-700 hover:text-white duration-300 rounded-full bg-slate-200" data-page="${categories.current_page + 1}">
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


            function loadCategories(selectedBrands = []) {
                $.ajax({
                    url: '/tag-brand',
                    method: 'GET',
                    success: function(brands) {
                        let checkboxes = '';
                        brands.forEach(brand => {
                            const checked = selectedBrands.includes(brand.id) ?
                                'checked ' : '';
                            checkboxes +=
                                `<label for='${brand.name}' 
                                    class="brand-label flex flex-row text-sm cursor-pointer has-[:checked]:border-emerald-700 rounded w-full px-2 py-1 duration-300 ease-in-out has-[:checked]:text-emerald-800 hover:bg-teal-100 border-l border-transparent">
                                    <input data-brand-id='${brand.id}' type="checkbox" ${checked} name="brand" id='${brand.name}' value='${brand.id}'
                                        class="dropdownOption checked:accent-teal-700 cursor-pointer">
                                    <span class="px-2">${brand.name}</span>
                                </label>`
                        });
                        $('#categoryBrands').html(checkboxes);
                        // Append selected brands to the selected brands list
                        selectedBrands.forEach(id => {
                            const brand = brands.find(bran => bran.id === id);
                            appendBrand(brand.id, brand.name);
                        });
                    }
                })
            }

            // Filter categories in dropdown based on search input
            $('#brandSearch').on('input', function() {
                const search = $(this).val().toLowerCase();
                console.log(search);
                $('#categoryBrandsContainer').removeClass('hidden');
                $('#categoryBrands label').each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(search) !== -1);
                });
            });

            $('#brandSearch').on('focus', function() {
                $('#categoryBrandsContainer').removeClass('hidden');
            });


            // Initial fetch without sort
            fetchCategories();

            // Hide categoryBrandsContainer when clicking outside of it and the search input
            $(document).on('click', function(event) {
                const $target = $(event.target);
                if (!$target.closest('#categoryBrandsContainer').length && !$target.closest(
                        '#brandSearch').length) {
                    $('#categoryBrandsContainer').addClass('hidden');
                }
            });


            // Append category to selected categories list
            function appendBrand(id, name, removable = true) {
                if ($(`#selectedBrand_${id}`).length === 0) {
                    const removeButton = removable ? `<button type="button" data-id="${id}" class="removeBrand flex flex-auto flex-row-reverse">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-x cursor-pointer hover:text-teal-400 rounded-full w-4 h-4 ml-2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>` :
                        '';
                    const brandHtml = `
                            <div id="selectedBrand_${id}"
                                class="flex justify-center items-center font-medium py-1 px-2 rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                                <p class="text-xs font-normal leading-none max-w-full flex-initial">${name}</p>
                                ${removeButton}
                            </div>
            `;
                    $('#selectedBrands').append(brandHtml);
                }
            }

            // Remove category from selected categories list
            $(document).on('click', '.removeBrand', function() {
                const id = $(this).data('id');
                $(`#selectedBrand_${id}`).remove();
                $(`#categoryBrandsContainer input[value="${id}"]`).prop('checked', false);
            });

            // Handle checkbox changes
            $('#categoryBrandsContainer').on('change', 'input[type="checkbox"]', function() {
                const id = $(this).val();
                const name = $(this).closest('label').text().trim();
                if (this.checked) {
                    appendBrand(id, name);
                } else {
                    $(`#selectedBrand_${id}`).remove();
                }
            });

            // Remove category from selected categories list when the remove button is clicked
            $('#selectedBrands').on('click', '.remove-brand', function() {
                const id = $(this).data('id');
                removeBrand(id);
            });


            // Show Category from Brand List
            $(document).on('click', '.showBrand', function() {
                const brandId = $(this).data('id');
                $('#categoryModal').removeClass('hidden').addClass('flex');
                $('#saveModal').addClass('hidden');
                $.ajax({
                    url: `/categories/${brandId}/brands`,
                    method: 'GET',
                    success: function(categories) {
                        $('#categoryId').val(categories.id);
                        $('#categoryName').val(categories.name).prop('disabled', true);
                        $('#brandSearch').prop('disabled', true)
                        $('#categoryDescription').val(categories.description).prop('disabled',
                            true);
                        loadCategories(); // Load categories
                        $('#categoryModal').removeClass('hidden').addClass('flex');
                        $('#categoryBrandsContainer').addClass('hidden');
                        $('#categoryBrandsContainer input').prop('disabled', true);

                        let categoryList = '';
                        [...categories.brands].forEach(category => {
                            categoryList +=
                                `<li class="list-decimal">${category.name}</li>`;
                        });
                        $('#selectedBrands').html(categoryList);
                        $('#parentBrandSearch').addClass('hidden');
                        $('#parentCategoryName').addClass('hidden');
                        $('#parentCategoryDescription').addClass('hidden');
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
                fetchCategories(1, search, sortBy, sortDirection);
            });

            // Handle pagination link click
            $(document).on('click', '.pagination-link', function() {
                const page = $(this).data('page');
                const search = $('#search').val();
                const sortBy = $('.sort.sorted-asc, .sort.sorted-desc').data('sort-by');
                const sortDirection = $('.sort.sorted-asc').length ? 'asc' : 'desc';
                fetchCategories(page, search, sortBy, sortDirection);
            });

            // Handle search input
            $('#search').on('input', function() {
                const search = $(this).val();
                const sortBy = $('.sort.sorted-asc, .sort.sorted-desc').data('sort-by');
                const sortDirection = $('.sort.sorted-asc').length ? 'asc' : 'desc';
                fetchCategories(1, search, sortBy, sortDirection);
            });

            // Add category
            $('#addBrand').on('click', function() {
                $('#categoryForm')[0].reset();
                $('#categoryId').val('');
                $('#selectedBrands').empty();
                loadCategories();
                $('#categoryModal').removeClass('hidden').addClass('flex');
                $('#saveModal').removeClass('hidden');
                $('#categoryName').removeAttr('disabled');
                $('#categoryDescription').removeAttr('disabled');
                $('#judulModal').html('Add Category');
                $('#categoryBrands').removeClass('hidden');
                $('#parentBrandSearch').removeClass('hidden');
                $('#parentCategoryName').removeClass('hidden');
                $('#parentCategoryDescription').removeClass('hidden');
            });

            // Edit category
            $(document).on('click', '.editCategory', function() {
                $('#saveModal').removeClass('hidden');
                $('#judulModal').html('Edit Category');
                $('#parentBrandSearch').removeClass('hidden');
                $('#parentCategoryName').removeClass('hidden');
                $('#parentCategoryDescription').removeClass('hidden');
                $('#brandSearch').val('');

                const id = $(this).closest('tr').data('id');
                $.ajax({
                    url: '/category/' + id,
                    method: 'GET',
                    success: function(category) {
                        $('#categoryId').val(category.id);
                        $('#categoryName').val(category.name).removeAttr('disabled');
                        $('#brandSearch').removeAttr('disabled');
                        $('#categoryDescription').val(category.description).removeAttr(
                            'disabled');
                        const selectedBrands = category.brands.map(cat => cat.id);
                        loadCategories(selectedBrands);
                        $('#selectedBrands').empty();
                        category.brands.forEach(brand => {
                            appendBrand(brand.id, brand.name);
                        });
                        $('#categoryModal').removeClass('hidden').addClass('flex');
                    }
                });
            });

            // Show category
            $(document).on('click', '.showCategory', function() {
                const id = $(this).closest('tr').data('id');
                $('#parentBrandSearch').addClass('hidden');
                $('#parentCategoryName').removeClass('hidden');
                $('#parentCategoryDescription').removeClass('hidden');
                $.ajax({
                    url: '/category/' + id,
                    method: 'GET',
                    success: function(category) {
                        $('#categoryId').val(category.id);
                        $('#categoryName').val(category.name).prop('disabled', true);
                        $('#brandSearch').attr('disabled',
                            'disabled');
                        $('#categoryDescription').val(category.description).prop('disabled',
                            true);
                        loadCategories(); // Load categories
                        $('#selectedBrands').empty();
                        category.brands.forEach(brand => {
                            appendBrand(brand.id, brand.name);
                        });
                        $('#selectedBrands .removeBrand')
                            .remove(); // Remove remove buttons
                        $('#categoryModal').removeClass('hidden').addClass('flex');
                        $('#categoryBrandsContainer').addClass('hidden');
                        $('#categoryBrandsContainer input').prop('disabled', true);

                        $('#saveModal').addClass('hidden');
                        $('#judulModal').html('Detail Category');
                    }
                });
            });

            // Save category (create or update)
            $('#categoryForm').on('submit', function(event) {
                event.preventDefault();
                const id = $('#categoryId').val();
                const url = id ? '/category/' + id : '/category';
                const method = id ? 'PUT' : 'POST';
                const data = {
                    name: $('#categoryName').val(),
                    description: $('#categoryDescription').val(),
                    brands: $('#categoryBrandsContainer input:checked').map(function() {
                        return $(this).val();
                    }).get() // Get selected brands
                };
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function(response) {
                        $('#categoryModal').addClass('hidden').removeClass('flex');
                        fetchCategories();
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


            // Delete category
            $(document).on('click', '.deleteCategory', function() {
                if (confirm('Apakah yakin akan menghapus brand ini secara permanen?') ==
                    true) {
                    const id = $(this).closest('tr').data('id');
                    $.ajax({
                        url: '/category/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            const search = $('#search').val();
                            const sortBy = $('.sort.sorted-asc, .sort.sorted-desc')
                                .data(
                                    'sort-by');
                            const sortDirection = $('.sort.sorted-asc').length ?
                                'asc' : 'desc';
                            fetchCategories(1, search, sortBy, sortDirection);
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
                $('#categoryModal').addClass('hidden').removeClass('flex');
            });

            // Close Alert Success
            $(document).on('click', '#btnSuccess', function() {
                $('#response').toggleClass('hidden');
            });


        });
    </script>

</x-app-layout>
