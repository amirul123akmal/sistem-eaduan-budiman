@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0]">
    <div class="flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-lg">
            {{-- Main Card --}}
            <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-10 rounded-3xl shadow-2xl border border-[#2F4F2F]/10">
                {{-- Header Section --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-xl"></div>
                            <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#132A13] to-[#2F4F2F] flex items-center justify-center shadow-lg">
                                <i class="fa fa-search text-3xl text-white" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-3 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Semak Status Aduan
                    </h1>
                    <p class="text-[#2F4F2F]/70 text-base font-medium">
                        Masukkan nombor telefon yang digunakan semasa membuat aduan
                    </p>
                </div>

                {{-- Form Section --}}
                <form class="space-y-6" id="checkStatusForm">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#132A13]">
                            Nombor Telefon <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa fa-phone text-[#2F4F2F]/50" aria-hidden="true"></i>
                            </div>
                            <input type="tel" 
                                   name="no_telefon" 
                                   id="no_telefon"
                                   placeholder="Contoh: 0123456789" 
                                   pattern="[0-9]{10,11}"
                                   maxlength="11"
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#132A13] focus:border-[#132A13] transition-all"
                                   required>
                        </div>
                        <p class="text-xs text-[#2F4F2F]/60 mt-2 flex items-center gap-1">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            Tanpa tanda sengkang (-). Contoh: 0123456789
                        </p>
                    </div>

                    {{-- Submit Button --}}
                    <button type="button" 
                            onclick="window.location.href='{{ route('public.complaints.list') }}'"
                            class="w-full group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] p-4 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center gap-3">
                            <i class="fa fa-search text-lg" aria-hidden="true"></i>
                            <span class="text-base font-bold">Semak Status</span>
                        </div>
                    </button>

                    {{-- Back Link --}}
                    <div class="text-center pt-4">
                        <a href="{{ route('public.home') }}"
                            class="inline-flex items-center gap-2 text-sm text-[#2F4F2F]/70 hover:text-[#132A13] font-medium transition-colors">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Kembali ke Laman Utama
                        </a>
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
    document.getElementById('no_telefon').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endpush
@endsection
