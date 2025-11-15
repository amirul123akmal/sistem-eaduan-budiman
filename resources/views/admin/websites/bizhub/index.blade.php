@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">BizHub Kg. Budiman</h1>
            <p class="text-sm text-gray-600">Urus perniagaan dan perkhidmatan di Kampung Budiman</p>
        </div>
        <a href="{{ route('admin.panel.websites.bizhub.create') }}"
            class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
            <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
            <div class="relative flex items-center gap-2">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Tambah BizHub
            </div>
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-br from-[#F0F7F0] to-white p-6 shadow-lg">
        {{-- <form method="GET" action="{{ route('admin.panel.websites.bizhub.index') }}" class="flex gap-4"> --}}
        <form method="POST" action="" class="flex gap-4">
            @csrf
            @method('POST')
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari BizHub..."
                        class="w-full pl-10 rounded-xl border-2 border-gray-200 py-2.5 text-sm shadow-sm focus:border-[#132A13] focus:ring-[#132A13] transition-all">
                </div>
            </div>
            <button type="submit"
                class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative flex items-center justify-center gap-2">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Cari
                </div>
            </button>
            @if (request('search'))
                {{-- <a href="{{ route('admin.panel.websites.bizhub.index') }}"
                    class="rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
                    Reset
                </a> --}}
            @endif
        </form>
    </div>

    {{-- Data Table --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg">
        @if (isset($items) && count($items) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">No.</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($items as $index => $item)
                        <tr class="hover:bg-[#F0F7F0]/50 transition-colors">
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#F0F7F0] text-[#132A13] font-bold text-sm">
                                    {{ ($pagination['current_page'] ?? 1) * 10 - 10 + $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-[#F0F7F0] flex items-center justify-center">
                                        <svg class="h-5 w-5 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->name ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($item->description ?? '', 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">{{ $item->phone_number ?? '-' }}</div>
                                @if (isset($item->website))
                                    <a href="{{ $item->website }}" target="_blank" class="text-xs text-[#132A13] hover:underline">{{ $item->website }}</a>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @php
                                    $status = $item->status ?? 'inactive';
                                    $statusColors = [
                                        'active' => 'bg-green-100 text-green-800 border-green-300',
                                        'inactive' => 'bg-gray-100 text-gray-800 border-gray-300',
                                    ];
                                    $color = $statusColors[$status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full border-2 px-3 py-1 text-xs font-bold {{ $color }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.panel.websites.bizhub.edit', $item->vendorID) }}"
                                        class="inline-flex items-center gap-1.5 rounded-lg border-2 border-[#F0F7F0] bg-[#F0F7F0] px-3 py-1.5 text-xs font-semibold text-[#132A13] shadow-sm hover:bg-[#F0F7F0] transition-all hover:scale-105 transform">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                        <form action="{{ route('admin.panel.websites.bizhub.destroy', ['bizhub' => $item->vendorID]) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Adakah anda pasti mahu memadam bisnes ini?')">Padam</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-16 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-gray-900 mb-1">Tiada BizHub</h3>
                <p class="text-sm text-gray-500 mb-6">Mula dengan menambah BizHub baharu.</p>
                {{-- <a href="{{ route('admin.panel.websites.bizhub.create') }}"
                    class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah BizHub
                </a> --}}
            </div>
        @endif
    </div>

    {{-- Pagination --}}
    @if (isset($pagination) && isset($pagination['last_page']) && $pagination['last_page'] > 1)
        <div class="mt-6 flex flex-col items-center justify-between gap-4 sm:flex-row">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span>Menunjukkan</span>
                <span class="font-semibold text-[#132A13]">{{ $pagination['from'] ?? 0 }}</span>
                <span>hingga</span>
                <span class="font-semibold text-[#132A13]">{{ $pagination['to'] ?? 0 }}</span>
                <span>daripada</span>
                <span class="font-semibold text-[#132A13]">{{ $pagination['total'] ?? 0 }}</span>
                <span>rekod</span>
            </div>

            <div class="flex items-center gap-2">
                @if (isset($pagination['current_page']) && $pagination['current_page'] > 1)
                    {{-- <a href="{{ route('admin.panel.websites.bizhub.index', ['page' => $pagination['current_page'] - 1, 'search' => request('search')]) }}"
                        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-[#F0F7F0] hover:border-[#132A13] hover:text-[#132A13]">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Sebelumnya
                    </a> --}}
                @else
                    <button disabled
                        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Sebelumnya
                    </button>
                @endif

                <div class="hidden sm:flex items-center gap-1">
                    @for ($i = 1; $i <= min($pagination['last_page'] ?? 1, 10); $i++)
                        @if ($i == ($pagination['current_page'] ?? 1))
                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-sm font-semibold text-white shadow-md">{{ $i }}</span>
                        @else
                            {{-- <a href="{{ route('admin.panel.websites.bizhub.index', ['page' => $i, 'search' => request('search')]) }}"
                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 transition-all hover:bg-[#F0F7F0] hover:border-[#132A13] hover:text-[#132A13]">{{ $i }}</a> --}}
                        @endif
                    @endfor
                </div>

                @if (isset($pagination['current_page']) && $pagination['current_page'] < $pagination['last_page'])
                    {{-- <a href="{{ route('admin.panel.websites.bizhub.index', ['page' => $pagination['current_page'] + 1, 'search' => request('search')]) }}"
                        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-[#F0F7F0] hover:border-[#132A13] hover:text-[#132A13]">
                        Seterusnya
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a> --}}
                @else
                    <button disabled
                        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed">
                        Seterusnya
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    @endif

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
