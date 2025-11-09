@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Pengurusan Admin</h1>
				<p class="text-sm text-gray-600">Urus maklumat dan kebenaran admin sistem</p>
			</div>
			<a href="{{ route('admin.admins.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
				<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
				<div class="relative flex items-center gap-2">
					<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
					Tambah Admin
				</div>
			</a>
		</div>
	</div>

	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Senarai Admin</h2>
					<p class="text-xs text-gray-600">Semua admin yang didaftarkan dalam sistem</p>
				</div>
			</div>
		</div>
		<div class="overflow-x-auto">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Email</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Telefon</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Jawatan</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Peranan</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					@foreach ($admins as $admin)
						<tr class="hover:bg-[#F0F7F0]/50 transition-colors">
							<td class="whitespace-nowrap px-6 py-4">
								<div class="flex items-center gap-3">
									<div class="w-10 h-10 rounded-full bg-[#F0F7F0] flex items-center justify-center">
										<span class="text-sm font-bold text-[#132A13]">{{ substr($admin->name, 0, 1) }}</span>
									</div>
									<span class="text-sm font-semibold text-gray-900">{{ $admin->name }}</span>
								</div>
							</td>
							<td class="px-6 py-4">
								<span class="text-sm text-gray-700">{{ $admin->email }}</span>
							</td>
							<td class="px-6 py-4">
								<span class="text-sm text-gray-700">{{ $admin->phone_number ?? '-' }}</span>
							</td>
							<td class="px-6 py-4">
								<span class="text-sm text-gray-700">{{ $admin->position ?? '-' }}</span>
							</td>
							<td class="px-6 py-4">
								@php
									$roleNames = $admin->roles->pluck('name');
									$isSuperAdmin = $roleNames->contains('Super Admin');
								@endphp
								@foreach($roleNames as $roleName)
									<span class="inline-flex items-center gap-1.5 rounded-full border-2 px-3 py-1 text-xs font-bold {{ $isSuperAdmin ? 'bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 border-purple-300' : 'bg-[#F0F7F0] text-[#132A13] border-[#132A13]' }}">
										@if($isSuperAdmin)
											<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
										@endif
										{{ $roleName }}
									</span>
								@endforeach
							</td>
							<td class="whitespace-nowrap px-6 py-4 text-right">
								<div class="flex items-center justify-end gap-2">
									<a href="{{ route('admin.admins.permissions.edit', $admin) }}" class="inline-flex items-center gap-1 rounded-lg bg-[#F0F7F0] px-3 py-1.5 text-xs font-semibold text-[#132A13] shadow-sm hover:bg-[#F0F7F0]/80 transition-all">
										<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
										Peranan/Izin
									</a>
									<a href="{{ route('admin.admins.edit', $admin) }}" class="inline-flex items-center gap-1 rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm hover:bg-blue-200 transition-all">
										<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
										Edit
									</a>
									<form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline delete-form" data-admin-name="{{ $admin->name }}" data-admin-email="{{ $admin->email }}">
										@csrf
										@method('DELETE')
										<button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 shadow-sm hover:bg-red-200 transition-all">
											<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
											Padam
										</button>
									</form>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="mt-6">{{ $admins->links() }}</div>

	@push('scripts')
	<script>
		// Show success/error messages from session
		@if (session('success'))
			Swal.fire({
				icon: 'success',
				title: 'Berjaya!',
				text: '{{ session('success') }}',
				confirmButtonColor: '#4f46e5',
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

		// Handle delete confirmation with SweetAlert2
		document.querySelectorAll('.delete-form').forEach(form => {
			form.addEventListener('submit', function(e) {
				e.preventDefault();
				
				const form = this;
				const adminName = form.getAttribute('data-admin-name');
				const adminEmail = form.getAttribute('data-admin-email');
				
				Swal.fire({
					title: 'Adakah anda pasti?',
					html: `Admin <strong>${adminName}</strong><br><span class="text-sm text-gray-600">${adminEmail}</span><br><br>Akan dipadam secara kekal!`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#dc2626',
					cancelButtonColor: '#6b7280',
					confirmButtonText: 'Ya, padam!',
					cancelButtonText: 'Batal',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						// Show loading
						Swal.fire({
							title: 'Memadam...',
							text: 'Sila tunggu',
							allowOutsideClick: false,
							allowEscapeKey: false,
							didOpen: () => {
								Swal.showLoading();
							}
						});

						// Submit form via AJAX
						const formData = new FormData();
						formData.append('_method', 'DELETE');
						formData.append('_token', form.querySelector('input[name="_token"]').value);

						fetch(form.action, {
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('input[name="_token"]').value,
								'X-Requested-With': 'XMLHttpRequest',
								'Accept': 'application/json'
							},
							body: formData
						})
						.then(response => {
							if (response.ok) {
								return response.json();
							} else {
								return response.json().then(data => {
									throw new Error(data.message || 'Tidak dapat memadam admin.');
								});
							}
						})
						.then(data => {
							if (data.success) {
								Swal.fire({
									icon: 'success',
									title: 'Berjaya!',
									text: data.message || 'Admin berjaya dipadam.',
									confirmButtonColor: '#4f46e5',
									timer: 2000,
									timerProgressBar: true
								}).then(() => {
									location.reload();
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Ralat!',
									text: data.message || 'Tidak dapat memadam admin.',
									confirmButtonColor: '#dc2626'
								});
							}
						})
						.catch(error => {
							console.error('Error:', error);
							Swal.fire({
								icon: 'error',
								title: 'Ralat!',
								text: error.message || 'Tidak dapat memadam admin. Sila cuba lagi.',
								confirmButtonColor: '#dc2626'
							});
						});
					}
				});
			});
		});
	</script>
	@endpush
@endsection
