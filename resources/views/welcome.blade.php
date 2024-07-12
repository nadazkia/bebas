<x-guest-layout>

    <body onload="loader()"
        class="font-sans antialiased max-h-screen h-screen flex flex-col justify-center items-center w-full max-w-7xl mx-auto overflow-hidden bg-gradient-to-br from-slate-900 via-red-900 to-emerald-900">

        <div id="loader" class="flex gap-4 items-center">
            <span class="relative flex h-7 w-7">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-7 w-7 bg-white"></span>
            </span>
            <p class="text-white text-xl animate-pulse">Loading...</p>

        </div>

        @if (Route::has('login'))
            @auth
                <header class="absolute top-0 w-full bg-white text-black z-10">
                    <nav class="px-3 h-10 md:h-16 flex space-x-3 justify-end items-center">
                        <x-nav-link :href="route('dashboard')" class="md:text-2xl">
                            {{ __('Brands') }}
                        </x-nav-link>
                        <x-nav-link :href="route('category')" class="md:text-2xl">
                            {{ __('Categories') }}
                        </x-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link :href="route('logout')" class="md:text-2xl"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-nav-link>
                        </form>
                    </nav>
                </header>
            @endauth
        @endif


        <div id="container" class="hidden relative">
            <div class="relative m-4 md:mx-5">
                <div
                    class="relative bg-black/70 backdrop-blur-xl rounded-xl pt-10 px-6 pb-2 md:pt-24 md:pb-8  text-white shadow-xl h-[40rem] md:h-[50rem] lg:h-[60rem]">

                    <div class="flex flex-col items-center w-full">
                        <h1 class="text-5xl md:text-7xl font-bold text-center mb-8 animate-slide-down delay-1">Bersama
                            Bebaskan
                        </h1>
                        <p class="text-center mb-8 lg:text-3xl animate-slide-right delay-2">Sebuah platform
                            untuk
                            memfasilitasi
                            konsumen dalam
                            mencari
                            informasi mengenai produk
                            mana yang berafiliasi dalam penghancuran kemanusiaan di Palestina </p>
                    </div>

                    <main class="relative grid grid-col-1 mx-auto w-full lg:w-4/5 mt-6 md:mt-12">
                        <div
                            class="flex flex-row items-center justify-center w-full rounded-full border border-slate-600/60 bg-white animate-slide-left delay-3 mb-1">
                            <article class="w-full m-0 pl-4 py-0 text-black">
                                <div class="pl-2 my-3 md:text-3xl">
                                    <input id="keyword" type="search" name="keyword" autofocus
                                        class="focus:outline-none w-full placeholder:text-sm placeholder:italic md:placeholder:text-2xl"
                                        placeholder="Cari disini........">
                                </div>
                                {{-- <button type="submit" id="button-search"></button> --}}
                            </article>

                            <button id="openScanner" type="button" class="flex-end font-bold pr-4 md:pr-6 text-black">
                                <img src={{ asset('assets/scan.svg') }} alt="scan" class="w-7 md:w-10">
                            </button>
                        </div>

                        <div class="relative w-full animate-slide-left delay-3 mb-5 md:mb-10 text-slate-700 max-h-48">
                            <div id="search_list" class="absolute w-full bg-white z-50 overflow-y-scroll max-h-48">
                            </div>
                        </div>

                        <div class="text-center w-full md:mt-8 animate-slide-up delay-4 -z-50">
                            <h5 class="text-sm md:text-2xl">Jumlah Pencarian:</h5>
                            <h2 id="totalClicked"class="font-bold text-lg md:text-3xl">123.000.000</h2>
                        </div>
                    </main>

                    <footer class="absolute inset-x-0 bottom-6 md:bottom-10 animate-fade-in delay-4">
                        <p class="text-center text-xs md:text-2xl">nads.dev</p>
                    </footer>
                </div>

                {{-- @include('show') --}}
                <div id="kotak_modal"
                    class="hidden absolute top-0 bg-black/80 w-full h-full rounded-xl animate-fade-in">
                    <div class="flex justify-center items-center h-full">
                        <div id="modal"
                            class="relative text-right w-96 bg-white rounded-lg text-slate-800 p-4 mx-5  animate-slide-right">
                            <button id="close"
                                class="absolute top-2 right-2 px-1 rounded-lg bg-slate-100 hover:text-black font-bold">X</button>
                            <div id="isiModal" class="py-5 md:pb-7">
                                <h3 id="brandName"
                                    class="text-center text-lg font-bold lg:text-2xl mb-2 animate-slide-down ">
                                    $brand->name
                                </h3>
                                <p id="description" class="text-center lg:text-xl animate-slide-up"> $brand->description
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal untuk menampilkan pemindaian kamera -->
                <div id="barcodeScannerModal"
                    class="hidden absolute top-0 bg-black/80 w-full h-full rounded-xl animate-fade-in">
                    <div class="flex justify-center items-center h-full">
                        <div id="modal-content"
                            class="relative text-right w-96 bg-white rounded-lg text-slate-800 p-4 mx-5  animate-slide-right">
                            <div id="reader" class=" w-full h-full mb-5"></div>
                            <button type="button" id="closeScanner"
                                class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md text-white hover:bg-red-600 focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <script src="https://unpkg.com/html5-qrcode" type="text/javascript""></script>

        <script type="text/javascript">
            // window.setTimeout(function () {
            //     window.location.reload();
            // }, 4000);

            var myVar;

            function loader() {
                myVar = setTimeout(showPage, 1500);
            };

            function showPage() {
                document.getElementById("loader").classList = "hidden";
                document.getElementById("container").classList =
                    "block opacity-100 animate-entrance";
            };


            // Event ketika keyword di ketik
            $("#keyword").keyup(function() {
                var keyword = $(this).val();
                if (keyword != '') {
                    $('#search_list').removeClass('hidden');
                    search(keyword);
                } else {
                    $('#search_list').addClass('hidden');
                }
            });

            function search(keyword = '') {
                $.ajax({
                    url: "/search?keyword=" + keyword,
                    type: "GET",
                    data: {
                        'keyword': keyword
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#search_list').html(data);
                    },
                    error: function() {
                        console.log("Error saat mencari hasil pencarian");
                    }
                });
            }


            $("#close").on("click", function() {
                $('#kotak_modal').addClass('hidden');
            });


            $(document).on('click', '#search_list a', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: id,
                    type: "GET",
                    success: function(data) {
                        console.log(data);
                        $('#brandName').html(data.name);
                        $('#description').html(data.description);
                        $('#kotak_modal').removeClass('hidden');
                        $('#kotak_modal').removeClass('hidden');
                        $('#keyword').removeClass('text-gray-400');
                        $('#search_list').addClass('hidden');
                        count++;
                        // $('#totalClicked').html(count);
                    },
                    error: function() {
                        console.log("Error saat ingin melihat");
                    }
                })
            })

            $(document).on('mouseenter', '#search_list a', function() {
                let name = $(this).data('name');
                // $('#keyword').val(name);
                // $('#keyword').addClass('text-gray-400');
            })

            const html5QrCode = new Html5Qrcode("reader");

            $('#openScanner').on('click', function() {
                $('#barcodeScannerModal').removeClass('hidden');
                startScanner();
            });

            $('#closeScanner').on('click', function() {
                html5QrCode.stop().then((ignore) => {
                    $('#barcodeScannerModal').addClass('hidden');
                }).catch((err) => {
                    console.log(err);
                });
            });

            function startScanner() {
                html5QrCode.start({
                        facingMode: "environment"
                    }, // Try to use the rear camera
                    {
                        fps: 10, // Sets the framerate to 10 frames per second
                        qrbox: 250 // Sets the box size to 250px
                    },
                    (decodedText, decodedResult) => {
                        // Handle the scanned code here
                        console.log(`Code scanned = ${decodedText}`, decodedResult);
                        html5QrCode.stop().then((ignore) => {
                            $('#barcodeScannerModal').addClass('hidden');
                            var keyword = $('#keyword').val(decodedText);
                            search(keyword);
                            // Perform search or add the brand
                            performSearchOrAddBrand(decodedText);
                        }).catch((err) => {
                            console.log(err);
                        });
                    },
                    (errorMessage) => {
                        // Handle scanning errors or non-readable codes
                        console.log(`Error scanning: ${errorMessage}`);
                    }
                ).catch((err) => {
                    // Start failed, handle it.
                    console.log(`Unable to start scanning: ${err}`);
                });
            }

            function performSearchOrAddBrand(barcode) {
                // Use AJAX to search for the brand or open add brand modal
                $.ajax({
                    url: '/searchByScan', // Endpoint untuk melakukan pencarian brand berdasarkan UPC
                    method: 'GET',
                    data: {
                        barcode: barcode
                    },
                    success: function(brand) {
                        if (brand) {
                            // Show the brand details or open edit modal
                            console.log(`Brand found: ${brand.name}`);
                            // Fill the form fields with the brand data and show the modal

                            $('#brandName').val(brand.name);
                            $('#brandDescription').val(brand.description);
                            $('#kotak_modal').removeClass('hidden');
                            $('#saveBrand').show();


                        } else {
                            // If no brand found, open add brand modal with the UPC filled in
                            console.log(`No brand found with Barcode: ${barcode}`);
                            $('#brandForm')[0].reset();
                            $('#brandId').val('');
                            $('#brandBarcode').val(barcode); // Assuming you have an input field for UPC
                            $('#kotak_modal').removeClass('hidden');
                            $('#saveBrand').show();
                        }
                    },
                    error: function(response) {
                        console.log('Error:', response);
                    }
                });
            }
        </script>


    </body>

</x-guest-layout>
