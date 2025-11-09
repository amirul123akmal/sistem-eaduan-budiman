@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0]">
    <div class="flex items-center justify-center min-h-screen px-4 py-12">
        <div class="w-full max-w-5xl">
            {{-- Main Card --}}
            <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-12 rounded-3xl shadow-2xl border border-[#2F4F2F]/10">
                {{-- Header Section --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-xl"></div>
                            <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#132A13] to-[#2F4F2F] flex items-center justify-center shadow-lg">
                                <i class="fa fa-list-alt text-3xl text-white" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-3 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Senarai Aduan Anda
                    </h1>
                    <p class="text-[#2F4F2F]/70 text-base font-medium">
                        Nombor Telefon: <span class="font-semibold text-[#132A13]">0123456789</span>
                    </p>
                </div>

                {{-- Table Section --}}
                <div class="overflow-x-auto rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-[#132A13] to-[#2F4F2F]">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Jenis Aduan
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-white">
                                    Status Aduan
                                </th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-white">
                                    Tindakan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Sample Data Row 1 --}}
                            <tr class="hover:bg-[#F0F7F0]/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-[#132A13]/10 flex items-center justify-center">
                                            <span class="text-sm font-bold text-[#132A13]">1</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                            <i class="fa fa-road text-[#132A13]" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">Prasarana</div>
                                            <div class="text-xs text-[#2F4F2F]/60">Jalan, Longkang, Lampu</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-300">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                        Dalam Proses
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('public.status.view') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 transform">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Lihat Butiran
                                    </a>
                                </td>
                            </tr>

                            {{-- Sample Data Row 2 --}}
                            <tr class="hover:bg-[#F0F7F0]/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-[#132A13]/10 flex items-center justify-center">
                                            <span class="text-sm font-bold text-[#132A13]">2</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                            <i class="fa fa-trash-alt text-[#132A13]" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">Kebersihan</div>
                                            <div class="text-xs text-[#2F4F2F]/60">Sampah, Perparitan</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-300">
                                        <i class="fa fa-check-circle text-green-600" aria-hidden="true"></i>
                                        Selesai
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('public.status.view') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 transform">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Lihat Butiran
                                    </a>
                                </td>
                            </tr>

                            {{-- Sample Data Row 3 --}}
                            <tr class="hover:bg-[#F0F7F0]/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-[#132A13]/10 flex items-center justify-center">
                                            <span class="text-sm font-bold text-[#132A13]">3</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                            <i class="fa fa-shield-alt text-[#132A13]" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">Keselamatan</div>
                                            <div class="text-xs text-[#2F4F2F]/60">Jenayah, Pencahayaan</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-300">
                                        <i class="fa fa-clock text-blue-600" aria-hidden="true"></i>
                                        Diterima
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('public.status.view') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 transform">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Lihat Butiran
                                    </a>
                                </td>
                            </tr>

                            {{-- Sample Data Row 4 --}}
                            <tr class="hover:bg-[#F0F7F0]/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-[#132A13]/10 flex items-center justify-center">
                                            <span class="text-sm font-bold text-[#132A13]">4</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                            <i class="fa fa-ellipsis-h text-[#132A13]" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">Lain-lain</div>
                                            <div class="text-xs text-[#2F4F2F]/60">Aduan umum</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-300">
                                        <i class="fa fa-times-circle text-red-600" aria-hidden="true"></i>
                                        Ditolak
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('public.status.view') }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 transform">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        Lihat Butiran
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Empty State (Hidden - for future use) --}}
                <div class="hidden text-center py-12">
                    <div class="w-20 h-20 rounded-full bg-[#132A13]/10 flex items-center justify-center mx-auto mb-4">
                        <i class="fa fa-inbox text-4xl text-[#2F4F2F]/50" aria-hidden="true"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tiada Aduan Dijumpai</h3>
                    <p class="text-sm text-[#2F4F2F]/70 mb-6">Tiada aduan dijumpai untuk nombor telefon ini.</p>
                    <a href="{{ route('public.complaint.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white font-semibold shadow-md hover:shadow-lg transition-all">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Buat Aduan Baharu
                    </a>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8 pt-6 border-t border-[#2F4F2F]/10">
                    <a href="{{ route('public.status.check') }}"
                        class="inline-flex items-center gap-2 text-sm text-[#2F4F2F]/70 hover:text-[#132A13] font-medium transition-colors">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Semak Semula
                    </a>
                    <a href="{{ route('public.home') }}"
                        class="inline-flex items-center gap-2 text-sm text-[#2F4F2F]/70 hover:text-[#132A13] font-medium transition-colors">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Kembali ke Laman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

