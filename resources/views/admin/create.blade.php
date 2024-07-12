<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="font-sans text-gray-900 antialiased">
        <div class="flex flex-col sm:justify-center items-center py-6 sm:p-0 bg-slate-100 w-full">
            <div class="w-full sm:max-w-md my-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('admin.store') }}" class="px-4">
                    @csrf
                    <div>
                        <h1 class="font-bold text-lg text-center mb-7 mt-3">TAMBAH BRAND</h1>
                    </div>
                    <!-- Name Brand -->
                    <div class="relative w-full min-w-[200px] h-10 mb-5">
                        <x-admin.input name="name" />
                        <x-admin.label for="name">Nama Brand/Perusahaan</x-admin.label>
                    </div>

                    <!-- Name Brand -->
                    <div class="relative w-full min-w-[200px] h-10 mb-5">
                        <x-admin.input name="category" />
                        <x-admin.label for="category">Category</x-admin.label>
                    </div>

                    <div class="relative w-full min-w-[200px] h-10 mb-5">
                        <x-admin.input name="note" />
                        <x-admin.label for="note">Note</x-admin.label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
