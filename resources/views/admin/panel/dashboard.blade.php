@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
				<p class="text-sm text-gray-600">Selamat datang. Anda mempunyai akses untuk mengurus sistem e-Aduan sahaja.</p>
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
	<div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
		{{-- Total Complaints Card --}}
		<div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] p-6 shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
			<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
			<div class="relative flex items-center justify-between">
				<div class="flex-1">
					<p class="text-sm font-medium text-white/90 mb-1">Jumlah Aduan</p>
					<p class="text-4xl font-bold text-white">{{ $stats['total'] }}</p>
					<p class="text-xs text-white/90 mt-2 opacity-90">Semua aduan</p>
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
				<div id="complaintsTrendChart" style="min-height: 300px;"></div>
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
					<div class="space-y-3">
						@foreach($categoryStats as $category)
							<div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
								<div class="flex-1">
									<p class="text-sm font-semibold text-gray-900 mb-1">{{ $category['name'] }}</p>
									<div class="flex items-center gap-3">
										<div class="flex-1 bg-gray-200 rounded-full h-2.5 max-w-[200px]">
											<div class="bg-gradient-to-r from-[#132A13] to-[#2F4F2F] h-2.5 rounded-full transition-all duration-500" style="width: {{ $category['percentage'] }}%"></div>
										</div>
										<span class="text-xs font-bold text-gray-700">{{ $category['count'] }} aduan</span>
									</div>
								</div>
								<div class="ml-4">
									<span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-[#F0F7F0] text-[#132A13] font-bold text-sm">
										{{ $category['percentage'] }}%
									</span>
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
				<a href="{{ route('admin.panel.complaints.index') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#132A13] text-white text-sm font-semibold hover:bg-[#2F4F2F] transition-colors">
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
									<a href="{{ route('admin.panel.complaints.show', $complaint) }}" class="inline-flex items-center gap-2 rounded-lg bg-[#132A13] px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-[#2F4F2F] transition-all hover:scale-105 transform">
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
					<a href="{{ route('admin.panel.complaints.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#132A13] text-white text-sm font-semibold hover:bg-[#2F4F2F] transition-colors">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
						Lihat Semua Aduan
					</a>
				</div>
			@endif
		</div>
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
				type: 'line',
				height: 300,
				toolbar: {
					show: false
				},
				zoom: {
					enabled: false
				}
			},
			dataLabels: {
				enabled: true,
				style: {
					fontSize: '12px',
					fontWeight: 600
				}
			},
			stroke: {
				curve: 'smooth',
				width: 3,
				colors: ['#132A13']
			},
			xaxis: {
				categories: @json($trendLabels),
				labels: {
					style: {
						fontSize: '12px'
					},
					rotate: -45,
					rotateAlways: false
				}
			},
			yaxis: {
				title: {
					text: 'Bilangan Aduan',
					style: {
						fontSize: '12px'
					}
				},
				labels: {
					style: {
						fontSize: '12px'
					}
				}
			},
			grid: {
				borderColor: '#e5e7eb',
				strokeDashArray: 4
			},
			tooltip: {
				theme: 'light',
				y: {
					formatter: function (val) {
						return val + " aduan";
					}
				}
			},
			colors: ['#132A13'],
			markers: {
				size: 5,
				colors: ['#132A13'],
				strokeColors: '#fff',
				strokeWidth: 2,
				hover: {
					size: 7
				}
			}
		};

		var trendChart = new ApexCharts(document.querySelector("#complaintsTrendChart"), trendOptions);
		trendChart.render();
		@else
		document.getElementById('complaintsTrendChart').innerHTML = '<div class="flex items-center justify-center h-full text-sm text-gray-500">Tiada data untuk dipaparkan</div>';
		@endif
	</script>
	@endpush
@endsection
