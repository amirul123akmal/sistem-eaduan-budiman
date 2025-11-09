<header class="sticky top-0 z-30 w-full border-b border-gray-200 bg-white/95 backdrop-blur-md shadow-sm supports-[backdrop-filter]:bg-white/90">
	<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5">
		<div class="flex items-center gap-3">
			<button data-drawer-target="admin-sidebar" data-drawer-toggle="admin-sidebar" aria-controls="admin-sidebar" class="inline-flex items-center rounded-xl p-2.5 text-gray-600 hover:bg-[#F0F7F0] hover:text-[#132A13] focus:outline-none focus:ring-2 focus:ring-[#132A13] transition-all lg:hidden">
				<span class="sr-only">Open sidebar</span>
				<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5h14a1 1 0 100-2H3a1 1 0 100 2zm14 4H3a1 1 0 000 2h14a1 1 0 100-2zm0 6H3a1 1 0 000 2h14a1 1 0 100-2z" clip-rule="evenodd"/></svg>
			</button>
			@php
				$user = auth()->user();
				$dashboardRoute = ($user && method_exists($user, 'hasRole') && $user->hasRole('Super Admin')) 
					? route('admin.dashboard') 
					: route('admin.panel.dashboard');
			@endphp
			<a href="{{ $dashboardRoute }}" class="group flex items-center gap-2.5 text-gray-900 transition-transform duration-200 hover:scale-105">
				<div class="relative">
					<div class="absolute inset-0 bg-[#132A13]/10 rounded-xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
					<div class="relative flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] shadow-lg shadow-[#132A13]/30">
						<svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
						</svg>
					</div>
				</div>
				<span class="text-base font-bold bg-gradient-to-r from-[#132A13] to-[#2F4F2F] bg-clip-text text-transparent">e-Aduan Kg-Budiman</span>
			</a>
		</div>
		<div class="hidden flex-1 items-center justify-center px-6 lg:flex">
			<div class="relative w-full max-w-md">
				<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
					<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
				</div>
				<input type="text" placeholder="Cari aduan, admin, atau lain-lain..." class="w-full pl-12 pr-4 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-sm outline-none transition-all focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 hover:border-gray-300" />
			</div>
		</div>
		<div class="flex items-center gap-3">
			@php
				$authUser = auth()->user();
				$roleLabel = 'Admin'; // Default value
				if($authUser && method_exists($authUser, 'hasRole')) {
					if($authUser->hasRole('Super Admin')) {
						$roleLabel = 'Super Admin';
					} elseif($authUser->hasRole('Admin')) {
						$roleLabel = 'Admin';
					}
				}
			@endphp
			<div class="hidden sm:flex items-center gap-3 px-3 py-2 rounded-xl bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border border-[#F0F7F0]">
				<div class="relative">
					@if($authUser && $authUser->profile_picture)
						<img src="{{ asset('storage/' . $authUser->profile_picture) }}" alt="Avatar" class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-md ring-2 ring-[#F0F7F0]" />
					@else
						<img src="{{ asset('images/default-avatar.svg') }}" alt="Avatar" class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-md ring-2 ring-[#F0F7F0]" />
					@endif
					<div class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-green-500 border-2 border-white"></div>
				</div>
				<div class="flex flex-col">
					<span class="text-sm font-semibold text-gray-900">{{ $authUser?->name }}</span>
					{{-- <span class="text-xs font-medium text-indigo-600">{{ $roleLabel }}</span> --}}
				</div>
			</div>
			<form method="POST" action="{{ route('logout') }}" id="logoutForm">
				@csrf
				<button type="submit" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-600 to-red-700 px-4 py-2.5 text-xs font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
					<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
					<div class="relative flex items-center gap-2">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
						Log keluar
					</div>
				</button>
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
