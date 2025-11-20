@extends('layouts.admin')

@section('content')
    @php
        $user = auth()->user();
        $isSuperAdmin = $user && method_exists($user, 'hasRole') && $user->hasRole('Super Admin');
        $indexRoute = $isSuperAdmin ? 'admin.websites.pengumuman.index' : 'admin.panel.websites.pengumuman.index';
        $createRoute = $isSuperAdmin ? 'admin.websites.pengumuman.create' : 'admin.panel.websites.pengumuman.create';
    @endphp

    {{-- Header with Back Button and Title --}}
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ $isSuperAdmin ? route('admin.dashboard') : route('admin.panel.dashboard') }}"
                class="group flex items-center gap-2 px-4 py-2 rounded-xl bg-white border-2 border-[#F0F7F0] text-[#132A13] shadow-sm transition-all duration-300 hover:bg-[#F0F7F0] hover:border-[#132A13] hover:shadow-md active:scale-95 touch-manipulation">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1
                    class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                    Pengumuman
                </h1>
                <p class="text-sm sm:text-base text-gray-600">Urus pengumuman dan maklumat penting untuk penduduk Kampung Budiman</p>
            </div>
            <a href="{{ route($createRoute) }}"
                class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-5 py-3 sm:px-6 sm:py-3.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] active:scale-95 transform touch-manipulation">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative flex items-center justify-center gap-2">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Tambah Pengumuman</span>
                </div>
            </a>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-br from-[#F0F7F0] to-white p-6 shadow-lg">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="search" name="search" placeholder="Cari pengumuman..."
                class="w-full pl-10 rounded-xl border-2 border-gray-200 py-2.5 text-sm shadow-sm focus:border-[#132A13] focus:ring-[#132A13] transition-all">
        </div>
    </div>

    {{-- Data Table --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 bg-gradient-to-r from-[#F0F7F0] to-white">
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tajuk</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Kandungan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tarikh Mula</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Tarikh Tamat</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Imej</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Choose the collection variable that your controller provides
                    $collection = $pengumumans ?? ($pengumumanItems ?? []);
                    $editRoute = $isSuperAdmin ? 'admin.websites.pengumuman.edit' : 'admin.panel.websites.pengumuman.edit';
                    $destroyRoute = $isSuperAdmin ? 'admin.websites.pengumuman.destroy' : 'admin.panel.websites.pengumuman.destroy';
                @endphp

                @forelse($asdasd as $pengumuman)
                    <tr class="border-b border-gray-100 hover:bg-[#F0F7F0]/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pengumuman->title ?? '—' }}</td>

                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xl">
                            <div class="text-sm text-gray-600 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->content ?? ($pengumuman->kandungan ?? '')), 120) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $pengumuman->start_date ? \Carbon\Carbon::parse($pengumuman->start_date)->format('d F Y') : '-' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $pengumuman->end_date ? \Carbon\Carbon::parse($pengumuman->end_date)->format('d F Y') : '-' }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="w-20 h-12 overflow-hidden rounded-md border border-gray-200">
                                <img src="{{ config('app.website_url') }}/storage/{{ $pengumuman->image_path }}" alt="Imej Pengumuman"
                                    class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm">
                            {{-- <a href="{{ route($editRoute, $pengumuman->id ?? $pengumuman) }}" --}}
                            <a href="{{ route('asdasd.edit', ['pengumuman' => $pengumuman->announcementID]) }}"
                                class="text-[#132A13] hover:text-[#2F4F2F] font-medium mr-4">Edit</a>

                            <form action="{{ route('asdasd.destroy', ['pengumuman' => $pengumuman->announcementID]) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Padam pengumuman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Padam</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                            Tiada pengumuman ditemui.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Ralat!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc2626'
                });
            @endif
        </script>
    @endpush
@endsection
