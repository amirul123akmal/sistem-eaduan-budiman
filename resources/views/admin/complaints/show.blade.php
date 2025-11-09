@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-gray-900">Butiran Aduan</h1>
    <div class="flex items-center gap-3">
        <a href="{{ route($isAdminPanel ? 'admin.panel.complaints.edit' : 'admin.complaints.edit', $complaint) }}"
           class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
            Edit
        </a>
        <a href="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}"
           class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
            Kembali
        </a>
    </div>
</div>

{{-- Main Two-Column Layout --}}
<div class="grid gap-6 lg:grid-cols-3">
    {{-- Left Column (Image Gallery) --}}
    <div class="lg:col-span-1">
        @if($complaint->hasImages())
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">
                    Gambar Aduan 
                    <span class="text-sm font-normal text-gray-500">({{ count($complaint->image_path) }})</span>
                </h2>
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
                                        class="relative group/thumb focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-md overflow-hidden {{ $index === 0 ? 'ring-2 ring-indigo-500' : '' }}">
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
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm flex items-center justify-center h-full">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-500 italic">Tiada gambar aduan disediakan.</p>
                </div>
            </div>
        @endif
    </div>

    {{-- Right Column (Details + Actions) --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Basic Information --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Maklumat Asas</h2>
            <dl class="grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID Aduan</dt>
                    <dd class="mt-1 text-sm text-gray-900">#{{ $complaint->id }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @php
                            $statusColors = [
                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                'diterima' => 'bg-blue-100 text-blue-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                                'selesai' => 'bg-green-100 text-green-800',
                            ];
                            $color = $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $color }}">
                            {{ ucfirst($complaint->status) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $complaint->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Telefon</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $complaint->phone_number }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $complaint->address }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jenis Aduan</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $complaint->complaintType->type_name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tarikh Dicipta</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $complaint->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Penerangan</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $complaint->description }}</dd>
                </div>
                @if($complaint->admin_comment)
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Komen Admin</dt>
                        <dd class="mt-1 rounded-md bg-gray-50 p-3 text-sm text-gray-900 whitespace-pre-wrap">
                            {{ $complaint->admin_comment }}
                        </dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- Status History --}}
        @if($complaint->statusLogs->count() > 0)
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Sejarah Status</h2>
                <div class="space-y-4">
                    @foreach($complaint->statusLogs->sortByDesc('created_at') as $log)
                        <div class="flex items-start gap-4 border-l-2 border-gray-200 pl-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    @php
                                        $color = $statusColors[$log->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $color }}">
                                        {{ ucfirst($log->status) }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $log->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($log->updater)
                                    <p class="mt-1 text-xs text-gray-500">Oleh: {{ $log->updater->name }}</p>
                                @elseif($log->updated_by)
                                    <p class="mt-1 text-xs text-gray-500">Oleh: Admin</p>
                                @endif
                                @if($log->comment)
                                    <p class="mt-2 text-sm text-gray-700">{{ $log->comment }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Quick Actions --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-sm font-semibold text-gray-900">Tindakan Pantas</h3>
            <div class="space-y-2">
                <form action="{{ route($isAdminPanel ? 'admin.panel.complaints.destroy' : 'admin.complaints.destroy', $complaint) }}" 
                      method="POST" 
                      onsubmit="return confirm('Adakah anda pasti mahu memadam aduan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full rounded-md border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-50">
                        Padam Aduan
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
            btn.classList.remove('ring-2', 'ring-indigo-500');
        });
        
        if (event && event.target) {
            const clickedButton = event.target.closest('button');
            if (clickedButton) {
                clickedButton.classList.add('ring-2', 'ring-indigo-500');
            }
        }
    }
</script>
@endpush
@endsection
