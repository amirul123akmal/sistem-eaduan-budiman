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
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Form Panel (Name, Phone, Service, Image) -->
        <section class="mb-10">
            <div class="bg-white rounded-2xl shadow soft-shadow pb-3">
                <div class="px-6 py-5">
                    <h2 class="text-lg font-semibold text-slate-800 mb-3">Daftar Perkhidmatan </h2>
                    <form class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4" method="POST"
                        action="{{ route('admin.panel.websites.bizhub.update', ['bizhub' => $item->vendorID]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <!-- Name -->
                        <div class="col-span-1">
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                            <input id="name" name="name" type="text" placeholder="Masukkan nama" required
                                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 focus:outline-none"
                                value="{{ $item->name }}" />
                        </div>

                        <!-- Phone -->
                        <div class="col-span-1">
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Nombor Telefon</label>
                            <input id="phone" name="phone" type="tel" inputmode="tel" placeholder="0112345678" required
                                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 focus:outline-none"
                                value="{{ $item->phone_number }}" />
                        </div>

                        <div class="col-span-1">
                            <label for="location" class="block text-sm font-medium text-slate-700 mb-1">Lokasi</label>
                            <input id="location" name="location" type="text" placeholder="Masukkan Lokasi" required
                                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 focus:outline-none"
                                value="{{ $item->location }}" />
                        </div>

                        <!-- Service -->
                        <div class="col-span-1">
                            <label for="service" class="block text-sm font-medium text-slate-700 mb-1">Perkhidmatan</label>
                            <input id="service" name="service" type="text" placeholder="Makanan" required
                                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 focus:outline-none"
                                value="{{ $item->service }}" />
                        </div>

                        <div class="col-span-1">
                            <label for="masa" class="block text-sm font-medium text-slate-700 mb-1">Masa Operasi</label>
                            <input id="masa" name="masa" type="text" placeholder="8:00 AM - 10:00 PM" required
                                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 focus:outline-none"
                                value="{{ $item->operation_time }}" />
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gambar Fasiliti <span
                                    class="text-red-500 text-xs">*Upload any image will override the current image</span></label></label>
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary
                    focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-dark dark:focus:border-primary-dark">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300">Format yang disokong: JPG, JPEG, PNG. Saiz maksimum: 2MB.</div>
                        </div>

                        <button type="submit">Enter</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script>
            // Show success message from login
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
        </script>
    @endpush
@endsection
