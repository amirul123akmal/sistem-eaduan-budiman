@extends('layouts.admin')

@section('content')
	@php
		$routePrefix = request()->route()->getName();
		$isAdminPanel = str_contains($routePrefix, 'admin.panel');
	@endphp

	<div class="mb-6 flex items-center justify-between">
		<div>
			<h1 class="text-2xl font-semibold text-gray-900">Audit Trail</h1>
			<p class="mt-1 text-sm text-gray-500">Sejarah perubahan status aduan</p>
		</div>
	</div>

	{{-- Filters --}}
	<div class="mb-6 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
		<form method="GET" action="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.audit-trails.index' : 'admin.audit-trails.index') }}" class="grid gap-4 md:grid-cols-4">
			<div>
				<label class="mb-1 block text-xs font-medium text-gray-700">Cari (Nama Admin)</label>
				<input type="text" name="search" value="{{ request('search') }}" placeholder="Nama admin..." class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
			</div>
			<div>
				<label class="mb-1 block text-xs font-medium text-gray-700">Status</label>
				<select name="status" class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
					<option value="">Semua Status</option>
					@foreach($statuses as $status)
						<option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
							{{ ucfirst($status) }}
						</option>
					@endforeach
				</select>
			</div>
			<div>
				<label class="mb-1 block text-xs font-medium text-gray-700">ID Aduan</label>
				<input type="number" name="complaint_id" value="{{ request('complaint_id') }}" placeholder="ID Aduan..." class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
			</div>
			<div class="flex items-end gap-2">
				<button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Cari</button>
				<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.audit-trails.index' : 'admin.audit-trails.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Reset</a>
			</div>
		</form>
	</div>

	{{-- Audit Trail List --}}
	<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
		<div class="border-b border-gray-200 px-6 py-4">
			<h2 class="text-lg font-semibold text-gray-900">Aktiviti Terkini</h2>
			<p class="mt-1 text-sm text-gray-500">Sejarah perubahan status aduan</p>
		</div>
		<div class="p-6">
			@if($auditTrails->count() > 0)
				<div class="flow-root">
					<ul class="-mb-8">
						@foreach($auditTrails as $log)
							<li>
								<div class="relative pb-8">
									@if(!$loop->last)
										<span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									@endif
									<div class="relative flex items-start space-x-3">
										<div>
											<div class="relative flex h-10 w-10 items-center justify-center rounded-full {{ $log->status === 'menunggu' ? 'bg-yellow-100' : ($log->status === 'diterima' ? 'bg-blue-100' : ($log->status === 'ditolak' ? 'bg-red-100' : 'bg-green-100')) }}">
												@php
													$statusIcons = [
														'menunggu' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>',
														'diterima' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
														'ditolak' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>',
														'selesai' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
													];
													$iconColor = $log->status === 'menunggu' ? 'text-yellow-600' : ($log->status === 'diterima' ? 'text-blue-600' : ($log->status === 'ditolak' ? 'text-red-600' : 'text-green-600'));
												@endphp
												<svg class="h-5 w-5 {{ $iconColor }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
													{!! $statusIcons[$log->status] ?? $statusIcons['menunggu'] !!}
												</svg>
											</div>
										</div>
										<div class="min-w-0 flex-1">
											<div>
												<div class="text-sm">
													<span class="font-medium text-gray-900">
														@if($log->updater)
															{{ $log->updater->name }}
														@else
															Sistem
														@endif
													</span>
													<span class="text-gray-500">telah menukar status aduan</span>
													<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaints.show' : 'admin.complaints.show', $log->complaint_id) }}" class="font-medium text-indigo-600 hover:text-indigo-800">
														#{{ $log->complaint_id }}
													</a>
													<span class="text-gray-500">kepada</span>
													@php
														$statusColors = [
															'menunggu' => 'bg-yellow-100 text-yellow-800',
															'diterima' => 'bg-blue-100 text-blue-800',
															'ditolak' => 'bg-red-100 text-red-800',
															'selesai' => 'bg-green-100 text-green-800',
														];
														$color = $statusColors[$log->status] ?? 'bg-gray-100 text-gray-800';
													@endphp
													<span class="ml-1 inline-flex rounded-full px-2 py-0.5 text-xs font-medium {{ $color }}">
														{{ ucfirst($log->status) }}
													</span>
												</div>
												@if($log->complaint)
													<p class="mt-1 text-sm text-gray-500">
														Aduan: <span class="font-medium">{{ $log->complaint->name }}</span>
														@if($log->complaint->complaintType)
															<span class="text-gray-400">•</span>
															<span class="text-gray-500">{{ $log->complaint->complaintType->type_name }}</span>
														@endif
													</p>
												@endif
												@if($log->comment)
													<div class="mt-2 rounded-md bg-gray-50 p-3">
														<p class="text-sm text-gray-700">{{ $log->comment }}</p>
													</div>
												@endif
												<p class="mt-2 text-xs text-gray-500">
													{{ $log->created_at->format('d/m/Y H:i:s') }}
													<span class="text-gray-400">•</span>
													{{ $log->created_at->diffForHumans() }}
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			@else
				<div class="py-12 text-center">
					<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
					</svg>
					<h3 class="mt-2 text-sm font-medium text-gray-900">Tiada aktiviti</h3>
					<p class="mt-1 text-sm text-gray-500">Belum ada perubahan status aduan direkodkan.</p>
				</div>
			@endif
		</div>
	</div>

	@if($auditTrails->hasPages())
		<div class="mt-4">{{ $auditTrails->appends(request()->query())->links() }}</div>
	@endif
@endsection

