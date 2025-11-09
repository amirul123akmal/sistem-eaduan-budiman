@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0]">
    {{-- Hero Section --}}
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
        {{-- Welcome Card --}}
        <div class="w-full max-w-2xl">
            {{-- Main Card --}}
            <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-12 rounded-3xl shadow-2xl border border-[#2F4F2F]/10">

                {{-- Logo Section Inside Card, With Frame --}}
                <div class="flex justify-center mb-8 animate-fade-in">
                    <div class="relative">
                        <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-2xl"></div>
                        <div class="relative flex items-center justify-center rounded-full bg-gradient-to-br from-[#F0F7F0] via-[#CFE0CF] to-[#2F4F2F] p-2 shadow-lg ring-4 ring-[#2F4F2F]/10">
                            <img src="{{ asset('images/logoKgBudiman.png') }}" alt="Logo Kampung Budiman"
                                class="w-44 h-44 sm:w-48 sm:h-48 object-contain rounded-full border-4 border-[#2F4F2F]/30 bg-white shadow-lg" />
                        </div>
                    </div>
                </div>

                {{-- Title Section --}}
                <div class="text-center mb-10">
                    <h1 class="text-4xl sm:text-5xl font-bold mb-4 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Sistem e-Aduan
                    </h1>
                    <h2 class="text-2xl sm:text-3xl font-semibold mb-3 text-[#132A13]">
                        Kampung Budiman
                    </h2>
                    <p class="text-[#2F4F2F]/70 text-base sm:text-lg font-medium max-w-md mx-auto">
                        Platform digital untuk membuat aduan dan menyemak status aduan anda dengan mudah
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-8">
                    {{-- Tambah Aduan Button --}}
                    <a href="{{ route('public.complaint.create') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] p-6 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex flex-col items-center gap-3">
                            <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fa fa-pencil-alt text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="text-center">
                                <h3 class="text-lg font-bold mb-1">Tambah Aduan</h3>
                                <p class="text-sm text-white/90">Buat aduan baharu</p>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>

                    {{-- Semak Status Button --}}
                    <a href="{{ route('public.status.check') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#2F4F2F] to-[#132A13] p-6 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex flex-col items-center gap-3">
                            <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fa fa-search text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="text-center">
                                <h3 class="text-lg font-bold mb-1">Semak Status</h3>
                                <p class="text-sm text-white/90">Lihat status aduan</p>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                </div>

                {{-- Quick Info Section --}}
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-[#2F4F2F]/10">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-[#132A13] mb-1">24/7</div>
                        <div class="text-xs text-[#2F4F2F]/70">Akses Sepanjang Masa</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-[#132A13] mb-1">Pantas</div>
                        <div class="text-xs text-[#2F4F2F]/70">Proses Cepat</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-[#132A13] mb-1">Mudah</div>
                        <div class="text-xs text-[#2F4F2F]/70">Senang Digunakan</div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-8 text-center">
                <p class="text-sm text-[#2F4F2F]/60 font-medium">
                    © {{ date('Y') }} Kampung Budiman. Semua Hak Cipta Terpelihara.
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 0.6s ease-out;
    }
</style>
@endpush
@endsection
