@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Kemaskini Admin</h1>
				<p class="text-sm text-gray-600">ID Admin: #{{ $admin->id }}</p>
			</div>
			<a href="{{ route('admin.admins.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
				<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
				Kembali
			</a>
		</div>
	</div>

	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Kemaskini Maklumat</h2>
					<p class="text-xs text-gray-600">Ubah maklumat admin di bawah</p>
				</div>
			</div>
		</div>
		<form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="p-6" id="adminForm" novalidate>
			@csrf
			@method('PUT')

			<div class="grid gap-6 md:grid-cols-2">
				<div>
					<label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
							Nama <span class="text-red-500">*</span>
						</div>
					</label>
					<input name="name" id="name" value="{{ old('name', $admin->name) }}" required class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" />
					@error('name')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
				</div>

				<div>
					<label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
							Email <span class="text-red-500">*</span>
						</div>
					</label>
					<input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" />
					@error('email')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
				</div>

				<div>
					<label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
							Telefon
						</div>
					</label>
					<input name="phone_number" id="phone_number" value="{{ old('phone_number', $admin->phone_number) }}" class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('phone_number') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" />
					@error('phone_number')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
				</div>

				<div>
					<label for="position" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>
							Jawatan
						</div>
					</label>
					<input name="position" id="position" value="{{ old('position', $admin->position) }}" class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('position') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" />
					@error('position')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
				</div>

				<div>
					<label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
							Kata Laluan
						</div>
					</label>
					<input type="password" name="password" id="password" class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('password') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" />
					<p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
						<svg class="h-3 w-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
						Biarkan kosong jika tidak mahu menukar kata laluan
					</p>
					@error('password')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
				</div>

				<div>
					<label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
							Peranan <span class="text-red-500">*</span>
						</div>
					</label>
					<div class="relative">
						<select name="role" id="role" required class="mt-1 block w-full appearance-none rounded-xl border-2 border-gray-200 bg-white px-4 py-3 pr-10 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('role') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror">
							<option value="">Pilih Peranan</option>
							<option value="Super Admin" @selected(old('role', $admin->roles->pluck('name')->first())==='Super Admin')>Super Admin</option>
							<option value="Admin" @selected(old('role', $admin->roles->pluck('name')->first())==='Admin')>Admin</option>
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
						Kemaskini
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
	</script>
	@endpush
@endsection
