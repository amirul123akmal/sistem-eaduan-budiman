@extends('layouts.admin')

@section('content')
	<div class="mb-6">
		<h1 class="text-2xl font-semibold text-gray-900">Super Admin Dashboard</h1>
		<p class="mt-1 text-sm text-gray-600">Selamat datang ke panel pentadbir e-Aduan Kampung Budiman.</p>
	</div>

	@push('scripts')
	<script>
		// Show success message from login
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
	</script>
	@endpush

	{{-- Statistics Cards --}}
	<div class="mb-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
		<div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-500">Jumlah Aduan</p>
					<p class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
				</div>
				<div class="rounded-full bg-indigo-100 p-3">
					<svg class="h-6 w-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>
		<div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-500">Menunggu</p>
					<p class="mt-2 text-3xl font-semibold text-yellow-600">{{ $stats['menunggu'] }}</p>
				</div>
				<div class="rounded-full bg-yellow-100 p-3">
					<svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>
		<div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-500">Diterima</p>
					<p class="mt-2 text-3xl font-semibold text-blue-600">{{ $stats['diterima'] }}</p>
				</div>
				<div class="rounded-full bg-blue-100 p-3">
					<svg class="h-6 w-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>
		<div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-500">Ditolak</p>
					<p class="mt-2 text-3xl font-semibold text-red-600">{{ $stats['ditolak'] }}</p>
				</div>
				<div class="rounded-full bg-red-100 p-3">
					<svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>
		<div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm font-medium text-gray-500">Selesai</p>
					<p class="mt-2 text-3xl font-semibold text-green-600">{{ $stats['selesai'] }}</p>
				</div>
				<div class="rounded-full bg-green-100 p-3">
					<svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
				</div>
			</div>
		</div>
	</div>

	{{-- Charts and Tables Section --}}
	<div class="grid gap-6 lg:grid-cols-2">
		{{-- Complaints Trend Chart --}}
		<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
			<div class="border-b border-gray-200 px-6 py-4">
				<h2 class="text-lg font-semibold text-gray-900">Trend Aduan</h2>
				<p class="mt-1 text-sm text-gray-500">Aduan diterima dari {{ $trendLabels[0] ?? 'N/A' }} – {{ end($trendLabels) ?: 'N/A' }}</p>
			</div>
			<div class="p-6">
				<div id="complaintsTrendChart" style="min-height: 300px;"></div>
			</div>
		</div>

		{{-- Complaints by Category --}}
		<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
			<div class="border-b border-gray-200 px-6 py-4">
				<h2 class="text-lg font-semibold text-gray-900">Aduan mengikut Kategori</h2>
				<p class="mt-1 text-sm text-gray-500">Taburan aduan berdasarkan jenis aduan</p>
			</div>
			<div class="p-6">
				@if($categoryStats->count() > 0)
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kategori</th>
									<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Bilangan</th>
									<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Peratusan</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-gray-200 bg-white">
								@foreach($categoryStats as $category)
									<tr class="hover:bg-gray-50">
										<td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">{{ $category['name'] }}</td>
										<td class="whitespace-nowrap px-4 py-3 text-sm text-gray-500">{{ $category['count'] }}</td>
										<td class="whitespace-nowrap px-4 py-3">
											<div class="flex items-center gap-2">
												<div class="flex-1 bg-gray-200 rounded-full h-2">
													<div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $category['percentage'] }}%"></div>
												</div>
												<span class="text-sm font-medium text-gray-700 w-12 text-right">{{ $category['percentage'] }}%</span>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="py-8 text-center text-sm text-gray-500">Tiada data kategori</div>
				@endif
			</div>
		</div>
	</div>

	{{-- Recent Complaints Table --}}
	<div class="mt-6 rounded-lg border border-gray-200 bg-white shadow-sm">
		<div class="border-b border-gray-200 px-6 py-4">
			<h2 class="text-lg font-semibold text-gray-900">Aduan Terkini</h2>
			<p class="mt-1 text-sm text-gray-500">Senarai aduan yang baru diterima</p>
		</div>
		<div class="overflow-x-auto">
			@if($recentComplaints->count() > 0)
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama Pengadu</th>
							<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jenis Aduan</th>
							<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
							<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tarikh</th>
							<th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Tindakan</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 bg-white">
						@foreach($recentComplaints as $complaint)
							<tr class="hover:bg-gray-50">
								<td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $complaint->name }}</td>
								<td class="px-6 py-4 text-sm text-gray-500">{{ $complaint->complaintType->type_name ?? '-' }}</td>
								<td class="whitespace-nowrap px-6 py-4">
									@php
										$statusColors = [
											'menunggu' => 'bg-yellow-100 text-yellow-800',
											'diterima' => 'bg-blue-100 text-blue-800',
											'ditolak' => 'bg-red-100 text-red-800',
											'selesai' => 'bg-green-100 text-green-800',
										];
										$statusLabels = [
											'menunggu' => 'Menunggu',
											'diterima' => 'Diterima',
											'ditolak' => 'Ditolak',
											'selesai' => 'Selesai',
										];
										$color = $statusColors[$complaint->status] ?? 'bg-gray-100 text-gray-800';
										$label = $statusLabels[$complaint->status] ?? ucfirst($complaint->status);
									@endphp
									<span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $color }}">
										{{ $label }}
									</span>
								</td>
								<td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
									{{ $complaint->created_at->format('d/m/Y') }}
								</td>
								<td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
									<a href="{{ route('admin.complaints.show', $complaint) }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs text-gray-700 shadow-sm hover:bg-gray-50">
										<svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
										Lihat
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="px-6 py-12 text-center">
					<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8a9 9 0 110-18 9 9 0 010 18z"></path>
					</svg>
					<h3 class="mt-2 text-sm font-medium text-gray-900">Tiada aduan terkini</h3>
					<p class="mt-1 text-sm text-gray-500">Belum ada aduan yang diterima.</p>
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
				colors: ['#4f46e5']
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
			colors: ['#4f46e5'],
			markers: {
				size: 5,
				colors: ['#4f46e5'],
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
