@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Izin</h1>
				<p class="text-sm text-gray-600">Urus kebenaran granular dalam sistem</p>
			</div>
			<a href="{{ route('admin.permissions.create') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
				<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
				<div class="relative flex items-center gap-2">
					<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
					Tambah Izin
				</div>
			</a>
		</div>
	</div>

	@if (session('status'))
		<div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
			<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
			{{ session('status') }}
		</div>
	@endif

	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Senarai Izin</h2>
					<p class="text-xs text-gray-600">Semua kebenaran yang didaftarkan dalam sistem</p>
				</div>
			</div>
		</div>
		<div class="overflow-x-auto">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					@foreach ($permissions as $permission)
						<tr class="hover:bg-[#F0F7F0]/50 transition-colors">
							<td class="whitespace-nowrap px-6 py-4">
								<div class="flex items-center gap-3">
									<div class="w-10 h-10 rounded-full bg-[#F0F7F0] flex items-center justify-center">
										<svg class="h-5 w-5 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
									</div>
									<span class="text-sm font-semibold text-gray-900">{{ $permission->name }}</span>
								</div>
							</td>
							<td class="whitespace-nowrap px-6 py-4 text-right">
								<div class="flex items-center justify-end gap-2">
									<a href="{{ route('admin.permissions.edit', $permission) }}" class="inline-flex items-center gap-1 rounded-lg bg-blue-100 px-3 py-1.5 text-xs font-semibold text-blue-700 shadow-sm hover:bg-blue-200 transition-all">
										<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
										Edit
									</a>
									<form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="inline delete-permission-form" data-permission-name="{{ $permission->name }}">
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

	<div class="mt-6">{{ $permissions->links() }}</div>

	@push('scripts')
	<script>
		// Handle delete confirmation with SweetAlert2
		document.querySelectorAll('.delete-permission-form').forEach(form => {
			form.addEventListener('submit', function(e) {
				e.preventDefault();
				
				const form = this;
				const permissionName = form.getAttribute('data-permission-name');
				
				Swal.fire({
					title: 'Adakah anda pasti?',
					html: `Izin <strong>${permissionName}</strong> akan dipadam secara kekal!`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#dc2626',
					cancelButtonColor: '#6b7280',
					confirmButtonText: 'Ya, padam!',
					cancelButtonText: 'Batal',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						form.submit();
					}
				});
			});
		});
	</script>
	@endpush
@endsection
