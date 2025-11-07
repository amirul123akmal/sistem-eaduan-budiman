@extends('layouts.admin')

@section('content')
	<h1 class="mb-6 text-2xl font-semibold">Edit Peranan</h1>

	<form action="{{ route('admin.roles.update', $role) }}" method="POST" class="grid gap-6 lg:grid-cols-3">
		@csrf
		@method('PUT')
		<div class="space-y-4 lg:col-span-1">
			<label class="mb-1 block text-sm font-medium">Nama Peranan</label>
			<input name="name" value="{{ old('name', $role->name) }}" class="w-full rounded border px-3 py-2 text-sm" />
			@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
		</div>
		<div class="lg:col-span-2">
			<label class="mb-2 block text-sm font-medium">Izin</label>
			<div class="grid grid-cols-1 gap-2 rounded border bg-white p-4 sm:grid-cols-2">
				@foreach ($permissions as $perm)
					<label class="flex items-center gap-2 text-sm">
						<input type="checkbox" name="permissions[]" value="{{ $perm }}" @checked(in_array($perm, $assigned)) class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
						<span>{{ $perm }}</span>
					</label>
				@endforeach
			</div>
		</div>
		<div class="lg:col-span-3 flex items-center gap-3">
			<button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">Simpan</button>
			<a href="{{ route('admin.roles.index') }}" class="text-sm">Kembali</a>
		</div>
	</form>
@endsection
