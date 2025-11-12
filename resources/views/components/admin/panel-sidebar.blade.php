{{-- Mobile overlay --}}
<div id="admin-sidebar-backdrop"
    class="fixed inset-0 z-30 hidden bg-gray-900/50 transition-opacity duration-300 lg:hidden"></div>

<aside id="admin-sidebar"
    class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-gradient-to-b from-white to-gray-50/50 shadow-2xl transition-transform lg:translate-x-0"
    aria-label="Sidebar" tabindex="-1">
    <div class="flex h-full flex-col justify-between overflow-y-auto px-4 py-6">
        <div>
            <div class="mb-8 px-3">
                <a href="{{ route('admin.panel.dashboard') }}"
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
                <a href="{{ route('admin.panel.dashboard') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.dashboard')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.dashboard'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.dashboard')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
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
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Profil</span>
                </a>

                {{-- e-Aduan sahaja --}}
                <div class="mt-6 mb-3 px-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 flex items-center gap-2">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                        <span>e-Aduan</span>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    </h3>
                </div>
                <a href="{{ route('admin.panel.complaints.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.complaints.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.complaints.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.complaints.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Aduan</span>
                </a>
                <a href="{{ route('admin.panel.complaint-types.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.complaint-types.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.complaint-types.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.complaint-types.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Jenis Aduan</span>
                </a>
                <a href="{{ route('admin.panel.audit-trails.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.audit-trails.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.audit-trails.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.audit-trails.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
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
                <a href="{{ route('admin.panel.audit-trails.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.audit-trails.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.audit-trails.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.audit-trails.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Bizhub</span>
                </a>
                <a href="{{ route('admin.panel.websites.aktiviti.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.aktiviti.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.aktiviti.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.aktiviti.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">Aktiviti</span>
                </a>
                <a href="{{ route('admin.panel.websites.fasiliti.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl py-2.5 px-4 text-sm font-medium transition-all duration-200 @if (request()->routeIs('admin.panel.fasiliti.*')) bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-white shadow-lg shadow-[#132A13]/30 @else text-gray-700 hover:bg-[#F0F7F0] hover:text-[#132A13] @endif">
                    @if (request()->routeIs('admin.panel.fasiliti.*'))
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        </div>
                    @endif
                    <span
                        class="relative inline-flex h-5 w-5 items-center justify-center @if (request()->routeIs('admin.panel.fasiliti.*')) text-white @else text-gray-500 group-hover:text-[#132A13] @endif">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span class="relative">fasiliti</span>
                </a>
            </nav>
        </div>
        <div class="mt-6 px-3 pt-4 border-t border-gray-200">
            <div
                class="flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 px-3 py-2">
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
