@extends('layouts.admin')

@section('content')
	<h1 class="mb-6 text-2xl font-semibold">Izin untuk Peranan: {{ $role->name }}</h1>

	<form action="{{ route('admin.roles.permissions.update', $role) }}" method="POST" class="max-w-3xl">
		@csrf
		@method('PUT')
		<div class="grid grid-cols-1 gap-2 rounded border bg-white p-4 sm:grid-cols-2">
			@foreach ($permissions as $perm)
				<label class="flex items-center gap-2 text-sm">
					<input type="checkbox" name="permissions[]" value="{{ $perm }}" @checked(in_array($perm, $assigned)) class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
					<span>{{ $perm }}</span>
				</label>
			@endforeach
		</div>
		<div class="mt-4 flex items-center gap-3">
			<button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">Simpan</button>
			<a href="{{ route('admin.roles.index') }}" class="text-sm">Kembali</a>
		</div>
	</form>
@endsection
