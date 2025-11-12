@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Super Admin Dashboard</h1>
				<p class="text-sm text-gray-600">Selamat datang ke panel pentadbir e-Aduan Kampung Budiman</p>
			</div>
			<div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg bg-[#F0F7F0] border border-[#F0F7F0]">
				<div class="w-2 h-2 rounded-full bg-[#132A13] animate-pulse"></div>
				<span class="text-sm font-medium text-[#132A13]">Sistem Aktif</span>
			</div>
		</div>
	</div>

	@push('scripts')
	<script>
		// Show success message from login
		@if (session('success'))
			Swal.fire({
				icon: 'success',
				title: 'Berjaya!',
				text: '{{ session('success') }}',
				confirmButtonColor: '#132A13',
				timer: 3000,
				timerProgressBar: true
			});
		@endif
	</script>
	@endpush

	{{-- Statistics Cards --}}
	<div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
		{{-- Total Complaints Card --}}
		<div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] p-6 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
			<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			<div class="relative flex items-center justify-between">
				<div class="flex-1">
					<p class="text-sm font-medium text-white/90 mb-1">Jumlah Aduan</p>
					<p class="text-4xl font-bold text-white">{{ $stats['total'] }}</p>
					<p class="text-xs text-white/80 mt-2 opacity-90">Semua aduan</p>
				</div>
				<div class="rounded-2xl bg-white/20 backdrop-blur-sm p-4">
					<svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>

		{{-- Menunggu Card --}}
		<div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-400 to-yellow-500 p-6 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
			<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			<div class="relative flex items-center justify-between">
				<div class="flex-1">
					<p class="text-sm font-medium text-yellow-50 mb-1">Menunggu</p>
					<p class="text-4xl font-bold text-white">{{ $stats['menunggu'] }}</p>
					<p class="text-xs text-yellow-50 mt-2 opacity-90">Dalam proses</p>
				</div>
				<div class="rounded-2xl bg-white/20 backdrop-blur-sm p-4">
					<svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>

		{{-- Diterima Card --}}
		<div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
			<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			<div class="relative flex items-center justify-between">
				<div class="flex-1">
					<p class="text-sm font-medium text-blue-100 mb-1">Diterima</p>
					<p class="text-4xl font-bold text-white">{{ $stats['diterima'] }}</p>
					<p class="text-xs text-blue-100 mt-2 opacity-90">Sedang ditindak</p>
				</div>
				<div class="rounded-2xl bg-white/20 backdrop-blur-sm p-4">
					<svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>

		{{-- Ditolak Card --}}
		<div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 to-red-600 p-6 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
			<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			<div class="relative flex items-center justify-between">
				<div class="flex-1">
					<p class="text-sm font-medium text-red-100 mb-1">Ditolak</p>
					<p class="text-4xl font-bold text-white">{{ $stats['ditolak'] }}</p>
					<p class="text-xs text-red-100 mt-2 opacity-90">Tidak diluluskan</p>
				</div>
				<div class="rounded-2xl bg-white/20 backdrop-blur-sm p-4">
					<svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>

		{{-- Selesai Card --}}
		<div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-500 to-green-600 p-6 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
			<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			<div class="relative flex items-center justify-between">
				<div class="flex-1">
					<p class="text-sm font-medium text-green-100 mb-1">Selesai</p>
					<p class="text-4xl font-bold text-white">{{ $stats['selesai'] }}</p>
					<p class="text-xs text-green-100 mt-2 opacity-90">Telah siap</p>
				</div>
				<div class="rounded-2xl bg-white/20 backdrop-blur-sm p-4">
					<svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>
	</div>

	{{-- Charts and Tables Section --}}
	<div class="grid gap-6 lg:grid-cols-2 mb-8">
		{{-- Complaints Trend Chart --}}
		<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
			<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
				<div class="flex items-center gap-3">
					<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
						<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
					</div>
					<div>
						<h2 class="text-lg font-bold text-gray-900">Trend Aduan</h2>
						<p class="text-xs text-gray-600">Aduan diterima dari {{ $trendLabels[0] ?? 'N/A' }} – {{ end($trendLabels) ?: 'N/A' }}</p>
					</div>
				</div>
			</div>
			<div class="p-6">
				<div id="complaintsTrendChart" style="min-height: 350px;"></div>
			</div>
		</div>

		{{-- Complaints by Category --}}
		<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
			<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
				<div class="flex items-center gap-3">
					<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
						<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
					</div>
					<div>
						<h2 class="text-lg font-bold text-gray-900">Aduan mengikut Kategori</h2>
						<p class="text-xs text-gray-600">Taburan aduan berdasarkan jenis aduan</p>
					</div>
				</div>
			</div>
			<div class="p-6">
				@if($categoryStats->count() > 0)
					<div class="space-y-4">
						@foreach($categoryStats as $index => $category)
							<div class="group relative flex items-center justify-between p-5 rounded-xl bg-gradient-to-r from-gray-50 to-white hover:from-[#F0F7F0] hover:to-white border border-gray-100 hover:border-[#132A13]/20 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]" 
							     style="animation: slideInUp 0.5s ease-out {{ $index * 0.1 }}s both;">
								<div class="flex-1">
									<div class="flex items-center gap-2 mb-2">
										<div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#132A13] to-[#2F4F2F] flex items-center justify-center shadow-md">
											<span class="text-white font-bold text-xs">{{ $index + 1 }}</span>
										</div>
										<p class="text-sm font-bold text-gray-900">{{ $category['name'] }}</p>
									</div>
									<div class="flex items-center gap-4">
										<div class="flex-1 bg-gray-200 rounded-full h-3 max-w-md relative overflow-hidden shadow-inner">
											<div class="bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] h-3 rounded-full transition-all duration-1000 ease-out relative" 
											     style="width: {{ $category['percentage'] }}%">
												<div class="absolute inset-0 bg-white/20 animate-shimmer"></div>
											</div>
										</div>
										<div class="flex items-center gap-2">
											<svg class="w-4 h-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20">
												<path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
												<path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
											</svg>
											<span class="text-xs font-bold text-gray-700">{{ $category['count'] }}</span>
										</div>
									</div>
								</div>
								<div class="ml-6">
									<div class="relative">
										<span class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] text-white font-bold text-base shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
											{{ $category['percentage'] }}%
										</span>
										<div class="absolute -inset-0.5 bg-gradient-to-r from-[#132A13] to-[#2F4F2F] rounded-2xl blur opacity-30 group-hover:opacity-60 transition-opacity"></div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<div class="py-12 text-center">
						<div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
							<svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
							</svg>
						</div>
						<p class="text-sm text-gray-500">Tiada data kategori</p>
					</div>
				@endif
			</div>
		</div>
	</div>

	{{-- Recent Complaints Table --}}
	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center justify-between">
				<div class="flex items-center gap-3">
					<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
						<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
					</div>
					<div>
						<h2 class="text-lg font-bold text-gray-900">Aduan Terkini</h2>
						<p class="text-xs text-gray-600">Senarai aduan yang baru diterima</p>
					</div>
				</div>
				<a href="{{ route('admin.complaints.index') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#132A13] text-white text-sm font-semibold hover:bg-[#2F4F2F] transition-colors">
					<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
					Lihat Semua
				</a>
			</div>
		</div>
		<div class="overflow-x-auto">
			@if($recentComplaints->count() > 0)
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Nama Pengadu</th>
							<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Jenis Aduan</th>
							<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Status</th>
							<th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700">Tarikh</th>
							<th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-700">Tindakan</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 bg-white">
						@foreach($recentComplaints as $complaint)
							<tr class="hover:bg-[#F0F7F0]/50 transition-colors">
								<td class="whitespace-nowrap px-6 py-4">
									<div class="flex items-center gap-3">
										<div class="w-10 h-10 rounded-full bg-[#F0F7F0] flex items-center justify-center">
											<span class="text-sm font-bold text-[#132A13]">{{ substr($complaint->name, 0, 1) }}</span>
										</div>
										<span class="text-sm font-semibold text-gray-900">{{ $complaint->name }}</span>
									</div>
								</td>
								<td class="px-6 py-4">
									<span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-gray-100 text-sm font-medium text-gray-700">
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
										$statusLabels = [
											'menunggu' => 'Menunggu',
											'diterima' => 'Diterima',
											'ditolak' => 'Ditolak',
											'selesai' => 'Selesai',
										];
										$color = $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
										$label = $statusLabels[$complaint->status] ?? ucfirst($complaint->status);
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
										{{ $label }}
									</span>
								</td>
								<td class="whitespace-nowrap px-6 py-4">
									<div class="flex items-center gap-2 text-sm text-gray-600">
										<svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
										{{ $complaint->created_at->format('d/m/Y') }}
									</div>
								</td>
								<td class="whitespace-nowrap px-6 py-4 text-right">
									<a href="{{ route('admin.complaints.show', $complaint) }}" class="inline-flex items-center gap-2 rounded-lg bg-[#132A13] px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-[#2F4F2F] transition-all hover:scale-105 transform">
										<svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
										Lihat
									</a>
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
					<h3 class="text-base font-semibold text-gray-900 mb-1">Tiada aduan terkini</h3>
					<p class="text-sm text-gray-500 mb-4">Belum ada aduan yang diterima.</p>
					<a href="{{ route('admin.complaints.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#132A13] text-white text-sm font-semibold hover:bg-[#2F4F2F] transition-colors">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
						Lihat Semua Aduan
					</a>
				</div>
			@endif
		</div>
		
		{{-- Pagination --}}
		@if($recentComplaints->hasPages())
			<div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
				<div class="flex flex-col sm:flex-row items-center justify-between gap-4">
					{{-- Results Info --}}
					<div class="text-sm text-gray-600">
						Menunjukkan <span class="font-semibold text-gray-900">{{ $recentComplaints->firstItem() }}</span> 
						hingga <span class="font-semibold text-gray-900">{{ $recentComplaints->lastItem() }}</span> 
						daripada <span class="font-semibold text-gray-900">{{ $recentComplaints->total() }}</span> aduan
					</div>

					{{-- Pagination Links --}}
					<div class="flex items-center gap-2">
						{{-- Previous Button --}}
						@if ($recentComplaints->onFirstPage())
							<span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
								</svg>
							</span>
						@else
							<a href="{{ $recentComplaints->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-[#132A13] bg-white border border-gray-200 rounded-lg hover:bg-[#F0F7F0] transition-colors">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
								</svg>
							</a>
						@endif

						{{-- Page Numbers --}}
						<div class="flex items-center gap-1">
							@foreach ($recentComplaints->getUrlRange(1, $recentComplaints->lastPage()) as $page => $url)
								@if ($page == $recentComplaints->currentPage())
									<span class="px-4 py-2 text-sm font-bold text-white bg-[#132A13] border border-[#132A13] rounded-lg">
										{{ $page }}
									</span>
								@else
									<a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-[#F0F7F0] hover:text-[#132A13] transition-colors">
										{{ $page }}
									</a>
								@endif
							@endforeach
						</div>

						{{-- Next Button --}}
						@if ($recentComplaints->hasMorePages())
							<a href="{{ $recentComplaints->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-[#132A13] bg-white border border-gray-200 rounded-lg hover:bg-[#F0F7F0] transition-colors">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
								</svg>
							</a>
						@else
							<span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
								</svg>
							</span>
						@endif
					</div>
				</div>
			</div>
		@endif
	</div>

	@push('scripts')
	<script>
		// Complaints Trend Chart
		@if(count($trendLabels) > 0)
		var trendOptions = {
			series: [{
				name: 'Bilangan Aduan',
				data: @json($trendCounts)
			}],
			chart: {
				type: 'area',
				height: 350,
				toolbar: {
					show: true,
					tools: {
						download: true,
						selection: false,
						zoom: false,
						zoomin: false,
						zoomout: false,
						pan: false,
						reset: false
					}
				},
				zoom: {
					enabled: false
				},
				animations: {
					enabled: true,
					easing: 'easeinout',
					speed: 800,
					animateGradually: {
						enabled: true,
						delay: 150
					},
					dynamicAnimation: {
						enabled: true,
						speed: 350
					}
				},
				dropShadow: {
					enabled: true,
					top: 3,
					left: 0,
					blur: 4,
					opacity: 0.1
				}
			},
			dataLabels: {
				enabled: true,
				style: {
					fontSize: '11px',
					fontWeight: 'bold',
					colors: ['#132A13']
				},
				background: {
					enabled: true,
					foreColor: '#132A13',
					borderRadius: 6,
					padding: 6,
					opacity: 0.9,
					borderWidth: 1,
					borderColor: '#132A13'
				},
				offsetY: -8
			},
			stroke: {
				curve: 'smooth',
				width: 3,
				colors: ['#132A13']
			},
			fill: {
				type: 'gradient',
				gradient: {
					shade: 'light',
					type: 'vertical',
					shadeIntensity: 0.5,
					gradientToColors: ['#F0F7F0'],
					inverseColors: false,
					opacityFrom: 0.7,
					opacityTo: 0.1,
					stops: [0, 100]
				}
			},
			xaxis: {
				categories: @json($trendLabels),
				labels: {
					style: {
						fontSize: '12px',
						fontWeight: 600,
						colors: '#6B7280'
					},
					rotate: -45,
					rotateAlways: false,
					trim: true
				},
				axisBorder: {
					show: true,
					color: '#E5E7EB'
				},
				axisTicks: {
					show: true,
					color: '#E5E7EB'
				}
			},
			yaxis: {
				title: {
					text: 'Bilangan Aduan',
					style: {
						fontSize: '13px',
						fontWeight: 700,
						color: '#132A13'
					}
				},
				labels: {
					style: {
						fontSize: '12px',
						fontWeight: 600,
						colors: '#6B7280'
					},
					formatter: function (val) {
						return Math.floor(val);
					}
				}
			},
			grid: {
				show: true,
				borderColor: '#E5E7EB',
				strokeDashArray: 4,
				position: 'back',
				xaxis: {
					lines: {
						show: false
					}
				},
				yaxis: {
					lines: {
						show: true
					}
				},
				padding: {
					top: 0,
					right: 10,
					bottom: 0,
					left: 10
				}
			},
			tooltip: {
				enabled: true,
				theme: 'light',
				style: {
					fontSize: '13px',
					fontFamily: 'inherit'
				},
				x: {
					show: true,
					format: 'MMM yyyy'
				},
				y: {
					formatter: function (val) {
						return val + " aduan";
					},
					title: {
						formatter: function (seriesName) {
							return seriesName + ': ';
						}
					}
				},
				marker: {
					show: true
				},
				fixed: {
					enabled: false,
					position: 'topRight'
				}
			},
			colors: ['#132A13'],
			markers: {
				size: 6,
				colors: ['#132A13'],
				strokeColors: '#fff',
				strokeWidth: 3,
				hover: {
					size: 8,
					sizeOffset: 2
				},
				shape: 'circle',
				discrete: []
			},
			legend: {
				show: false
			}
		};

		var trendChart = new ApexCharts(document.querySelector("#complaintsTrendChart"), trendOptions);
		trendChart.render();
		@else
		document.getElementById('complaintsTrendChart').innerHTML = '<div class="flex items-center justify-center h-full text-sm text-gray-500">Tiada data untuk dipaparkan</div>';
		@endif
	</script>
	@endpush

	@push('styles')
	<style>
		/* Slide In Up Animation */
		@keyframes slideInUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* Shimmer Animation for Progress Bars */
		@keyframes shimmer {
			0% {
				transform: translateX(-100%);
			}
			100% {
				transform: translateX(100%);
			}
		}

		.animate-shimmer {
			animation: shimmer 2s infinite;
		}

		/* Smooth hover transition for category cards */
		.group:hover .absolute.inset-0 {
			animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
		}

		/* Custom scrollbar for better aesthetics */
		.space-y-4::-webkit-scrollbar {
			width: 6px;
		}

		.space-y-4::-webkit-scrollbar-track {
			background: #f1f1f1;
			border-radius: 10px;
		}

		.space-y-4::-webkit-scrollbar-thumb {
			background: #132A13;
			border-radius: 10px;
		}

		.space-y-4::-webkit-scrollbar-thumb:hover {
			background: #2F4F2F;
		}
	</style>
	@endpush
@endsection
