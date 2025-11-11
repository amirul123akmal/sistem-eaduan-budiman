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
                    @php
                        $statusColors = [
                            'menunggu' => 'from-yellow-50 to-yellow-100 border-yellow-300 text-yellow-800',
                            'diterima' => 'from-blue-50 to-blue-100 border-blue-300 text-blue-800',
                            'ditolak' => 'from-red-50 to-red-100 border-red-300 text-red-800',
                            'selesai' => 'from-green-50 to-green-100 border-green-300 text-green-800',
                        ];
                        $statusIcons = [
                            'menunggu' => '<div class="w-3 h-3 rounded-full bg-yellow-500 animate-pulse"></div>',
                            'diterima' => '<i class="fa fa-clock text-blue-600" aria-hidden="true"></i>',
                            'ditolak' => '<i class="fa fa-times-circle text-red-600" aria-hidden="true"></i>',
                            'selesai' => '<i class="fa fa-check-circle text-green-600" aria-hidden="true"></i>',
                        ];
                        $statusLabels = [
                            'menunggu' => 'Menunggu',
                            'diterima' => 'Diterima',
                            'ditolak' => 'Ditolak',
                            'selesai' => 'Selesai',
                        ];
                        $color = $statusColors[$complaint->status] ?? 'from-gray-50 to-gray-100 border-gray-300 text-gray-800';
                        $icon = $statusIcons[$complaint->status] ?? '';
                        $label = $statusLabels[$complaint->status] ?? ucfirst($complaint->status);
                    @endphp
                    <div class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-gradient-to-r {{ $color }} border-2 shadow-md">
                        {!! $icon !!}
                        <span class="text-lg font-bold">{{ $label }}</span>
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
                        <p class="text-base font-semibold text-gray-900">{{ $complaint->complaintType->type_name ?? 'N/A' }}</p>
                    </div>

                    {{-- ID Aduan --}}
                    <div class="bg-gradient-to-br from-[#F0F7F0] to-white p-5 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                <i class="fa fa-hashtag text-[#132A13]" aria-hidden="true"></i>
                            </div>
                            <label class="text-xs font-semibold text-[#2F4F2F]/70 uppercase tracking-wide">ID Aduan</label>
                        </div>
                        <p class="text-base font-semibold text-gray-900">{{ $complaint->public_id ?? 'N/A' }}</p>
                    </div>

                    {{-- Alamat --}}
                    <div class="sm:col-span-2 bg-gradient-to-br from-[#F0F7F0] to-white p-5 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                <i class="fa fa-map-marker-alt text-[#132A13]" aria-hidden="true"></i>
                            </div>
                            <label class="text-xs font-semibold text-[#2F4F2F]/70 uppercase tracking-wide">Alamat</label>
                        </div>
                        <p class="text-base font-semibold text-gray-900">{{ $complaint->address }}</p>
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
                        {{ $complaint->description }}
                    </p>
                </div>

                {{-- Gambar Aduan --}}
                @if($complaint->hasImages())
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                                <i class="fa fa-image text-[#132A13]" aria-hidden="true"></i>
                            </div>
                            <label class="text-sm font-semibold text-[#132A13]">Gambar Aduan ({{ count($complaint->image_path) }})</label>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($complaint->image_path as $imagePath)
                                <div class="rounded-2xl overflow-hidden border-2 border-gray-200 shadow-lg">
                                    <img src="{{ asset('storage/' . $imagePath) }}" 
                                         alt="Gambar Aduan {{ $loop->iteration }}"
                                         class="w-full h-auto object-cover cursor-pointer hover:opacity-90 transition-opacity"
                                         onclick="window.open('{{ asset('storage/' . $imagePath) }}', '_blank')">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Timeline Section --}}
                <div class="mb-8 bg-gradient-to-br from-[#F0F7F0] to-white p-6 rounded-2xl border border-[#2F4F2F]/10 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-[#132A13]/10 flex items-center justify-center">
                            <i class="fa fa-clock text-[#132A13]" aria-hidden="true"></i>
                        </div>
                        <label class="text-sm font-semibold text-[#132A13]">Timeline Aduan</label>
                    </div>
                    <div class="space-y-4">
                        @forelse($complaint->statusLogs ?? [] as $log)
                            @php
                                $logColors = [
                                    'menunggu' => 'bg-[#132A13]',
                                    'diterima' => 'bg-blue-500',
                                    'ditolak' => 'bg-red-500',
                                    'selesai' => 'bg-green-500',
                                ];
                                $logIcons = [
                                    'menunggu' => 'fa-paper-plane',
                                    'diterima' => 'fa-check',
                                    'ditolak' => 'fa-times',
                                    'selesai' => 'fa-check-circle',
                                ];
                                $color = $logColors[$log->status] ?? 'bg-gray-500';
                                $icon = $logIcons[$log->status] ?? 'fa-circle';
                                $isLast = $loop->last;
                            @endphp
                            <div class="flex items-start gap-4 {{ !$isLast ? '' : 'opacity-50' }}">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full {{ $color }} flex items-center justify-center">
                                    <i class="fa {{ $icon }} text-white text-sm" aria-hidden="true"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ ucfirst($log->status) }}
                                        @if($log->updater)
                                            - {{ $log->updater->name }}
                                        @else
                                            - Sistem
                                        @endif
                                    </p>
                                    <p class="text-sm text-[#2F4F2F]/70">{{ $log->created_at->format('d F Y H:i') }}</p>
                                    @if($log->comment)
                                        <p class="text-xs text-gray-600 mt-1 italic">{{ $log->comment }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#132A13] flex items-center justify-center">
                                    <i class="fa fa-paper-plane text-white text-sm" aria-hidden="true"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Tarikh Hantar</p>
                                    <p class="text-sm text-[#2F4F2F]/70">{{ $complaint->created_at->format('d F Y H:i') }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6 border-t border-[#2F4F2F]/10">
                    <a href="{{ route('public.complaints.list') }}"
                        class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-8 py-3.5 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-center gap-2">
                            <i class="fa fa-arrow-left text-lg" aria-hidden="true"></i>
                            <span class="font-bold">Kembali ke Senarai</span>
                        </div>
                    </a>
                    <a href="{{ route('public.home') }}"
                        class="group relative overflow-hidden rounded-2xl border-2 border-[#132A13] bg-white px-8 py-3.5 text-[#132A13] shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform hover:bg-[#F0F7F0]">
                        <div class="relative flex items-center justify-center gap-2">
                            <i class="fa fa-home text-lg" aria-hidden="true"></i>
                            <span class="font-bold">Laman Utama</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Show error messages from server
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Ralat!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#132A13'
        });
    @endif
</script>
@endpush
@endsection
