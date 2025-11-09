@extends('layouts.admin')

@section('content')
	<div class="mb-6 flex items-center justify-between">
		<h1 class="text-2xl font-semibold text-gray-900">Aduan</h1>
		@php
			$user = auth()->user();
			$hasCreatePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('create complaints'));
		@endphp
		@if($hasCreatePermission)
			<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.create' : 'admin.complaints.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
				<svg class="mr-2 inline h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
				Tambah Aduan
			</a>
		@else
			<div class="flex items-center gap-2 rounded-md border border-gray-300 bg-gray-50 px-4 py-2 text-sm text-gray-500 cursor-not-allowed" title="Anda tidak mempunyai kebenaran untuk menambah aduan">
				<svg class="mr-2 inline h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
				Tambah Aduan
				<span class="ml-1 text-xs text-red-600">(Tiada Kebenaran)</span>
			</div>
		@endif
	</div>


	{{-- Filters --}}
	<div class="mb-6 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
		<form method="GET" action="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}" class="grid gap-4 md:grid-cols-4">
			<div>
				<label class="mb-1 block text-xs font-medium text-gray-700">Cari</label>
				<input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, telefon, atau penerangan..." class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
			</div>
			<div>
				<label class="mb-1 block text-xs font-medium text-gray-700">Status</label>
				<select name="status" class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					<option value="">Semua Status</option>
					@foreach($statuses as $status)
						<option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
							{{ ucfirst($status) }}
						</option>
					@endforeach
				</select>
			</div>
			<div>
				<label class="mb-1 block text-xs font-medium text-gray-700">Jenis Aduan</label>
				<select name="complaint_type_id" class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					<option value="">Semua Jenis</option>
					@foreach($complaintTypes as $type)
						<option value="{{ $type->id }}" {{ request('complaint_type_id') == $type->id ? 'selected' : '' }}>
							{{ $type->type_name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="flex items-end gap-2">
				<button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Cari</button>
				<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Reset</a>
			</div>
		</form>
	</div>

	<div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
		@if($complaints->count() > 0)
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No.</th>
						<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama</th>
						<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jenis Aduan</th>
						<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
						<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tarikh</th>
						<th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Tindakan</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					@foreach ($complaints as $complaint)
						<tr class="hover:bg-gray-50">
							<td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
							<td class="px-6 py-4">
								<div class="text-sm font-medium text-gray-900">{{ $complaint->name }}</div>
								<div class="text-xs text-gray-500">{{ $complaint->phone_number }}</div>
							</td>
							<td class="px-6 py-4 text-sm text-gray-500">{{ $complaint->complaintType->type_name ?? '-' }}</td>
							<td class="whitespace-nowrap px-6 py-4">
								@php
									$statusColors = [
										'menunggu' => 'bg-yellow-100 text-yellow-800',
										'diterima' => 'bg-blue-100 text-blue-800',
										'ditolak' => 'bg-red-100 text-red-800',
										'selesai' => 'bg-green-100 text-green-800',
									];
									$color = $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800';
								@endphp
								<span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $color }}">
									{{ ucfirst($complaint->status) }}
								</span>
							</td>
							<td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
								{{ $complaint->created_at->format('d/m/Y H:i') }}
							</td>
							<td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
									@php
										$user = auth()->user();
										$hasEditPermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('edit complaints'));
										$hasDeletePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('delete complaints'));
									@endphp
								<div class="flex items-center justify-end gap-2">
									<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.show' : 'admin.complaints.show', $complaint) }}" class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs text-gray-700 shadow-sm hover:bg-gray-50">
										<svg class="mr-1 inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
										Lihat
									</a>
									@if($hasEditPermission)
										<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.edit' : 'admin.complaints.edit', $complaint) }}" class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs text-gray-700 shadow-sm hover:bg-gray-50">
											<svg class="mr-1 inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
											Edit
										</a>
									@else
										<span class="rounded-md border border-gray-200 bg-gray-50 px-3 py-1.5 text-xs text-gray-400 cursor-not-allowed" title="Anda tidak mempunyai kebenaran untuk mengemaskini aduan">
											<svg class="mr-1 inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
											Edit
										</span>
									@endif
									@if($hasDeletePermission)
										<form action="{{ route($isAdminPanel ? 'admin.panel.complaints.destroy' : 'admin.complaints.destroy', $complaint) }}" method="POST" class="inline delete-form" data-complaint-name="{{ $complaint->name }}" data-complaint-id="#{{ $complaint->id }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="rounded-md border border-red-300 bg-white px-3 py-1.5 text-xs text-red-600 shadow-sm hover:bg-red-50">
												<svg class="mr-1 inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
												Padam
											</button>
										</form>
									@else
										<span class="rounded-md border border-gray-200 bg-gray-50 px-3 py-1.5 text-xs text-gray-400 cursor-not-allowed" title="Anda tidak mempunyai kebenaran untuk memadam aduan">
											<svg class="mr-1 inline h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
											Padam
										</span>
									@endif
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="px-6 py-12 text-center">
				<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8a9 9 0 110-18 9 9 0 010 18z"></path>
				</svg>
				<h3 class="mt-2 text-sm font-medium text-gray-900">Tiada aduan</h3>
				<p class="mt-1 text-sm text-gray-500">Mula dengan menambah aduan baharu.</p>
						@php
							$user = auth()->user();
							$hasCreatePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('create complaints'));
						@endphp
				@if($hasCreatePermission)
					<div class="mt-6">
						<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.create' : 'admin.complaints.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
							<svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
							Tambah Aduan
						</a>
					</div>
				@endif
			</div>
		@endif
	</div>

	@if($complaints->hasPages())
		<div class="mt-4">{{ $complaints->appends(request()->query())->links() }}</div>
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
				const complaintName = form.getAttribute('data-complaint-name');
				const complaintId = form.getAttribute('data-complaint-id');
				
				Swal.fire({
					title: 'Adakah anda pasti?',
					text: `Aduan ${complaintId} - "${complaintName}" akan dipadam secara kekal!`,
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
									throw new Error(data.message || 'Tidak dapat memadam aduan.');
								});
							}
						})
						.then(data => {
							if (data.success) {
								Swal.fire({
									icon: 'success',
									title: 'Berjaya!',
									text: data.message || 'Aduan berjaya dipadam.',
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
									text: data.message || 'Tidak dapat memadam aduan.',
									confirmButtonColor: '#dc2626'
								});
							}
						})
						.catch(error => {
							console.error('Error:', error);
							Swal.fire({
								icon: 'error',
								title: 'Ralat!',
								text: error.message || 'Tidak dapat memadam aduan. Sila cuba lagi.',
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

