{{-- Mobile overlay --}}
<div id="admin-sidebar-backdrop" class="fixed inset-0 z-30 hidden bg-gray-900/50 transition-opacity duration-300 lg:hidden"></div>

<aside id="admin-sidebar"
    class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-gradient-to-b from-white to-gray-50/50 shadow-2xl transition-transform lg:translate-x-0"
    aria-label="Sidebar" tabindex="-1">
    <div class="flex h-full flex-col justify-between overflow-y-auto px-4 py-6">
        <div>
            <div class="mb-8 px-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center justify-center transition-transform duration-300 hover:scale-105">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-[#132A13]/10 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <img src="{{ asset('images/logoKgBudiman.png') }}" alt="JPKK Kampung Budiman"
                            class="relative h-auto w-full max-w-[180px] object-contain drop-shadow-lg" />
                    </div>
                </a>
            </div>
            <nav class="space-y-2">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.dashboard')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.dashboard'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.dashboard')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                    </span>
                    <span class="relative">Dashboard</span>
                </a>

                {{-- Profil --}}
                <a href="{{ route('profile.edit') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('profile.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('profile.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('profile.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Profil</span>
                </a>

                {{-- Pentadbiran --}}
                <div class="mt-6 mb-3 px-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        <span>Pentadbiran</span>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    </h3>
                </div>
                <a href="{{ route('admin.admins.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.admins.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.admins.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.admins.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                            </path>
                        </svg>
                    </span>
                    <span class="relative">Pengurusan Admin</span>
                </a>
                <a href="{{ route('admin.admins.create') }}"
                    class="ml-8 group flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-medium transition-all duration-200 @if (request()->routeIs('admin.admins.create')) bg-[#F0F7F0] text-[#132A13] shadow-sm @else text-gray-600 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                        </path>
                    </svg>
                    Tambah Admin
                </a>

                <a href="{{ route('admin.roles.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.roles.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.roles.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.roles.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Peranan</span>
                </a>
                <a href="{{ route('admin.permissions.index') }}"
                    class="ml-8 group flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-medium transition-all duration-200 @if (request()->routeIs('admin.permissions.*')) bg-[#F0F7F0] text-[#132A13] shadow-sm @else text-gray-600 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Kebenaran
                </a>

                {{-- e-Aduan --}}
                <div class="mt-6 mb-3 px-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        <span>e-Aduan</span>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    </h3>
                </div>
                <a href="{{ route('admin.complaints.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.complaints.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.complaints.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.complaints.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Aduan</span>
                </a>
                <a href="{{ route('admin.complaint-types.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.complaint-types.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.complaint-types.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.complaint-types.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Jenis Aduan</span>
                </a>
                <a href="{{ route('admin.audit-trails.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.audit-trails.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.audit-trails.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.audit-trails.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Audit Trail</span>
                </a>

                {{-- Website sahaja --}}
                <div class="mt-6 mb-3 px-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        <span>Website</span>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    </h3>
                </div>
                <a href="{{ route('admin.websites.bizhub.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.websites.bizhub.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.websites.bizhub.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.websites.bizhub.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z">
                            </path>
                            <path
                                d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                            </path>
                        </svg>
                    </span>
                    <span class="relative">Bizhub</span>
                </a>
                <a href="{{ route('admin.websites.aktiviti.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.websites.aktiviti.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.websites.aktiviti.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.websites.aktiviti.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Aktiviti</span>
                </a>
                <a href="{{ route('admin.websites.fasiliti.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.websites.fasiliti.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.websites.fasiliti.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.websites.fasiliti.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Fasiliti</span>
                </a>
                <a href="{{ route('admin.websites.ajk.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.websites.ajk.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.websites.ajk.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.websites.ajk.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                            </path>
                        </svg>
                    </span>
                    <span class="relative">Ahli Jawatan Kuasa</span>
                </a>
                <a href="{{ route('admin.websites.pengumuman.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.websites.pengumuman.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.websites.pengumuman.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.websites.pengumuman.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Pengumuman</span>
                </a>

            </nav>
        </div>
        <div class="mt-6 px-3 pt-4 border-t border-gray-200">
            <div class="flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 px-3 py-2">
                <div class="w-2 h-2 rounded-full bg-[#132A13] animate-pulse"></div>
                <span class="text-xs font-semibold text-[#132A13]">Version 1.0.0</span>
            </div>
        </div>
    </div>
    {{-- Close button for mobile --}}
    <button type="button" data-drawer-hide="admin-sidebar" aria-controls="admin-sidebar"
        class="absolute right-2.5 top-2.5 inline-flex items-center rounded-xl bg-white/80 backdrop-blur-sm p-2 text-sm text-gray-600 shadow-lg hover:bg-white hover:text-gray-900 transition-all lg:hidden">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
</aside>
