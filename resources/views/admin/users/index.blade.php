@extends('layouts.admin')

@section('content')
	<div class="mb-6 flex items-center justify-between">
		<h1 class="text-2xl font-semibold">Pengurusan Admin</h1>
		<a href="{{ route('admin.admins.create') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-gray-800">Tambah Admin</a>
	</div>


	<div class="overflow-hidden rounded-lg border bg-white">
		<table class="min-w-full divide-y divide-gray-200 text-sm">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-4 py-3 text-left font-medium">Nama</th>
					<th class="px-4 py-3 text-left font-medium">Email</th>
					<th class="px-4 py-3 text-left font-medium">Telefon</th>
					<th class="px-4 py-3 text-left font-medium">Jawatan</th>
					<th class="px-4 py-3 text-left font-medium">Peranan</th>
					<th class="px-4 py-3"></th>
				</tr>
			</thead>
			<tbody class="divide-y divide-gray-100">
				@foreach ($admins as $admin)
					<tr>
						<td class="px-4 py-3">{{ $admin->name }}</td>
						<td class="px-4 py-3">{{ $admin->email }}</td>
						<td class="px-4 py-3">{{ $admin->phone_number }}</td>
						<td class="px-4 py-3">{{ $admin->position }}</td>
						<td class="px-4 py-3">{{ $admin->roles->pluck('name')->join(', ') }}</td>
						<td class="px-4 py-3 text-right space-x-2">
							<a href="{{ route('admin.admins.permissions.edit', $admin) }}" class="rounded-md border px-3 py-1.5 text-xs hover:bg-gray-50">Peranan/Izin</a>
							<a href="{{ route('admin.admins.edit', $admin) }}" class="rounded-md border px-3 py-1.5 text-xs hover:bg-gray-50">Edit</a>
							<form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline delete-form" data-admin-name="{{ $admin->name }}" data-admin-email="{{ $admin->email }}">
								@csrf
								@method('DELETE')
								<button type="submit" class="rounded-md border px-3 py-1.5 text-xs text-red-600 hover:bg-red-50">Padam</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="mt-4">{{ $admins->links() }}</div>

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
