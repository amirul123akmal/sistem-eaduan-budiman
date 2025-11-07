@extends('layouts.admin')

@section('content')
	<div class="mb-6 flex items-center justify-between">
		<h1 class="text-2xl font-semibold">Izin</h1>
		<a href="{{ route('admin.permissions.create') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-gray-800">Tambah Izin</a>
	</div>

	@if (session('status'))
		<div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
	@endif

	<div class="overflow-hidden rounded-lg border bg-white">
		<table class="min-w-full divide-y divide-gray-200 text-sm">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-4 py-3 text-left font-medium">Nama</th>
					<th class="px-4 py-3"></th>
				</tr>
			</thead>
			<tbody class="divide-y divide-gray-100">
				@foreach ($permissions as $permission)
					<tr>
						<td class="px-4 py-3">{{ $permission->name }}</td>
						<td class="px-4 py-3 text-right space-x-2">
							<a href="{{ route('admin.permissions.edit', $permission) }}" class="rounded-md border px-3 py-1.5 text-xs hover:bg-gray-50">Edit</a>
							<form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="inline" onsubmit="return confirm('Padam izin ini?')">
								@csrf
								@method('DELETE')
								<button class="rounded-md border px-3 py-1.5 text-xs text-red-600 hover:bg-red-50">Padam</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="mt-4">{{ $permissions->links() }}</div>
@endsection
