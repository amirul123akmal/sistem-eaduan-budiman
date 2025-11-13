@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
                <p class="text-sm text-gray-600">Selamat datang. Anda mempunyai akses untuk mengurus sistem e-Aduan sahaja.
                </p>
            </div>
            <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg bg-[#F0F7F0] border border-[#F0F7F0]">
                <div class="w-2 h-2 rounded-full bg-[#132A13] animate-pulse"></div>
                <span class="text-sm font-medium text-[#132A13]">Sistem Aktif</span>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tambah Fasiliti</h2>

        </div>
        <form action="{{ route('admin.panel.websites.fasiliti.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('POST')
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Fasiliti</label>
                <input type="text" name="nama" id="nama"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required>
            </div>

            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Keterangan</label>
                <input type="text" name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required>
            </div>

            <div>
                <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Link Lokasi</label>
                <input type="text" name="location" id="location"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required>
            </div>

            <div>
                <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gambar Fasiliti</label>
                <input type="file" name="gambar" id="gambar" accept="image/*"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary
                    focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required>
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300">Format yang disokong: JPG, JPEG, PNG. Saiz maksimum: 2MB.</div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.panel.websites.fasiliti.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Kembali ke
                    Senarai</a>

                <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary-dark transition duration-300 transform hover:scale-[1.02]">Simpan
                    Fasiliti</button>
            </div>
        </form>

    </div>

    </div>
@endsection
