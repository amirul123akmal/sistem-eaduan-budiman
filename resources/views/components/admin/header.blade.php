<header class="sticky top-0 z-30 w-full border-b bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/70">
	<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
		<div class="flex items-center gap-3">
			<button data-drawer-target="admin-sidebar" data-drawer-toggle="admin-sidebar" aria-controls="admin-sidebar" class="inline-flex items-center rounded-lg p-2 text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 lg:hidden">
				<span class="sr-only">Open sidebar</span>
				<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5h14a1 1 0 100-2H3a1 1 0 100 2zm14 4H3a1 1 0 000 2h14a1 1 0 100-2zm0 6H3a1 1 0 000 2h14a1 1 0 100-2z" clip-rule="evenodd"/></svg>
			</button>
			@php
				$user = auth()->user();
				$dashboardRoute = ($user && method_exists($user, 'hasRole') && $user->hasRole('Super Admin')) 
					? route('admin.dashboard') 
					: route('admin.panel.dashboard');
			@endphp
			<a href="{{ $dashboardRoute }}" class="flex items-center gap-2 text-gray-900">
				<svg class="h-6 w-6 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
				</svg>
				<span class="text-base font-semibold">e-Aduan Kg-Budiman</span>
			</a>
		</div>
		<div class="hidden flex-1 items-center justify-center px-6 lg:flex">
			<div class="relative w-full max-w-md">
				<input type="text" placeholder="Cari..." class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" />
				<span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
					<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
				</span>
			</div>
		</div>
		<div class="flex items-center gap-4">
			@php($authUser = auth()->user())
			<div class="flex items-center gap-3">
				@if($authUser && $authUser->profile_picture)
					<img src="{{ asset('storage/' . $authUser->profile_picture) }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover border" />
				@else
					<img src="{{ asset('images/default-avatar.svg') }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover border" />
				@endif
				<span class="hidden text-sm font-medium text-gray-700 sm:inline">{{ $authUser?->name }}</span>
			</div>
			<form method="POST" action="{{ route('logout') }}" id="logoutForm">
				@csrf
				<button type="submit" class="rounded-md bg-gray-900 px-3 py-2 text-xs font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">Log keluar</button>
			</form>
		</div>
	</div>
</header>

@push('scripts')
<script>
	// Handle logout confirmation with SweetAlert2
	document.getElementById('logoutForm')?.addEventListener('submit', function(e) {
		e.preventDefault();
		
		const form = this;
		
		Swal.fire({
			title: 'Adakah anda pasti?',
			text: 'Anda akan log keluar dari sistem.',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#dc2626',
			cancelButtonColor: '#6b7280',
			confirmButtonText: 'Ya, log keluar',
			cancelButtonText: 'Batal',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				// Show loading
				Swal.fire({
					title: 'Memproses...',
					text: 'Sila tunggu',
					allowOutsideClick: false,
					allowEscapeKey: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});
				
				// Submit form
				form.submit();
			}
		});
	});
</script>
@endpush
