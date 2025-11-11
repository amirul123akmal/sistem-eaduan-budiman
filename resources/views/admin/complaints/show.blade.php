@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Butiran Aduan</h1>
        <p class="text-sm text-gray-600">ID Aduan: {{ $complaint->public_id ?? 'N/A' }}</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route($isAdminPanel ? 'admin.panel.complaints.edit' : 'admin.complaints.edit', $complaint) }}"
           class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
            <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative flex items-center gap-2">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                Edit
            </div>
        </a>
        <a href="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}"
           class="rounded-xl border-2 border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                Kembali
            </div>
        </a>
    </div>
</div>

{{-- Main Two-Column Layout --}}
<div class="grid gap-6 lg:grid-cols-3">
    {{-- Left Column (Image Gallery) --}}
    <div class="lg:col-span-1">
        @if($complaint->hasImages())
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-lg">
                <div class="mb-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">
                            Gambar Aduan 
                        </h2>
                        <p class="text-xs text-gray-600">{{ count($complaint->image_path) }} gambar</p>
                    </div>
                </div>
                <div class="space-y-4">
                    {{-- Main Featured Image --}}
                    <div class="relative group">
                        <img id="main-image" 
                             src="{{ asset('storage/' . $complaint->image_path[0]) }}" 
                             alt="Gambar Aduan Utama"
                             class="w-full rounded-md border object-cover aspect-[4/3] transition-transform duration-300 group-hover:scale-[1.02] cursor-pointer">
                        <a href="{{ asset('storage/' . $complaint->image_path[0]) }}" target="_blank"
                           class="absolute bottom-3 right-3 inline-flex items-center rounded-md bg-white/90 px-3 py-1.5 text-sm font-medium text-gray-800 shadow hover:bg-white transition-colors">
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                            Lihat Penuh
                        </a>
                    </div>
                    
                    {{-- Thumbnail Gallery --}}
                    @if(count($complaint->image_path) > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($complaint->image_path as $index => $imagePath)
                                <button type="button" 
                                        onclick="changeMainImage(event, '{{ asset('storage/' . $imagePath) }}', '{{ asset('storage/' . $imagePath) }}')"
                                        class="relative group/thumb focus:outline-none focus:ring-2 focus:ring-[#132A13] focus:ring-offset-2 rounded-md overflow-hidden {{ $index === 0 ? 'ring-2 ring-[#132A13]' : '' }}">
                                    <img src="{{ asset('storage/' . $imagePath) }}" 
                                         alt="Thumbnail {{ $index + 1 }}"
                                         class="w-full h-16 object-cover transition-opacity duration-200 group-hover/thumb:opacity-75">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover/thumb:bg-opacity-30 transition-opacity flex items-center justify-center">
                                        <svg class="h-4 w-4 text-white opacity-0 group-hover/thumb:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-8 flex items-center justify-center h-full">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500">Tiada gambar aduan disediakan</p>
                </div>
            </div>
        @endif
    </div>

    {{-- Right Column (Details + Actions) --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Basic Information --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-lg">
            <div class="mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">Maklumat Asas</h2>
            </div>
            <dl class="grid gap-6 sm:grid-cols-2">
                <div class="bg-gradient-to-br from-[#F0F7F0] to-white p-4 rounded-xl border border-[#F0F7F0]">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">ID Aduan</dt>
                    <dd class="text-lg font-bold text-[#132A13]">{{ $complaint->public_id ?? 'N/A' }}</dd>
                </div>
                <div class="bg-gradient-to-br from-[#F0F7F0] to-white p-4 rounded-xl border border-[#F0F7F0]">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Status</dt>
                    <dd class="mt-1">
                        @php
                            $statusColors = [
                                'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                'diterima' => 'bg-blue-100 text-blue-800 border-blue-300',
                                'ditolak' => 'bg-red-100 text-red-800 border-red-300',
                                'selesai' => 'bg-green-100 text-green-800 border-green-300',
                            ];
                            $color = $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                        @endphp
                        <span class="inline-flex items-center gap-1.5 rounded-full border-2 px-3 py-1 text-xs font-bold {{ $color }}">
                            @if($complaint->status === 'menunggu')
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-600 animate-pulse"></span>
                            @elseif($complaint->status === 'diterima')
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            @elseif($complaint->status === 'selesai')
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            @else
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                            @endif
                            {{ ucfirst($complaint->status) }}
                        </span>
                    </dd>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        Nama
                    </dt>
                    <dd class="text-sm font-semibold text-gray-900">{{ $complaint->name }}</dd>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                        Telefon
                    </dt>
                    <dd class="text-sm font-semibold text-gray-900">{{ $complaint->phone_number }}</dd>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        Emel
                    </dt>
                    <dd class="text-sm font-semibold text-gray-900">{{ $complaint->email ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2 bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        Alamat
                    </dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $complaint->address }}</dd>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                        Jenis Aduan
                    </dt>
                    <dd class="text-sm font-semibold text-gray-900">{{ $complaint->complaintType->type_name ?? '-' }}</dd>
                </div>
                <div class="bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        Tarikh Dicipta
                    </dt>
                    <dd class="text-sm font-semibold text-gray-900">{{ $complaint->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div class="sm:col-span-2 bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        Penerangan
                    </dt>
                    <dd class="mt-2 text-sm text-gray-900 whitespace-pre-wrap leading-relaxed">{{ $complaint->description }}</dd>
                </div>
                @if($complaint->admin_comment)
                    <div class="sm:col-span-2 bg-gradient-to-br from-[#F0F7F0] to-white p-4 rounded-xl border-2 border-[#F0F7F0]">
                        <dt class="text-xs font-semibold text-[#132A13] uppercase tracking-wide mb-2 flex items-center gap-1">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            Komen Admin
                        </dt>
                        <dd class="mt-2 text-sm text-gray-900 whitespace-pre-wrap leading-relaxed">{{ $complaint->admin_comment }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- Status History --}}
        @if($complaint->statusLogs->count() > 0)
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-lg">
                <div class="mb-6 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Sejarah Status</h2>
                </div>
                <div class="space-y-4">
                    @foreach($complaint->statusLogs->sortByDesc('created_at') as $log)
                        <div class="relative flex items-start gap-4 pl-6">
                            <div class="absolute left-0 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#F0F7F0] to-[#F0F7F0]/50"></div>
                            <div class="absolute left-0 top-2 w-3 h-3 rounded-full bg-[#132A13] border-2 border-white shadow-sm"></div>
                            <div class="flex-1 bg-gradient-to-br from-gray-50 to-white p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center gap-3 mb-2">
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                            'diterima' => 'bg-blue-100 text-blue-800 border-blue-300',
                                            'ditolak' => 'bg-red-100 text-red-800 border-red-300',
                                            'selesai' => 'bg-green-100 text-green-800 border-green-300',
                                        ];
                                        $color = $statusColors[$log->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 rounded-full border-2 px-3 py-1 text-xs font-bold {{ $color }}">
                                        {{ ucfirst($log->status) }}
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        {{ $log->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                                @if($log->updater)
                                    <p class="text-xs text-gray-600 mb-2 flex items-center gap-1">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                        Oleh: <span class="font-semibold">{{ $log->updater->name }}</span>
                                    </p>
                                @elseif($log->updated_by)
                                    <p class="text-xs text-gray-600 mb-2 flex items-center gap-1">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                        Oleh: <span class="font-semibold">Admin</span>
                                    </p>
                                @endif
                                @if($log->comment)
                                    <p class="mt-2 text-sm text-gray-700 bg-white p-3 rounded-lg border border-gray-200">{{ $log->comment }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Quick Actions --}}
        <div class="rounded-2xl border-2 border-red-200 bg-gradient-to-br from-red-50 to-white p-6 shadow-lg">
            <div class="mb-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-red-500 flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </div>
                <h3 class="text-base font-bold text-gray-900">Tindakan Pantas</h3>
            </div>
            <div class="space-y-2">
                <form action="{{ route($isAdminPanel ? 'admin.panel.complaints.destroy' : 'admin.complaints.destroy', $complaint) }}" 
                      method="POST" 
                      id="deleteComplaintForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-600 to-red-700 px-4 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Padam Aduan
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeMainImage(event, imageUrl, fullImageUrl) {
        const mainImage = document.getElementById('main-image');
        const mainImageLink = mainImage ? mainImage.nextElementSibling : null;
        
        // Update main image
        if (mainImage) {
            mainImage.src = imageUrl;
        }
        
        // Update link
        if (mainImageLink) {
            mainImageLink.href = fullImageUrl;
        }
        
        // Update active thumbnail
        document.querySelectorAll('[onclick^="changeMainImage"]').forEach(btn => {
            btn.classList.remove('ring-2', 'ring-[#132A13]');
        });
        
        if (event && event.target) {
            const clickedButton = event.target.closest('button');
            if (clickedButton) {
                clickedButton.classList.add('ring-2', 'ring-[#132A13]');
            }
        }
    }

    // Delete confirmation with SweetAlert2
    document.getElementById('deleteComplaintForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Adakah anda pasti?',
            text: `Aduan {{ $complaint->public_id ?? '#' . $complaint->id }} - "{{ $complaint->name }}" akan dipadam secara kekal!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endpush
@endsection
