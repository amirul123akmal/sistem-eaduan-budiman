{{-- Mobile overlay --}}
<div id="admin-sidebar-backdrop" class="fixed inset-0 z-30 hidden bg-gray-900/50 transition-opacity duration-300 lg:hidden"></div>

<aside id="admin-sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r bg-white shadow-xl/10 ring-1 ring-gray-100 transition-transform lg:translate-x-0" aria-label="Sidebar" tabindex="-1">
	<div class="flex h-full flex-col justify-between overflow-y-auto px-4 py-6">
		<div>
			<div class="mb-6 px-3">
				<a href="{{ route('admin.panel.dashboard') }}" class="flex items-center justify-center">
					<img src="{{ asset('images/logoKgBudiman.png') }}" alt="JPKK Kampung Budiman" class="h-auto w-full max-w-[180px] object-contain" />
				</a>
			</div>
			<nav class="space-y-1">
				{{-- Dashboard --}}
				<a href="{{ route('admin.panel.dashboard') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.panel.dashboard')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.panel.dashboard')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
					</span>
					Dashboard
				</a>

				{{-- Profil --}}
				<a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('profile.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('profile.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
					</span>
					Profil
				</a>

				{{-- e-Aduan sahaja --}}
				<h3 class="mt-4 mb-2 px-3 pt-2 text-xs font-semibold uppercase tracking-wide text-gray-400">e-Aduan</h3>
				<a href="{{ route('admin.panel.complaints.index') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.panel.complaints.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.panel.complaints.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
					</span>
					Aduan
				</a>
				<a href="{{ route('admin.panel.complaint-types.index') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.panel.complaint-types.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.panel.complaint-types.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
					</span>
					Jenis Aduan
				</a>
				<a href="{{ route('admin.panel.audit-trails.index') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.panel.audit-trails.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.panel.audit-trails.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" clip-rule="evenodd"></path></svg>
					</span>
					Audit Trail
				</a>
			</nav>
		</div>
		<div class="px-3 text-xs text-gray-400">Version 1.0.0</div>
	</div>
	{{-- Close button for mobile --}}
	<button type="button" data-drawer-hide="admin-sidebar" aria-controls="admin-sidebar" class="absolute right-2.5 top-2.5 inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 lg:hidden">
		<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
		<span class="sr-only">Close menu</span>
	</button>
</aside>
