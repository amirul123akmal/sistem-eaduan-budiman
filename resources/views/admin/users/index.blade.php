@extends('layouts.admin')

@section('content')
	<div class="mb-6 flex items-center justify-between">
		<h1 class="text-2xl font-semibold">Pengurusan Admin</h1>
		<a href="{{ route('admin.admins.create') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-gray-800">Tambah Admin</a>
	</div>

	@if (session('status'))
		<div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
	@endif

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
							<form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Padam admin ini?')">
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

	<div class="mt-4">{{ $admins->links() }}</div>
@endsection
