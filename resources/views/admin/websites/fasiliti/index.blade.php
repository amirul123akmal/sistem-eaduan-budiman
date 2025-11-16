@extends('layouts.admin')

@section('content')
    @php
        $user = auth()->user();
        $isSuperAdmin = $user && method_exists($user, 'hasRole') && $user->hasRole('Super Admin');
        $indexRoute = $isSuperAdmin ? 'admin.websites.fasiliti.index' : 'admin.panel.websites.fasiliti.index';
        $createRoute = $isSuperAdmin ? 'admin.websites.fasiliti.create' : 'admin.panel.websites.fasiliti.create';
        $editRoute = $isSuperAdmin ? 'admin.websites.fasiliti.edit' : 'admin.panel.websites.fasiliti.edit';
        $destroyRoute = $isSuperAdmin ? 'admin.websites.fasiliti.destroy' : 'admin.panel.websites.fasiliti.destroy';
    @endphp

    {{-- Header with Back Button and Title --}}
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ $isSuperAdmin ? route('admin.dashboard') : route('admin.panel.dashboard') }}"
                class="group flex items-center gap-2 px-4 py-2 rounded-xl bg-white border-2 border-[#F0F7F0] text-[#132A13] shadow-sm transition-all duration-300 hover:bg-[#F0F7F0] hover:border-[#132A13] hover:shadow-md active:scale-95 touch-manipulation">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                    Fasiliti Kampung Budiman
                </h1>
                <p class="text-sm sm:text-base text-gray-600">Urus fasiliti dan kemudahan di Kampung Budiman</p>
            </div>
            <a href="{{ route($createRoute) }}"
                class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-5 py-3 sm:px-6 sm:py-3.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] active:scale-95 transform touch-manipulation">
                <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative flex items-center justify-center gap-2">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Tambah Fasiliti</span>
                </div>
            </a>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-br from-[#F0F7F0] to-white p-6 shadow-lg">
        <form id="searchForm" class="flex gap-4" onsubmit="return false;">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput" name="search" placeholder="Cari Fasiliti (Nama, Keterangan, Lokasi)..."
                        class="w-full pl-10 rounded-xl border-2 border-gray-200 py-2.5 text-sm shadow-sm focus:border-[#132A13] focus:ring-[#132A13] transition-all">
                </div>
            </div>
            <button type="button" id="resetBtn" 
                class="hidden group relative overflow-hidden rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 hover:border-gray-400 transition-all duration-300">
                <div class="relative flex items-center justify-center gap-2">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Reset</span>
                </div>
            </button>
        </form>
        <div id="searchResults" class="mt-3 text-sm text-gray-600 hidden">
            <span id="resultCount" class="font-semibold text-[#132A13]">0</span> hasil ditemui
        </div>
    </div>

    {{-- Data Table --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg">
        @if (isset($fasiliti) && count($fasiliti) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80">
                        <tr>
                            <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">No.</th>
                            <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Gambar</th>
                            <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama Fasiliti</th>
                            <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Keterangan</th>
                            <th class="hidden lg:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Link Lokasi</th>
                            <th class="px-4 sm:px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody id="fasilitiTableBody" class="divide-y divide-gray-200 bg-white">
                        @foreach ($fasiliti as $index => $row)
                            <tr class="fasiliti-row hover:bg-[#F0F7F0]/50 transition-colors"
                                data-name="{{ strtolower($row->name ?? '') }}"
                                data-description="{{ strtolower($row->description ?? '') }}"
                                data-location="{{ strtolower($row->location ?? '') }}">
                                <td class="whitespace-nowrap px-4 sm:px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#F0F7F0] text-[#132A13] font-bold text-sm">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="w-20 sm:w-32 h-16 sm:h-24 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                                        @if (isset($row->image_path))
                                            <img class="w-full h-full object-cover" 
                                                src="{{ config('app.website_url') . '/storage/' . $row->image_path }}" 
                                                alt="{{ $row->name ?? 'Fasiliti' }}">
                                        @else
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $row->name ?? 'N/A' }}</div>
                                    <div class="md:hidden text-xs text-gray-500 mt-1">{{ Str::limit($row->description ?? '', 50) }}</div>
                                </td>
                                <td class="hidden md:table-cell px-6 py-4">
                                    <div class="text-sm text-gray-600 max-w-xs truncate">{{ $row->description ?? '-' }}</div>
                                </td>
                                <td class="hidden lg:table-cell px-6 py-4">
                                    @if (isset($row->location))
                                        <a href="{{ $row->location }}" target="_blank" 
                                            class="inline-flex items-center gap-1 text-xs text-[#132A13] hover:underline truncate max-w-xs">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="truncate">{{ Str::limit($row->location, 30) }}</span>
                                        </a>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 sm:px-6 py-4">
                                    <div class="flex items-center justify-end gap-2 flex-wrap">
                                        <a href="{{ route($editRoute, ['fasiliti' => $row->facilityID]) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg border-2 border-[#F0F7F0] bg-[#F0F7F0] px-3 py-1.5 text-xs font-semibold text-[#132A13] shadow-sm hover:bg-[#132A13] hover:text-white hover:border-[#132A13] transition-all hover:scale-105 active:scale-95 transform touch-manipulation">
                                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                            <span class="hidden xs:inline">Edit</span>
                                        </a>
                                        <form action="{{ route($destroyRoute, ['fasiliti' => $row->facilityID]) }}" method="POST"
                                            class="inline delete-fasiliti-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                class="delete-fasiliti-btn inline-flex items-center gap-1.5 rounded-lg border-2 border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 shadow-sm hover:bg-red-600 hover:text-white hover:border-red-600 transition-all hover:scale-105 active:scale-95 transform touch-manipulation"
                                                data-name="{{ $row->name ?? 'Fasiliti ini' }}">
                                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="hidden xs:inline">Padam</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- No Results Message (Hidden by default) --}}
            <div id="noResultsMessage" class="hidden px-6 py-16 text-center">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-[#F0F7F0] to-[#F0F7F0]/50 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Tiada Hasil Ditemui</h3>
                <p class="text-sm text-gray-500 mb-6">Tiada Fasiliti yang sepadan dengan carian anda.</p>
                <button type="button" id="clearSearchBtn"
                    class="inline-flex items-center gap-2 rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 hover:border-gray-400 transition-all">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Kosongkan Carian</span>
                </button>
            </div>
        @else
            <div class="px-6 py-16 text-center">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-[#F0F7F0] to-[#F0F7F0]/50 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Tiada Fasiliti</h3>
                <p class="text-sm text-gray-500 mb-6">Mula dengan menambah fasiliti baharu.</p>
                <a href="{{ route($createRoute) }}"
                    class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] active:scale-95 transform touch-manipulation">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah Fasiliti
                </a>
            </div>
        @endif
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

            // Search and Filter Functionality
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const resetBtn = document.getElementById('resetBtn');
                const clearSearchBtn = document.getElementById('clearSearchBtn');
                const searchResults = document.getElementById('searchResults');
                const resultCount = document.getElementById('resultCount');
                const noResultsMessage = document.getElementById('noResultsMessage');
                const tableBody = document.getElementById('fasilitiTableBody');
                const tableContainer = tableBody ? tableBody.closest('.overflow-x-auto') : null;

                function filterTable() {
                    const searchTerm = searchInput.value.toLowerCase().trim();
                    const rows = document.querySelectorAll('.fasiliti-row');
                    let visibleCount = 0;

                    if (!rows.length) return;

                    rows.forEach(row => {
                        const name = row.getAttribute('data-name') || '';
                        const description = row.getAttribute('data-description') || '';
                        const location = row.getAttribute('data-location') || '';

                        const matches = searchTerm === '' || 
                            name.includes(searchTerm) || 
                            description.includes(searchTerm) || 
                            location.includes(searchTerm);

                        if (matches) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Show/hide reset button
                    if (searchTerm) {
                        resetBtn.classList.remove('hidden');
                        searchResults.classList.remove('hidden');
                        resultCount.textContent = visibleCount;
                    } else {
                        resetBtn.classList.add('hidden');
                        searchResults.classList.add('hidden');
                    }

                    // Show/hide no results message
                    if (visibleCount === 0 && searchTerm) {
                        if (tableContainer) tableContainer.style.display = 'none';
                        noResultsMessage.classList.remove('hidden');
                    } else {
                        if (tableContainer) tableContainer.style.display = '';
                        noResultsMessage.classList.add('hidden');
                    }
                }

                // Search input event listener
                if (searchInput) {
                    searchInput.addEventListener('input', filterTable);
                    searchInput.addEventListener('keyup', function(e) {
                        if (e.key === 'Escape') {
                            searchInput.value = '';
                            filterTable();
                        }
                    });
                }

                // Reset button event listener
                if (resetBtn) {
                    resetBtn.addEventListener('click', function() {
                        searchInput.value = '';
                        filterTable();
                        searchInput.focus();
                    });
                }

                // Clear search button in no results message
                if (clearSearchBtn) {
                    clearSearchBtn.addEventListener('click', function() {
                        searchInput.value = '';
                        filterTable();
                        searchInput.focus();
                    });
                }

                // SweetAlert2 confirmation for delete action
                const deleteButtons = document.querySelectorAll('.delete-fasiliti-btn');
                
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const form = this.closest('.delete-fasiliti-form');
                        const fasilitiName = this.getAttribute('data-name') || 'Fasiliti ini';
                        
                        Swal.fire({
                            title: 'Adakah anda pasti?',
                            html: `Adakah anda pasti mahu memadam <strong>${fasilitiName}</strong>?<br><br>Tindakan ini tidak boleh dibatalkan.`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc2626',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Ya, Padam!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true,
                            focusCancel: true,
                            customClass: {
                                popup: 'rounded-2xl',
                                confirmButton: 'rounded-lg',
                                cancelButton: 'rounded-lg'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Show loading state
                                Swal.fire({
                                    title: 'Memadam...',
                                    text: 'Sila tunggu sebentar.',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                
                                // Submit the form
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
