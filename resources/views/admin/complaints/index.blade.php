@extends('layouts.admin')

@section('content')
	<div class="mb-8 flex items-center justify-between">
		<div>
			<h1 class="text-3xl font-bold text-gray-900 mb-2">Aduan</h1>
			<p class="text-sm text-gray-600">Urus dan pantau semua aduan yang diterima</p>
		</div>
		@php
			$user = auth()->user();
			$hasCreatePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('create complaints'));
		@endphp
		@if($hasCreatePermission)
			<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.create' : 'admin.complaints.create') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
				<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
				<div class="relative flex items-center gap-2">
					<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
					Tambah Aduan
				</div>
			</a>
		@else
			<div class="flex items-center gap-2 rounded-xl border-2 border-gray-200 bg-gray-50 px-6 py-3 text-sm text-gray-500 cursor-not-allowed" title="Anda tidak mempunyai kebenaran untuk menambah aduan">
				<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
				Tambah Aduan
				<span class="ml-1 text-xs font-semibold text-red-600">(Tiada Kebenaran)</span>
			</div>
		@endif
	</div>


	{{-- Filters --}}
	<div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-br from-[#F0F7F0] to-white p-6 shadow-lg">
		<div class="mb-4 flex items-center gap-3">
			<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
				<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
			</div>
			<h2 class="text-lg font-bold text-gray-900">Carian & Penapisan</h2>
		</div>
		<form method="GET" action="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}" class="grid gap-4 md:grid-cols-4">
			<div>
				<label class="mb-2 block text-sm font-semibold text-gray-700">Cari</label>
				<div class="relative">
					<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
						<svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
					</div>
					<input type="text" name="search" value="{{ request('search') }}" placeholder="ID Aduan, Nama, Telefon, Emel, atau Penerangan..." class="w-full pl-10 rounded-xl border-2 border-gray-200 py-2.5 text-sm shadow-sm focus:border-[#132A13] focus:ring-[#132A13] transition-all">
				</div>
			</div>
			<div>
				<label class="mb-2 block text-sm font-semibold text-gray-700">Status</label>
				<div class="relative">
					<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
						<svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
					</div>
					<select name="status" class="w-full pl-10 rounded-xl border-2 border-gray-200 py-2.5 text-sm shadow-sm focus:border-[#132A13] focus:ring-[#132A13] transition-all appearance-none cursor-pointer">
						<option value="">Semua Status</option>
						@foreach($statuses as $status)
							<option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
								{{ ucfirst($status) }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div>
				<label class="mb-2 block text-sm font-semibold text-gray-700">Jenis Aduan</label>
				<div class="relative">
					<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
						<svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
					</div>
					<select name="complaint_type_id" class="w-full pl-10 rounded-xl border-2 border-gray-200 py-2.5 text-sm shadow-sm focus:border-[#132A13] focus:ring-[#132A13] transition-all appearance-none cursor-pointer">
						<option value="">Semua Jenis</option>
						@foreach($complaintTypes as $type)
							<option value="{{ $type->id }}" {{ (string)request('complaint_type_id') === (string)$type->id ? 'selected' : '' }}>
								{{ $type->type_name }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="flex items-end gap-2">
				<button type="submit" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform flex-1">
					<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
					<div class="relative flex items-center justify-center gap-2">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
						Cari
					</div>
				</button>
				<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
					Reset
				</a>
			</div>
		</form>
	</div>

	<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg">
		@if($complaints->count() > 0)
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">ID Aduan</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Jenis Aduan</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Status</th>
						<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Tarikh</th>
						<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					@foreach ($complaints as $complaint)
						<tr class="hover:bg-[#F0F7F0]/50 transition-colors">
							<td class="whitespace-nowrap px-6 py-4">
								<span class="inline-flex items-center justify-center w-auto min-w-[84px] h-8 rounded-lg bg-[#F0F7F0] text-[#132A13] font-bold text-xs px-3">
									{{ $complaint->public_id ?? '-' }}
								</span>
							</td>
							<td class="px-6 py-4">
								<div class="flex items-center gap-3">
									<div class="w-10 h-10 rounded-full bg-[#F0F7F0] flex items-center justify-center">
										<span class="text-sm font-bold text-[#132A13]">{{ substr($complaint->name, 0, 1) }}</span>
									</div>
									<div>
										<div class="text-sm font-semibold text-gray-900">{{ $complaint->name }}</div>
										<div class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
											<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
											{{ $complaint->phone_number }}
										</div>
									</div>
								</div>
							</td>
							<td class="px-6 py-4">
								<span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100 text-sm font-medium text-gray-700">
									<svg class="h-4 w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
									{{ $complaint->complaintType->type_name ?? '-' }}
								</span>
							</td>
							<td class="whitespace-nowrap px-6 py-4">
								@php
									$statusColors = [
										'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
										'diterima' => 'bg-blue-100 text-blue-800 border-blue-300',
										'ditolak' => 'bg-red-100 text-red-800 border-red-300',
										'selesai' => 'bg-green-100 text-green-800 border-green-300',
									];
									$color = $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
								@endphp
								<span class="inline-flex items-center gap-1.5 rounded-full border-2 px-3 py-1 text-xs font-bold {{ $color }}">
									@if($complaint->status === 'menunggu')
										<span class="w-1.5 h-1.5 rounded-full bg-yellow-600 animate-pulse"></span>
									@elseif($complaint->status === 'diterima')
										<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
									@elseif($complaint->status === 'selesai')
										<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
									@else
										<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
									@endif
									{{ ucfirst($complaint->status) }}
								</span>
							</td>
							<td class="whitespace-nowrap px-6 py-4">
								<div class="flex items-center gap-2 text-sm text-gray-600">
									<svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
									{{ $complaint->created_at->format('d/m/Y H:i') }}
								</div>
							</td>
							<td class="whitespace-nowrap px-6 py-4 text-right">
								@php
									$user = auth()->user();
									$hasEditPermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('edit complaints'));
									$hasDeletePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('delete complaints'));
								@endphp
								<div class="flex items-center justify-end gap-2">
									<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.show' : 'admin.complaints.show', $complaint) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-[#132A13] px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-[#2F4F2F] transition-all hover:scale-105 transform">
										<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
										Lihat
									</a>
									@if($hasEditPermission)
										<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.edit' : 'admin.complaints.edit', $complaint) }}" class="inline-flex items-center gap-1.5 rounded-lg border-2 border-[#F0F7F0] bg-[#F0F7F0] px-3 py-1.5 text-xs font-semibold text-[#132A13] shadow-sm hover:bg-[#F0F7F0] transition-all hover:scale-105 transform">
											<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
											Edit
										</a>
									@else
										<span class="inline-flex items-center gap-1.5 rounded-lg border-2 border-gray-200 bg-gray-50 px-3 py-1.5 text-xs text-gray-400 cursor-not-allowed" title="Anda tidak mempunyai kebenaran untuk mengemaskini aduan">
											<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
											Edit
										</span>
									@endif
									@if($hasDeletePermission)
										<form action="{{ route($isAdminPanel ? 'admin.panel.complaints.destroy' : 'admin.complaints.destroy', $complaint) }}" method="POST" class="inline delete-form" data-complaint-name="{{ $complaint->name }}" data-complaint-id="{{ $complaint->public_id ?? '#' . $complaint->id }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border-2 border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 shadow-sm hover:bg-red-100 transition-all hover:scale-105 transform">
												<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
												Padam
											</button>
										</form>
									@else
										<span class="inline-flex items-center gap-1.5 rounded-lg border-2 border-gray-200 bg-gray-50 px-3 py-1.5 text-xs text-gray-400 cursor-not-allowed" title="Anda tidak mempunyai kebenaran untuk memadam aduan">
											<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
											Padam
										</span>
									@endif
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="px-6 py-16 text-center">
				<div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
					<svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8a9 9 0 110-18 9 9 0 010 18z"></path>
					</svg>
				</div>
				<h3 class="text-base font-semibold text-gray-900 mb-1">Tiada aduan</h3>
				<p class="text-sm text-gray-500 mb-6">Mula dengan menambah aduan baharu.</p>
				@php
					$user = auth()->user();
					$hasCreatePermission = $user && ($user->hasRole('Super Admin') || $user->hasDirectPermission('create complaints'));
				@endphp
				@if($hasCreatePermission)
					<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.create' : 'admin.complaints.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
						<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
						Tambah Aduan
					</a>
				@endif
			</div>
		@endif
	</div>

	{{-- Modern Pagination --}}
	@if($complaints->hasPages())
		<div class="mt-6 flex flex-col items-center justify-between gap-4 sm:flex-row">
			<div class="flex items-center gap-2 text-sm text-gray-600">
				<span>Menunjukkan</span>
				<span class="font-semibold text-[#132A13]">{{ $complaints->firstItem() ?? 0 }}</span>
				<span>hingga</span>
				<span class="font-semibold text-[#132A13]">{{ $complaints->lastItem() ?? 0 }}</span>
				<span>daripada</span>
				<span class="font-semibold text-[#132A13]">{{ $complaints->total() }}</span>
				<span>aduan</span>
			</div>
			
			<div class="flex items-center gap-2">
				{{-- Previous Button --}}
				@if($complaints->onFirstPage())
					<button disabled class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
						Sebelumnya
					</button>
				@else
					<a href="{{ $complaints->appends(request()->query())->previousPageUrl() }}" class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-[#F0F7F0] hover:border-[#132A13] hover:text-[#132A13]">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
						Sebelumnya
					</a>
				@endif

				{{-- Page Numbers --}}
				<div class="hidden sm:flex items-center gap-1">
					@foreach($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
						@if($page == $complaints->currentPage())
							<span class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-r from-[#132A13] to-[#2F4F2F] text-sm font-semibold text-white shadow-md">{{ $page }}</span>
						@elseif($page == 1 || $page == $complaints->lastPage() || ($page >= $complaints->currentPage() - 2 && $page <= $complaints->currentPage() + 2))
							<a href="{{ $complaints->appends(request()->query())->url($page) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 transition-all hover:bg-[#F0F7F0] hover:border-[#132A13] hover:text-[#132A13]">{{ $page }}</a>
						@elseif($page == $complaints->currentPage() - 3 || $page == $complaints->currentPage() + 3)
							<span class="flex h-9 w-9 items-center justify-center text-sm text-gray-400">...</span>
						@endif
					@endforeach
				</div>

				{{-- Mobile Page Info --}}
				<div class="flex sm:hidden items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700">
					<span>Halaman</span>
					<span class="text-[#132A13]">{{ $complaints->currentPage() }}</span>
					<span>daripada</span>
					<span class="text-[#132A13]">{{ $complaints->lastPage() }}</span>
				</div>

				{{-- Next Button --}}
				@if($complaints->hasMorePages())
					<a href="{{ $complaints->appends(request()->query())->nextPageUrl() }}" class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-[#F0F7F0] hover:border-[#132A13] hover:text-[#132A13]">
						Seterusnya
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
					</a>
				@else
					<button disabled class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed">
						Seterusnya
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
					</button>
				@endif
			</div>
		</div>
	@else
		<div class="mt-6 text-center text-sm text-gray-600">
			<p>Menunjukkan semua {{ $complaints->total() }} aduan</p>
		</div>
	@endif

	@push('scripts')
	<script>
		// Show success/error messages from session
		@if (session('success'))
			Swal.fire({
				icon: 'success',
				title: 'Berjaya!',
				text: '{{ session('success') }}',
				confirmButtonColor: '#4f46e5',
				timer: 3000,
				timerProgressBar: true
			});
		@endif

		@if (session('error'))
			Swal.fire({
				icon: 'error',
				title: 'Ralat!',
				text: '{{ session('error') }}',
				confirmButtonColor: '#dc2626'
			});
		@endif

		// Handle delete confirmation with SweetAlert2
		document.querySelectorAll('.delete-form').forEach(form => {
			form.addEventListener('submit', function(e) {
				e.preventDefault();
				
				const form = this;
				const complaintName = form.getAttribute('data-complaint-name');
				const complaintId = form.getAttribute('data-complaint-id');
				
				Swal.fire({
					title: 'Adakah anda pasti?',
					text: `Aduan ${complaintId} - "${complaintName}" akan dipadam secara kekal!`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#dc2626',
					cancelButtonColor: '#6b7280',
					confirmButtonText: 'Ya, padam!',
					cancelButtonText: 'Batal',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						// Show loading
						Swal.fire({
							title: 'Memadam...',
							text: 'Sila tunggu',
							allowOutsideClick: false,
							allowEscapeKey: false,
							didOpen: () => {
								Swal.showLoading();
							}
						});

						// Submit form via AJAX
						const formData = new FormData();
						formData.append('_method', 'DELETE');
						formData.append('_token', form.querySelector('input[name="_token"]').value);

						fetch(form.action, {
							method: 'POST',
							headers: {
								'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('input[name="_token"]').value,
								'X-Requested-With': 'XMLHttpRequest',
								'Accept': 'application/json'
							},
							body: formData
						})
						.then(response => {
							if (response.ok) {
								return response.json();
							} else {
								return response.json().then(data => {
									throw new Error(data.message || 'Tidak dapat memadam aduan.');
								});
							}
						})
						.then(data => {
							if (data.success) {
								Swal.fire({
									icon: 'success',
									title: 'Berjaya!',
									text: data.message || 'Aduan berjaya dipadam.',
									confirmButtonColor: '#4f46e5',
									timer: 2000,
									timerProgressBar: true
								}).then(() => {
									location.reload();
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Ralat!',
									text: data.message || 'Tidak dapat memadam aduan.',
									confirmButtonColor: '#dc2626'
								});
							}
						})
						.catch(error => {
							console.error('Error:', error);
							Swal.fire({
								icon: 'error',
								title: 'Ralat!',
								text: error.message || 'Tidak dapat memadam aduan. Sila cuba lagi.',
								confirmButtonColor: '#dc2626'
							});
						});
					}
				});
			});
		});
	</script>
	@endpush
@endsection

