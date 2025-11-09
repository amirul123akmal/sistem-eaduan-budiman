@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Tetapkan Peranan & Izin</h1>
				<p class="text-sm text-gray-600">Urus peranan dan kebenaran untuk admin ini</p>
			</div>
			<a href="{{ route('admin.admins.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
				<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
				Kembali
			</a>
		</div>
	</div>

	<div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-br from-[#F0F7F0] to-white p-6 shadow-lg">
		<div class="flex items-center gap-4">
			<div class="w-16 h-16 rounded-full bg-[#F0F7F0] flex items-center justify-center">
				<span class="text-2xl font-bold text-[#132A13]">{{ substr($admin->name, 0, 1) }}</span>
			</div>
			<div>
				<p class="text-sm font-semibold text-gray-500 mb-1">Pengguna</p>
				<p class="text-lg font-bold text-gray-900">{{ $admin->name }}</p>
				<p class="text-sm text-gray-600">{{ $admin->email }}</p>
			</div>
		</div>
	</div>

	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Peranan & Izin</h2>
					<p class="text-xs text-gray-600">Tetapkan peranan dan kebenaran granular untuk admin ini</p>
				</div>
			</div>
		</div>
		<form action="{{ route('admin.admins.permissions.update', $admin) }}" method="POST" class="p-6" id="permissionsForm">
			@csrf
			@method('PUT')

			<div class="grid gap-6 lg:grid-cols-3">
				<div class="lg:col-span-1">
					<label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
							Peranan <span class="text-red-500">*</span>
						</div>
					</label>
					<div class="relative">
						<select name="role" id="role-select" required class="mt-1 block w-full appearance-none rounded-xl border-2 border-gray-200 bg-white px-4 py-3 pr-10 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('role') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
							@foreach ($roles as $roleName => $label)
								<option value="{{ $roleName }}" @selected($currentRole === $roleName)>{{ $roleName }}</option>
							@endforeach
						</select>
						<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 mt-1">
							<svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
						</div>
					</div>
					@error('role')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
					<div class="mt-3 p-3 rounded-xl bg-blue-50 border border-blue-200">
						<p class="text-xs text-blue-800 flex items-start gap-2">
							<svg class="h-4 w-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
							Jika pilih "Super Admin", semua izin akan diberikan melalui peranan secara automatik.
						</p>
					</div>
				</div>

				<div class="lg:col-span-2">
					<label class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
							Izin (Granular)
						</div>
					</label>
					<div id="perm-list" class="grid grid-cols-1 gap-3 rounded-xl border-2 border-gray-200 bg-gray-50 p-6 sm:grid-cols-2">
						@foreach ($permissions as $perm)
							<label class="flex items-center gap-3 p-3 rounded-lg bg-white border border-gray-200 hover:bg-[#F0F7F0] hover:border-[#132A13] transition-all cursor-pointer">
								<input type="checkbox" name="permissions[]" value="{{ $perm }}" @checked(in_array($perm, $assignedPermissions)) class="rounded border-gray-300 text-[#132A13] focus:ring-[#132A13] cursor-pointer">
								<span class="text-sm font-medium text-gray-700">{{ $perm }}</span>
							</label>
						@endforeach
					</div>
				</div>
			</div>

			<div class="mt-8 flex items-center justify-end gap-3 border-t-2 border-gray-200 pt-6">
				<a href="{{ route('admin.admins.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
					Batal
				</a>
				<button type="submit" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
					<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
					<div class="relative flex items-center gap-2">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
						Simpan
					</div>
				</button>
			</div>
		</form>
	</div>

	@push('scripts')
	<script>
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
				if (disabled) {
					cb.closest('label').classList.add('opacity-50', 'cursor-not-allowed');
					cb.closest('label').classList.remove('hover:bg-[#F0F7F0]', 'hover:border-[#132A13]');
				} else {
					cb.closest('label').classList.remove('opacity-50', 'cursor-not-allowed');
					cb.closest('label').classList.add('hover:bg-[#F0F7F0]', 'hover:border-[#132A13]');
				}
			});
		});

		// Initialize on page load
		document.getElementById('role-select').dispatchEvent(new Event('change'));
	</script>
	@endpush
@endsection
