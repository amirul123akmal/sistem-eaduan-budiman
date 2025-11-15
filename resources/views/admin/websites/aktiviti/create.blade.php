@extends('layouts.admin')

@section('content')
    @php
        $user = auth()->user();
        $isSuperAdmin = $user && method_exists($user, 'hasRole') && $user->hasRole('Super Admin');
        $indexRoute = $isSuperAdmin ? 'admin.websites.aktiviti.index' : 'admin.panel.websites.aktiviti.index';
        $storeRoute = $isSuperAdmin ? 'admin.websites.aktiviti.store' : 'admin.panel.websites.aktiviti.store';
    @endphp

    {{-- Header with Back Button --}}
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route($indexRoute) }}"
                class="group flex items-center gap-2 px-4 py-2 rounded-xl bg-white border-2 border-[#F0F7F0] text-[#132A13] shadow-sm transition-all duration-300 hover:bg-[#F0F7F0] hover:border-[#132A13] hover:shadow-md active:scale-95 touch-manipulation">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
        <div>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                Tambah Aktiviti Baharu
            </h1>
            <p class="text-sm sm:text-base text-gray-600">Isi maklumat aktiviti untuk ditambah ke dalam sistem</p>
        </div>
    </div>

    {{-- Form Panel --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-[#132A13] flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Daftar Aktiviti
            </h2>
        </div>
        <div class="p-6 sm:p-8">
            <form action="{{ route($storeRoute) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('POST')

                <!-- Nama Aktiviti -->
                <div>
                    <label for="nama_aktiviti" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Aktiviti <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_aktiviti" id="nama_aktiviti" placeholder="Masukkan nama aktiviti"
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 bg-white text-gray-900 placeholder-gray-400 focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 focus:outline-none transition-all"
                        required value="{{ old('nama_aktiviti') }}">
                    @error('nama_aktiviti')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Keterangan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="4" placeholder="Masukkan keterangan aktiviti"
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 bg-white text-gray-900 placeholder-gray-400 focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 focus:outline-none transition-all resize-none"
                        required>{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tarikh -->
                <div>
                    <label for="tarikh" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tarikh <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tarikh" id="tarikh"
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 bg-white text-gray-900 focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 focus:outline-none transition-all"
                        required value="{{ old('tarikh') }}">
                    @error('tarikh')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar Aktiviti <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="file" name="gambar[]" id="gambar" accept="image/*" multiple required
                            class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 bg-gray-50 text-gray-900 text-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 focus:outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#F0F7F0] file:text-[#132A13] hover:file:bg-[#132A13] hover:file:text-white cursor-pointer">
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Format yang disokong: JPG, JPEG, PNG. Saiz maksimum: 2MB setiap imej. Anda boleh memilih lebih daripada satu imej.</p>
                    @error('gambar.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Form Actions --}}
                <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route($indexRoute) }}"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl border-2 border-gray-300 bg-white text-gray-700 font-semibold text-sm shadow-sm hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 active:scale-95 touch-manipulation text-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="group relative w-full sm:w-auto overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-8 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] active:scale-95 transform touch-manipulation">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-center gap-2">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Simpan Aktiviti</span>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#132A13',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Ralat!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc2626'
                });
            @endif
        </script>
    @endpush
@endsection
