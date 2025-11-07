@extends('layouts.admin')

@section('content')
	<div class="mb-6 flex items-center justify-between">
		<h1 class="text-2xl font-semibold">Peranan</h1>
		<a href="{{ route('admin.roles.create') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-gray-800">Tambah Peranan</a>
	</div>

	@if (session('status'))
		<div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
	@endif

	<div class="overflow-hidden rounded-lg border bg-white">
		<table class="min-w-full divide-y divide-gray-200 text-sm">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-4 py-3 text-left font-medium">Nama</th>
					<th class="px-4 py-3 text-left font-medium">Jumlah Peranan</th>
					<th class="px-4 py-3"></th>
				</tr>
			</thead>
			<tbody class="divide-y divide-gray-100">
				@foreach ($roles as $role)
					<tr>
						<td class="px-4 py-3">
							{{ $role->name }}
							@if($role->name === 'Super Admin')
								<span class="ml-2 rounded bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">Dilindungi</span>
							@endif
						</td>
						<td class="px-4 py-3">{{ $role->permissions_count }}</td>
						<td class="px-4 py-3 text-right space-x-2">
							@if($role->name !== 'Super Admin')
								<a href="{{ route('admin.roles.edit', $role) }}" class="rounded-md border px-3 py-1.5 text-xs hover:bg-gray-50">Edit</a>
								<a href="{{ route('admin.roles.permissions.edit', $role) }}" class="rounded-md border px-3 py-1.5 text-xs hover:bg-gray-50">Izin</a>
								<form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline" onsubmit="return confirm('Padam peranan ini?')">
									@csrf
									@method('DELETE')
									<button class="rounded-md border px-3 py-1.5 text-xs text-red-600 hover:bg-red-50">Padam</button>
								</form>
							@else
								<!-- Super Admin role cannot be edited to prevent accidental lockout -->
								<button class="cursor-not-allowed rounded-md border px-3 py-1.5 text-xs text-gray-400" title="Peranan Super Admin dilindungi" disabled>Edit</button>
								<button class="cursor-not-allowed rounded-md border px-3 py-1.5 text-xs text-gray-400" title="Peranan Super Admin dilindungi" disabled>Izin</button>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="mt-4">{{ $roles->links() }}</div>
@endsection
