@extends('layouts.admin')

@section('content')
	<h1 class="mb-6 text-2xl font-semibold">Tetapkan Peranan & Izin</h1>

	<div class="mb-4 rounded border bg-white p-4 text-sm">
		<p><span class="font-medium">Pengguna:</span> {{ $admin->name }} ({{ $admin->email }})</p>
	</div>

	<form action="{{ route('admin.admins.permissions.update', $admin) }}" method="POST" class="grid gap-6 lg:grid-cols-3">
		@csrf
		@method('PUT')

		<div class="space-y-4 lg:col-span-1">
			<div>
				<label class="mb-1 block text-sm font-medium">Peranan</label>
				<select name="role" id="role-select" class="w-full rounded border px-3 py-2 text-sm">
					@foreach ($roles as $roleName => $label)
						<option value="{{ $roleName }}" @selected($currentRole === $roleName)>{{ $roleName }}</option>
					@endforeach
				</select>
				@error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
			</div>
			<p class="text-xs text-gray-500">Jika pilih "Super Admin", semua izin akan diberikan melalui peranan secara automatik.</p>
		</div>

		<div class="lg:col-span-2">
			<label class="mb-2 block text-sm font-medium">Izin (granular)</label>
			<div id="perm-list" class="grid grid-cols-1 gap-2 rounded border bg-white p-4 sm:grid-cols-2">
				@foreach ($permissions as $perm)
					<label class="flex items-center gap-2 text-sm">
						<input type="checkbox" name="permissions[]" value="{{ $perm }}" @checked(in_array($perm, $assignedPermissions)) class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
						<span>{{ $perm }}</span>
					</label>
				@endforeach
			</div>
		</div>

		<div class="lg:col-span-3 flex items-center gap-3">
			<button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">Simpan</button>
			<a href="{{ route('admin.admins.index') }}" class="text-sm">Kembali</a>
		</div>
	</form>

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
			}).then(() => {
				window.location.href = '{{ route('admin.admins.index') }}';
			});
		@endif

		@if ($errors->any())
			Swal.fire({
				icon: 'error',
				title: 'Ralat Pengesahan!',
				html: '<ul class="text-left list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
				confirmButtonColor: '#dc2626'
			});
		@endif

		// Role select change handler
		document.getElementById('role-select').addEventListener('change', function () {
			const disabled = this.value === 'Super Admin';
			document.querySelectorAll('#perm-list input[type="checkbox"]').forEach(cb => {
				cb.disabled = disabled;
			});
		});
	</script>
	@endpush
@endsection
