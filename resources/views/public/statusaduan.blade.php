@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0]">
    <div class="flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-4xl">
            {{-- Main Card --}}
            <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-12 rounded-3xl shadow-2xl border border-[#2F4F2F]/10">
                {{-- Header Section --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-xl"></div>
                            <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#132A13] to-[#2F4F2F] flex items-center justify-center shadow-lg">
                                <i class="fa fa-file-alt text-3xl text-white" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-3 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Status Aduan Anda
                    </h1>
                    <p class="text-[#2F4F2F]/70 text-base font-medium">
                        Maklumat lengkap mengenai aduan anda
                    </p>
                </div>

                {{-- Status Badge --}}
                <div class="mb-8 flex justify-center">
                    <div class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-gradient-to-r from-yellow-50 to-yellow-100 border-2 border-yellow-300 shadow-md">
                        <div class="w-3 h-3 rounded-full bg-yellow-500 animate-pulse"></div>
                        <span class="text-lg font-bold text-yellow-800">Dalam Proses</span>
                    </div>
                </div>

                {{-- Information Grid --}}
                <div class="grid sm:grid-cols-2 gap-6 mb-8">
                    {{-- Jenis Aduan --}}
                    <div class="bg-gradient-to-br from-[#F0F7F0] to-white p-5 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                <i class="fa fa-list text-[#132A13]" aria-hidden="true"></i>
                            </div>
                            <label class="text-xs font-semibold text-[#2F4F2F]/70 uppercase tracking-wide">Jenis Aduan</label>
                        </div>
                        <p class="text-base font-semibold text-gray-900">Prasarana</p>
                    </div>

                    {{-- Alamat --}}
                    <div class="bg-gradient-to-br from-[#F0F7F0] to-white p-5 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                <i class="fa fa-map-marker-alt text-[#132A13]" aria-hidden="true"></i>
                            </div>
                            <label class="text-xs font-semibold text-[#2F4F2F]/70 uppercase tracking-wide">Alamat</label>
                        </div>
                        <p class="text-base font-semibold text-gray-900">Jalan Kampung Budiman</p>
                    </div>
                </div>

                {{-- Huraian Section --}}
                <div class="mb-8 bg-gradient-to-br from-[#F0F7F0] to-white p-6 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                            <i class="fa fa-file-alt text-[#132A13]" aria-hidden="true"></i>
                        </div>
                        <label class="text-sm font-semibold text-[#132A13]">Huraian Aduan</label>
                    </div>
                    <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">
                        Terdapat longkang tersumbat di hadapan rumah menyebabkan air bertakung dan berbau busuk. Memerlukan tindakan segera.
                    </p>
                </div>

                {{-- Gambar Aduan --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                            <i class="fa fa-image text-[#132A13]" aria-hidden="true"></i>
                        </div>
                        <label class="text-sm font-semibold text-[#132A13]">Gambar Aduan</label>
                    </div>
                    <div class="rounded-2xl overflow-hidden border-2 border-gray-200 shadow-lg">
                        <img src="{{ asset('images/aduan-sampah.jpg') }}" 
                             alt="Gambar Aduan"
                             class="w-full h-auto object-cover">
                    </div>
                </div>

                {{-- Timeline Section --}}
                <div class="mb-8 bg-gradient-to-br from-[#F0F7F0] to-white p-6 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                            <i class="fa fa-clock text-[#132A13]" aria-hidden="true"></i>
                        </div>
                        <label class="text-sm font-semibold text-[#132A13]">Timeline Aduan</label>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#132A13] flex items-center justify-center">
                                <i class="fa fa-paper-plane text-white text-sm" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Tarikh Hantar</p>
                                <p class="text-sm text-[#2F4F2F]/70">1 November 2025</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
                                <i class="fa fa-check text-white text-sm" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Tarikh JKK Terima</p>
                                <p class="text-sm text-[#2F4F2F]/70">2 November 2025</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 opacity-50">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                                <i class="fa fa-check-circle text-white text-sm" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">Tarikh Selesai</p>
                                <p class="text-sm text-[#2F4F2F]/70">Akan dikemaskini</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="flex justify-center pt-6 border-t border-[#2F4F2F]/10">
                    <a href="{{ route('public.home') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-8 py-3.5 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center gap-2">
                            <i class="fa fa-home text-lg" aria-hidden="true"></i>
                            <span class="font-bold">Kembali ke Laman Utama</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
