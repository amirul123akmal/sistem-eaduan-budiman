@extends('layouts.admin')

@section('content')
	<h1 class="mb-6 text-2xl font-semibold">Tambah Admin</h1>

	<form action="{{ route('admin.admins.store') }}" method="POST" class="max-w-2xl space-y-4">
		@csrf

		<div>
			<label class="mb-1 block text-sm font-medium">Nama</label>
			<input name="name" value="{{ old('name') }}" class="w-full rounded border px-3 py-2 text-sm" />
			@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
		</div>

		<div class="grid gap-4 sm:grid-cols-2">
			<div>
				<label class="mb-1 block text-sm font-medium">Telefon</label>
				<input name="phone_number" value="{{ old('phone_number') }}" class="w-full rounded border px-3 py-2 text-sm" />
				@error('phone_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
			</div>
			<div>
				<label class="mb-1 block text-sm font-medium">Jawatan</label>
				<input name="position" value="{{ old('position') }}" class="w-full rounded border px-3 py-2 text-sm" />
				@error('position')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
			</div>
		</div>

		<div>
			<label class="mb-1 block text-sm font-medium">Email</label>
			<input type="email" name="email" value="{{ old('email') }}" class="w-full rounded border px-3 py-2 text-sm" />
			@error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
		</div>

		<div class="grid gap-4 sm:grid-cols-2">
			<div>
				<label class="mb-1 block text-sm font-medium">Kata Laluan</label>
				<input type="password" name="password" class="w-full rounded border px-3 py-2 text-sm" />
				@error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
			</div>
			<div>
				<label class="mb-1 block text-sm font-medium">Peranan</label>
				<select name="role" class="w-full rounded border px-3 py-2 text-sm">
					<option value="Super Admin" @selected(old('role')==='Super Admin')>Super Admin</option>
					<option value="Admin" @selected(old('role')==='Admin')>Admin</option>
				</select>
				@error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
			</div>
		</div>

		<div class="flex items-center gap-3 pt-2">
			<button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">Simpan</button>
			<a href="{{ route('admin.admins.index') }}" class="text-sm">Batal</a>
		</div>
	</form>
@endsection
