@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0]">
    <div class="flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-3xl">
            {{-- Main Card --}}
            <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-12 rounded-3xl shadow-2xl border border-[#2F4F2F]/10">
                {{-- Header Section --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-xl"></div>
                            <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#132A13] to-[#2F4F2F] flex items-center justify-center shadow-lg">
                                <i class="fa fa-pencil-alt text-3xl text-white" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-3 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Borang Tambah Aduan
                    </h1>
                    <p class="text-[#2F4F2F]/70 text-base font-medium">
                        Sila isi maklumat di bawah dengan lengkap dan betul
                    </p>
                </div>

                {{-- Form Section --}}
                <form class="space-y-6" id="complaintForm">

                    {{-- Form Fields Grid --}}
                    <div class="grid sm:grid-cols-2 gap-6">
                        {{-- Nama --}}
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Nama Penuh <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa fa-user text-[#2F4F2F]/50" aria-hidden="true"></i>
                                </div>
                                <input type="text" 
                                       name="nama" 
                                       id="nama"
                                       class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all"
                                       placeholder="Masukkan nama penuh anda"
                                       required>
                            </div>
                        </div>

                        {{-- Telefon --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Nombor Telefon <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa fa-phone text-[#2F4F2F]/50" aria-hidden="true"></i>
                                </div>
                                <input type="tel" 
                                       name="telefon" 
                                       id="telefon"
                                       maxlength="11"
                                       class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all"
                                       placeholder="0123456789"
                                       required>
                            </div>
                            <p class="text-xs text-[#2F4F2F]/60 mt-1">Tanpa tanda sengkang</p>
                        </div>

                        {{-- Emel --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Emel <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa fa-envelope text-[#2F4F2F]/50" aria-hidden="true"></i>
                                </div>
                                <input type="email" 
                                       name="emel" 
                                       id="emel"
                                       class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all"
                                       placeholder="nama@email.com"
                                       required>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Alamat <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-4 pointer-events-none">
                                    <i class="fa fa-map-marker-alt text-[#2F4F2F]/50" aria-hidden="true"></i>
                                </div>
                                <textarea name="alamat" 
                                          id="alamat"
                                          rows="2"
                                          class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all resize-none"
                                          placeholder="Lokasi aduan (contoh: Jalan Kampung Budiman, Taman Desa)"
                                          required></textarea>
                            </div>
                        </div>

                        {{-- Jenis Aduan --}}
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Jenis Aduan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa fa-list text-[#2F4F2F]/50" aria-hidden="true"></i>
                                </div>
                                <select name="kategori" 
                                        id="kategori"
                                        class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all appearance-none cursor-pointer"
                                        required>
                                    <option value="">-- Pilih Jenis Aduan --</option>
                                    <option value="prasarana">Prasarana (Jalan, Longkang, Lampu)</option>
                                    <option value="kebersihan">Kebersihan (Sampah, Perparitan)</option>
                                    <option value="keselamatan">Keselamatan (Jenayah, Pencahayaan)</option>
                                    <option value="lain">Lain-lain</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <i class="fa fa-chevron-down text-[#2F4F2F]/50" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Huraian --}}
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Huraian Aduan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="huraian" 
                                      id="huraian"
                                      rows="5"
                                      class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all resize-none"
                                      placeholder="Terangkan aduan anda dengan terperinci..."
                                      required></textarea>
                            <p class="text-xs text-[#2F4F2F]/60 mt-1">Sila berikan maklumat yang lengkap untuk memudahkan tindakan</p>
                        </div>

                        {{-- Gambar --}}
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                                Muat Naik Gambar <span class="text-gray-500 text-xs font-normal">(Pilihan)</span>
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       name="gambar" 
                                       id="gambar"
                                       accept=".jpg,.jpeg,.png"
                                       class="block w-full text-sm text-gray-700 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#132A13] file:text-white hover:file:bg-[#2F4F2F]">
                            </div>
                            <p class="text-xs text-[#2F4F2F]/60 mt-2 flex items-center gap-1">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Format: JPG, PNG sahaja. Saiz maksimum: 2MB
                            </p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-[#2F4F2F]/10">
                        <a href="{{ route('public.home') }}" 
                           class="inline-flex items-center gap-2 text-sm text-[#2F4F2F]/70 hover:text-[#132A13] font-medium transition-colors">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Kembali ke Laman Utama
                        </a>
                        <button type="button" 
                                onclick="window.location.href='{{ route('public.status.check') }}'"
                                class="w-full sm:w-auto group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-8 py-3.5 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
                            <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-center justify-center gap-2">
                                <i class="fa fa-paper-plane text-lg" aria-hidden="true"></i>
                                <span class="font-bold">Hantar Aduan</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Help Section --}}
            <div class="mt-6 text-center">
                <p class="text-xs text-[#2F4F2F]/50">
                    <i class="fa fa-shield-alt mr-1" aria-hidden="true"></i>
                    Maklumat anda adalah selamat dan dirahsiakan
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Phone number validation - only numbers
    document.getElementById('telefon').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush
@endsection
