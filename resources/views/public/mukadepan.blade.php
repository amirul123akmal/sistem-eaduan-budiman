@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0]">
    {{-- Hero Section --}}
    <div class="flex flex-col items-center justify-center min-h-screen px-3 py-8 sm:px-4 sm:py-12 md:px-6 lg:px-8">
        {{-- Welcome Card --}}
        <div class="w-full max-w-2xl">
            {{-- Main Card --}}
            <div class="relative bg-white/90 backdrop-blur-sm p-6 sm:p-8 md:p-10 lg:p-12 rounded-2xl sm:rounded-3xl shadow-2xl border border-[#2F4F2F]/10">
                {{-- Logo Section Inside Card, With Frame --}}
                <div class="flex justify-center mb-6 sm:mb-8 animate-fade-in">
                    <div class="relative">
                        <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-2xl"></div>
                        <div class="relative flex items-center justify-center rounded-full bg-gradient-to-br from-[#F0F7F0] via-[#CFE0CF] to-[#2F4F2F] p-1.5 sm:p-2 shadow-lg ring-2 sm:ring-4 ring-[#2F4F2F]/10">
                            <img src="{{ asset('images/logoKgBudiman.png') }}" alt="Logo Kampung Budiman"
                                class="w-32 h-32 xs:w-36 xs:h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 lg:w-48 lg:h-48 object-contain rounded-full border-2 sm:border-4 border-[#2F4F2F]/30 bg-white shadow-lg" />
                        </div>
                    </div>
                </div>

                {{-- Title Section --}}
                <div class="text-center mb-6 sm:mb-8 md:mb-10">
                    <h1 class="text-2xl xs:text-3xl sm:text-4xl md:text-5xl font-bold mb-2 sm:mb-3 md:mb-4 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Sistem e-Aduan
                    </h1>
                    <h2 class="text-xl xs:text-2xl sm:text-2xl md:text-3xl font-semibold mb-2 sm:mb-3 text-[#132A13]">
                        Kampung Budiman
                    </h2>
                    <p class="text-[#2F4F2F]/70 text-sm xs:text-base sm:text-base md:text-lg font-medium max-w-md mx-auto px-2">
                        Platform digital untuk membuat aduan dan menyemak status aduan anda dengan mudah
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 xs:gap-4 mb-6 sm:mb-8">
                    {{-- Tambah Aduan Button --}}
                    <a href="{{ route('public.complaint.create') }}"
                        class="group relative overflow-hidden rounded-xl sm:rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] p-4 xs:p-5 sm:p-6 text-white shadow-lg transition-all duration-300 hover:shadow-2xl active:scale-[0.98] sm:hover:scale-[1.02] transform touch-manipulation">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex flex-col items-center gap-2 xs:gap-3 sm:gap-3">
                            <div class="w-12 h-12 xs:w-14 xs:h-14 sm:w-14 sm:h-14 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fa fa-pencil-alt text-xl xs:text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="text-center">
                                <h3 class="text-base xs:text-lg font-bold mb-1">Tambah Aduan</h3>
                                <p class="text-xs xs:text-sm text-white/90">Buat aduan baharu</p>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>

                    {{-- Semak Status Button --}}
                    <a href="{{ route('public.status.check') }}"
                        class="group relative overflow-hidden rounded-xl sm:rounded-2xl bg-gradient-to-br from-[#2F4F2F] to-[#132A13] p-4 xs:p-5 sm:p-6 text-white shadow-lg transition-all duration-300 hover:shadow-2xl active:scale-[0.98] sm:hover:scale-[1.02] transform touch-manipulation">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex flex-col items-center gap-2 xs:gap-3 sm:gap-3">
                            <div class="w-12 h-12 xs:w-14 xs:h-14 sm:w-14 sm:h-14 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                                <i class="fa fa-search text-xl xs:text-2xl" aria-hidden="true"></i>
                            </div>
                            <div class="text-center">
                                <h3 class="text-base xs:text-lg font-bold mb-1">Semak Status</h3>
                                <p class="text-xs xs:text-sm text-white/90">Lihat status aduan</p>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </a>
                </div>

                {{-- Quick Info Section --}}
                <div class="grid grid-cols-3 gap-2 xs:gap-3 sm:gap-4 pt-4 sm:pt-6 border-t border-[#2F4F2F]/10">
                    <div class="text-center">
                        <div class="text-lg xs:text-xl sm:text-2xl font-bold text-[#132A13] mb-1">24/7</div>
                        <div class="text-[10px] xs:text-xs text-[#2F4F2F]/70 leading-tight">Akses Sepanjang Masa</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg xs:text-xl sm:text-2xl font-bold text-[#132A13] mb-1">Pantas</div>
                        <div class="text-[10px] xs:text-xs text-[#2F4F2F]/70 leading-tight">Proses Cepat</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg xs:text-xl sm:text-2xl font-bold text-[#132A13] mb-1">Mudah</div>
                        <div class="text-[10px] xs:text-xs text-[#2F4F2F]/70 leading-tight">Senang Digunakan</div>
                    </div>
                </div>

                {{-- Back Button --}}
                <div class="flex justify-center mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-[#2F4F2F]/10">
                    <a href="{{ config('app.website_url') }}"
                        class="group flex items-center justify-center gap-2 xs:gap-3 sm:gap-3 px-4 py-2.5 xs:px-5 xs:py-3 sm:px-6 sm:py-3.5 md:px-8 md:py-4 rounded-lg sm:rounded-xl bg-[#F0F7F0]/80 backdrop-blur-sm text-[#132A13] shadow-md border border-[#2F4F2F]/20 transition-all duration-300 hover:bg-[#132A13] hover:text-white hover:shadow-lg active:scale-95 sm:hover:scale-105 touch-manipulation w-full sm:w-auto min-w-[200px]">
                        <svg class="w-4 h-4 xs:w-5 xs:h-5 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span class="text-sm xs:text-base sm:text-lg font-medium whitespace-nowrap">Kembali ke Laman Utama</span>
                    </a>
                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-6 sm:mt-8 text-center px-2">
                <p class="text-xs xs:text-sm text-[#2F4F2F]/60 font-medium">
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

    /* Touch optimization for mobile devices */
    .touch-manipulation {
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
    }

</style>
@endpush
@endsection
