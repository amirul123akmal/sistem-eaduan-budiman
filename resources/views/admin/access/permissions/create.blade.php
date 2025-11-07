@extends('layouts.admin')

@section('content')
	<h1 class="mb-6 text-2xl font-semibold">Tambah Izin</h1>
	<form action="{{ route('admin.permissions.store') }}" method="POST" class="max-w-md space-y-4">
		@csrf
		<div>
			<label class="mb-1 block text-sm font-medium">Nama Izin</label>
			<input name="name" value="{{ old('name') }}" class="w-full rounded border px-3 py-2 text-sm" />
			@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
		</div>
		<div class="flex items-center gap-3">
			<button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">Simpan</button>
			<a href="{{ route('admin.permissions.index') }}" class="text-sm">Kembali</a>
		</div>
	</form>
@endsection
