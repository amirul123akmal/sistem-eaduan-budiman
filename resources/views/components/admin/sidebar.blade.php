<aside id="admin-sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r bg-white shadow-xl/10 ring-1 ring-gray-100 transition-transform lg:translate-x-0" aria-label="Sidebar">
	<div class="flex h-full flex-col justify-between overflow-y-auto px-4 py-6">
		<div>
			<div class="mb-6 px-3 text-2xl font-bold text-indigo-700">Admin Panel</div>
			<nav class="space-y-1">
				{{-- Dashboard --}}
				<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.dashboard')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.dashboard')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/></svg>
					</span>
					Dashboard
				</a>

				{{-- Profil --}}
				<a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('profile.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('profile.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
					</span>
					Profil
				</a>

				{{-- Pentadbiran --}}
				<h3 class="mt-4 mb-2 px-3 pt-2 text-xs font-semibold uppercase tracking-wide text-gray-400">Pentadbiran</h3>
				<a href="{{ route('admin.admins.index') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.admins.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.admins.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
					</span>
					Pengurusan Admin
				</a>
				<a href="{{ route('admin.admins.create') }}" class="ml-8 block rounded-lg px-3 py-2 text-xs transition hover:bg-gray-50 @if(request()->routeIs('admin.admins.create')) bg-indigo-50 text-indigo-700 font-semibold @else text-gray-600 @endif">Tambah Admin</a>
				<a href="{{ route('admin.admins.index') }}" class="ml-8 block rounded-lg px-3 py-2 text-xs transition hover:bg-gray-50 @if(request()->routeIs('admin.admins.permissions.*')) bg-indigo-50 text-indigo-700 font-semibold @else text-gray-600 @endif">Peranan & Izin (Admin)</a>

				<a href="{{ route('admin.roles.index') }}" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm transition hover:bg-gray-50 @if(request()->routeIs('admin.roles.*')) bg-indigo-50 text-indigo-700 font-semibold border-l-4 border-indigo-500 @else text-gray-700 @endif">
					<span class="inline-flex h-5 w-5 items-center justify-center @if(request()->routeIs('admin.roles.*')) text-indigo-600 @else text-gray-500 @endif">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
					</span>
					Peranan
				</a>
				<a href="{{ route('admin.permissions.index') }}" class="ml-8 block rounded-lg px-3 py-2 text-xs transition hover:bg-gray-50 @if(request()->routeIs('admin.permissions.*')) bg-indigo-50 text-indigo-700 font-semibold @else text-gray-600 @endif">Kebenaran</a>

				{{-- e-Aduan --}}
				<h3 class="mt-4 mb-2 px-3 pt-2 text-xs font-semibold uppercase tracking-wide text-gray-400">e-Aduan</h3>
				<a href="#" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm text-gray-700 transition hover:bg-gray-50">
					<span class="inline-flex h-5 w-5 items-center justify-center text-gray-500">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8a9 9 0 110-18 9 9 0 010 18z"/></svg>
					</span>
					Aduan
				</a>
				<a href="#" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm text-gray-700 transition hover:bg-gray-50">
					<span class="inline-flex h-5 w-5 items-center justify-center text-gray-500">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v6m14 0l-2 9H6l-2-9m16 0H4"/></svg>
					</span>
					Jenis Aduan
				</a>
				<a href="#" class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm text-gray-700 transition hover:bg-gray-50">
					<span class="inline-flex h-5 w-5 items-center justify-center text-gray-500">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066z"/></svg>
					</span>
					Tetapan
				</a>
			</nav>
		</div>
		<div class="px-3 text-xs text-gray-400">Version 1.0.0</div>
	</div>
</aside>
