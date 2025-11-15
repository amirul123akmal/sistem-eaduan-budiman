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
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tambah Ahli Jawatan Kuasa</h2>

        </div>
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900 dark:border-red-800">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                    </svg>
                    <div>
                        <div class="font-semibold text-sm text-red-700 dark:text-red-200">Sila semak dan betulkan ralat berikut:</div>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700 dark:text-red-200 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-[#F0F7F0] border border-[#F0F7F0] text-[#132A13] dark:bg-gray-800 dark:text-gray-100">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 dark:bg-red-900 dark:text-red-200">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.panel.websites.aktiviti.update', ['aktiviti' => $item->activityID]) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PATCH')
            <div>
                <label for="nama_aktiviti" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Aktiviti</label>
                <input type="text" name="nama_aktiviti" id="nama_aktiviti"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required value="{{ $item->title }}">
            </div>

            <div>
                <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required>{{ $item->description }}</textarea>
            </div>

            <div>
                <label for="tarikh" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tarikh</label>
                <input type="date" name="tarikh" id="tarikh"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required value="{{ $item->activity_date ? \Carbon\Carbon::parse($item->activity_date)->format('Y-m-d') : '' }}">
            </div>

            {{-- <div>
                <label for="penandaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Penandaan</label>
                <select name="penandaan" id="penandaan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark"
                    required>
                    <option value="">Pilih Penandaan</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak_aktif">Tidak Aktif</option>
                </select>
            </div> --}}

            <div>
                <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gambar <span
                        class="text-red-500 text-xs">*Upload any image will override the current image</span></label>
                <input type="file" name="gambar[]" id="gambar" accept="image/*" multiple
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark">
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300">Format yang disokong: JPG, JPEG, PNG. Saiz maksimum: 2MB setiap imej. Anda
                    boleh memilih lebih daripada satu imej.</div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.panel.websites.aktiviti.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Kembali ke
                    Senarai</a>

                <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary-dark transition duration-300 transform hover:scale-[1.02]">Simpan</button>
            </div>

        </form>
    </div>

    </div>
@endsection
