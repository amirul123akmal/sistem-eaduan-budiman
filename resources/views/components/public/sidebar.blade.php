{{-- Mobile overlay --}}
<div id="public-sidebar-backdrop" class="fixed inset-0 z-30 hidden bg-gray-900/50 transition-opacity duration-300 lg:hidden"></div>

<aside id="public-sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r bg-white shadow-xl/10 ring-1 ring-gray-100 transition-transform lg:translate-x-0" aria-label="Sidebar" tabindex="-1">
	<div class="flex h-full flex-col justify-between overflow-y-auto px-4 py-6">
		<div>
			<div class="mb-6 px-3">
				<a href="{{ route('public.home') }}" class="flex items-center justify-center">
					<img src="{{ asset('images/logoKgBudiman.png') }}" alt="JPKK Kampung Budiman" class="h-auto w-full max-w-[180px] object-contain" />
				</a>
			</div>
			<nav class="space-y-1">
				{{-- Laman Utama --}}
				<a href="{{ route('public.home') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('public.home')) bg-green-50 text-green-700 font-semibold border-l-4 border-green-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('public.home')) text-green-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
					</span>
					Laman Utama
				</a>

				{{-- e-Aduan --}}
				<h3 class="mt-4 mb-2 px-3 pt-2 text-xs font-semibold uppercase tracking-wide text-gray-400">e-Aduan</h3>
				
				<a href="{{ route('public.complaint.create') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('public.complaint.*')) bg-green-50 text-green-700 font-semibold border-l-4 border-green-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('public.complaint.*')) text-green-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
					</span>
					Tambah Aduan
				</a>
				
				<a href="{{ route('public.status.check') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('public.status.*')) bg-green-50 text-green-700 font-semibold border-l-4 border-green-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('public.status.*')) text-green-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
					</span>
					Semak Status
				</a>
			</nav>
		</div>
		<div class="px-3 text-xs text-gray-400">Version 1.0.0</div>
	</div>
	{{-- Close button for mobile --}}
	<button type="button" data-drawer-hide="public-sidebar" aria-controls="public-sidebar" class="absolute right-2.5 top-2.5 inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 lg:hidden">
		<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
		<span class="sr-only">Close menu</span>
	</button>
</aside>

