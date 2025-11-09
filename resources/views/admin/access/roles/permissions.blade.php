@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Izin untuk Peranan</h1>
				<p class="text-sm text-gray-600">Tetapkan kebenaran untuk peranan: <span class="font-semibold text-[#132A13]">{{ $role->name }}</span></p>
			</div>
			<a href="{{ route('admin.roles.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
				<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
				Kembali
			</a>
		</div>
	</div>

	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Senarai Izin</h2>
					<p class="text-xs text-gray-600">Pilih kebenaran yang ingin diberikan kepada peranan ini</p>
				</div>
			</div>
		</div>
		<form action="{{ route('admin.roles.permissions.update', $role) }}" method="POST" class="p-6" id="permissionsForm">
			@csrf
			@method('PUT')

			<div class="grid grid-cols-1 gap-3 rounded-xl border-2 border-gray-200 bg-gray-50 p-6 sm:grid-cols-2">
				@foreach ($permissions as $perm)
					<label class="flex items-center gap-3 p-3 rounded-lg bg-white border border-gray-200 hover:bg-[#F0F7F0] hover:border-[#132A13] transition-all cursor-pointer">
						<input type="checkbox" name="permissions[]" value="{{ $perm }}" @checked(in_array($perm, $assigned)) class="rounded border-gray-300 text-[#132A13] focus:ring-[#132A13] cursor-pointer">
						<span class="text-sm font-medium text-gray-700">{{ $perm }}</span>
					</label>
				@endforeach
			</div>

			<div class="mt-8 flex items-center justify-end gap-3 border-t-2 border-gray-200 pt-6">
				<a href="{{ route('admin.roles.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
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
@endsection
