@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Jenis Aduan</h1>
				<p class="text-sm text-gray-600">Urus dan kelola jenis-jenis aduan yang tersedia dalam sistem</p>
			</div>
			@php
				$user = auth()->user();
				$hasCreatePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('create complaint types'));
			@endphp
			@if($hasCreatePermission)
				<a href="{{ route($isAdminPanel ? 'admin.panel.complaint-types.create' : 'admin.complaint-types.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-5 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
					<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
					<div class="relative flex items-center gap-2">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
						Tambah Jenis Aduan
					</div>
				</a>
			@else
				<div class="flex items-center gap-2 rounded-xl border-2 border-gray-300 bg-gray-50 px-5 py-2.5 text-sm font-semibold text-gray-500 cursor-not-allowed opacity-60" title="Anda tidak mempunyai kebenaran untuk menambah jenis aduan">
					<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
					Tambah Jenis Aduan
					<span class="ml-1 text-xs text-red-600 font-bold">(Tiada Kebenaran)</span>
				</div>
			@endif
		</div>
	</div>


	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
		@if($complaintTypes->count() > 0)
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">No.</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama Jenis</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Penerangan</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Dicipta</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					@foreach ($complaintTypes as $index => $type)
						<tr class="hover:bg-[#F0F7F0]/50 transition-colors">
							<td class="whitespace-nowrap px-6 py-4">
								<span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#F0F7F0] text-[#132A13] font-bold text-sm">
									{{ $loop->iteration }}
								</span>
							</td>
							<td class="whitespace-nowrap px-6 py-4">
								<div class="flex items-center gap-3">
									<div class="w-10 h-10 rounded-lg bg-[#F0F7F0] flex items-center justify-center">
										<svg class="h-5 w-5 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
									</div>
									<span class="text-sm font-semibold text-gray-900">{{ $type->type_name }}</span>
								</div>
							</td>
							<td class="px-6 py-4">
								<div class="text-sm text-gray-600 max-w-md">
									{{ $type->description ? \Illuminate\Support\Str::limit($type->description, 80) : '-' }}
								</div>
							</td>
							<td class="whitespace-nowrap px-6 py-4">
								<div class="flex items-center gap-2 text-sm text-gray-600">
									<svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
									{{ $type->created_at->format('d/m/Y') }}
								</div>
							</td>
							<td class="whitespace-nowrap px-6 py-4 text-right">
								@php
									$user = auth()->user();
									$hasEditPermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('edit complaint types'));
									$hasDeletePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('delete complaint types'));
								@endphp
								<div class="flex items-center justify-end gap-2">
									@if($hasEditPermission)
										<a href="{{ route($isAdminPanel ? 'admin.panel.complaint-types.edit' : 'admin.complaint-types.edit', $type) }}" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition-all duration-300 hover:shadow-md hover:scale-105 transform">
											<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
											<div class="relative flex items-center gap-1.5">
												<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
												Edit
											</div>
										</a>
									@else
										<span class="rounded-lg border-2 border-gray-200 bg-gray-50 px-3 py-1.5 text-xs font-semibold text-gray-400 cursor-not-allowed opacity-60" title="Anda tidak mempunyai kebenaran untuk mengemaskini jenis aduan">
											<div class="flex items-center gap-1.5">
												<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
												Edit
											</div>
										</span>
									@endif
									@if($hasDeletePermission)
										<form action="{{ route($isAdminPanel ? 'admin.panel.complaint-types.destroy' : 'admin.complaint-types.destroy', $type) }}" method="POST" class="inline delete-form" data-type-name="{{ $type->type_name }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-red-600 to-red-700 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition-all duration-300 hover:shadow-md hover:scale-105 transform">
												<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
												<div class="relative flex items-center gap-1.5">
													<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
													Padam
												</div>
											</button>
										</form>
									@else
										<span class="rounded-lg border-2 border-gray-200 bg-gray-50 px-3 py-1.5 text-xs font-semibold text-gray-400 cursor-not-allowed opacity-60" title="Anda tidak mempunyai kebenaran untuk memadam jenis aduan">
											<div class="flex items-center gap-1.5">
												<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
												Padam
											</div>
										</span>
									@endif
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
				<h3 class="text-base font-semibold text-gray-900 mb-1">Tiada jenis aduan</h3>
				<p class="text-sm text-gray-500 mb-4">Mula dengan menambah jenis aduan baharu.</p>
				@php
					$user = auth()->user();
					$hasCreatePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('create complaint types'));
				@endphp
				@if($hasCreatePermission)
					<a href="{{ route($isAdminPanel ? 'admin.panel.complaint-types.create' : 'admin.complaint-types.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
						Tambah Jenis Aduan
					</a>
				@endif
			</div>
		@endif
	</div>

	@if($complaintTypes->hasPages())
		<div class="mt-4">{{ $complaintTypes->links() }}</div>
	@endif

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
				const typeName = form.getAttribute('data-type-name');
				
				Swal.fire({
					title: 'Adakah anda pasti?',
					text: `Jenis aduan "${typeName}" akan dipadam secara kekal!`,
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
									throw new Error(data.message || 'Tidak dapat memadam jenis aduan.');
								});
							}
						})
						.then(data => {
							if (data.success) {
								Swal.fire({
									icon: 'success',
									title: 'Berjaya!',
									text: data.message || 'Jenis aduan berjaya dipadam.',
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
									text: data.message || 'Tidak dapat memadam jenis aduan.',
									confirmButtonColor: '#dc2626'
								});
							}
						})
						.catch(error => {
							console.error('Error:', error);
							Swal.fire({
								icon: 'error',
								title: 'Ralat!',
								text: error.message || 'Tidak dapat memadam jenis aduan. Sila cuba lagi.',
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

