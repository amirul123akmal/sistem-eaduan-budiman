@extends('layouts.admin')

@section('content')
	@php
		$routePrefix = request()->route()->getName();
		$isAdminPanel = str_contains($routePrefix, 'admin.panel');
	@endphp

	<div class="mb-8">
		<div>
			<h1 class="text-3xl font-bold text-gray-900 mb-2">Audit Trail</h1>
			<p class="text-sm text-gray-600">Sejarah perubahan status aduan dan aktiviti sistem</p>
		</div>
	</div>

	{{-- Filters --}}
	<div class="mb-6 rounded-2xl border border-gray-200 bg-gradient-to-br from-[#F0F7F0] to-white p-6 shadow-lg">
		<div class="mb-4 flex items-center gap-3">
			<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
				<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path></svg>
			</div>
			<div>
				<h2 class="text-lg font-bold text-gray-900">Penapis</h2>
				<p class="text-xs text-gray-600">Saring aktiviti audit trail</p>
			</div>
		</div>
		<form method="GET" action="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.audit-trails.index' : 'admin.audit-trails.index') }}" class="grid gap-4 md:grid-cols-4">
			<div>
				<label class="mb-2 block text-sm font-semibold text-gray-700 flex items-center gap-2">
					<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
					Cari
				</label>
				<div class="relative">
					<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
						<svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
					</div>
					<input type="text" name="search" value="{{ request('search') }}" placeholder="Nama admin, nama aduan, telefon, atau komen..." class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200 text-sm shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 transition-all">
				</div>
			</div>
			<div>
				<label class="mb-2 block text-sm font-semibold text-gray-700 flex items-center gap-2">
					<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
					Status
				</label>
				<div class="relative">
					<select name="status" class="w-full appearance-none rounded-xl border-2 border-gray-200 bg-white px-4 py-3 pr-10 text-sm shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 transition-all">
						<option value="">Semua Status</option>
						@foreach($statuses as $status)
							<option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
								{{ ucfirst($status) }}
							</option>
						@endforeach
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
						<svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
					</div>
				</div>
			</div>
			<div>
				<label class="mb-2 block text-sm font-semibold text-gray-700 flex items-center gap-2">
					<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
					ID Aduan / Public ID
				</label>
				<input type="text" name="complaint_id" value="{{ request('complaint_id') }}" placeholder="ID Aduan atau Public ID..." class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-sm shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 transition-all">
			</div>
			<div class="flex items-end gap-2">
				<button type="submit" class="group relative overflow-hidden flex-1 rounded-xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] px-4 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform">
					<div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
					<div class="relative flex items-center justify-center gap-2">
						<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
						Cari
					</div>
				</button>
				<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.audit-trails.index' : 'admin.audit-trails.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
					Reset
				</a>
			</div>
		</form>
	</div>

	{{-- Audit Trail List --}}
	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" clip-rule="evenodd"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Aktiviti Terkini</h2>
					<p class="text-xs text-gray-600">Sejarah perubahan status aduan</p>
				</div>
			</div>
		</div>
		<div class="p-6">
			@if($auditTrails->count() > 0)
				<div class="flow-root">
					<ul class="-mb-8">
						@foreach($auditTrails as $log)
							<li>
								<div class="relative pb-8">
									@if(!$loop->last)
										<span class="absolute left-6 top-6 -ml-px h-full w-0.5 bg-gradient-to-b from-[#F0F7F0] to-[#F0F7F0]/50" aria-hidden="true"></span>
									@endif
									<div class="relative flex items-start gap-4 pl-6">
										<div class="absolute left-0 top-2 w-4 h-4 rounded-full bg-[#132A13] border-2 border-white shadow-sm"></div>
										<div class="flex-1 bg-gradient-to-br from-gray-50 to-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
											<div class="flex items-start gap-4">
												<div class="flex-shrink-0">
													<div class="relative flex h-12 w-12 items-center justify-center rounded-xl {{ $log->status === 'menunggu' ? 'bg-yellow-100 border-2 border-yellow-300' : ($log->status === 'diterima' ? 'bg-blue-100 border-2 border-blue-300' : ($log->status === 'ditolak' ? 'bg-red-100 border-2 border-red-300' : 'bg-green-100 border-2 border-green-300')) }}">
														@php
															$statusIcons = [
																'menunggu' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>',
																'diterima' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
																'ditolak' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>',
																'selesai' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
															];
															$iconColor = $log->status === 'menunggu' ? 'text-yellow-600' : ($log->status === 'diterima' ? 'text-blue-600' : ($log->status === 'ditolak' ? 'text-red-600' : 'text-green-600'));
														@endphp
														<svg class="h-6 w-6 {{ $iconColor }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
															{!! $statusIcons[$log->status] ?? $statusIcons['menunggu'] !!}
														</svg>
													</div>
												</div>
												<div class="flex-1 min-w-0">
													<div class="flex items-center gap-3 mb-2">
														<span class="text-sm font-semibold text-gray-900 flex items-center gap-2">
															<svg class="h-4 w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
															@if($log->updater)
																{{ $log->updater->name }}
															@else
																Sistem
															@endif
														</span>
														<span class="text-sm text-gray-500">telah menukar status aduan</span>
														<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaints.show' : 'admin.complaints.show', $log->complaint_id) }}" class="inline-flex items-center gap-1 rounded-lg bg-[#F0F7F0] px-2.5 py-1 text-xs font-bold text-[#132A13] hover:bg-[#F0F7F0]/80 transition-colors">
															<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
															#{{ $log->complaint_id }}
														</a>
														<span class="text-sm text-gray-500">kepada</span>
														@php
															$statusColors = [
																'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
																'diterima' => 'bg-blue-100 text-blue-800 border-blue-300',
																'ditolak' => 'bg-red-100 text-red-800 border-red-300',
																'selesai' => 'bg-green-100 text-green-800 border-green-300',
															];
															$color = $statusColors[$log->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
														@endphp
														<span class="inline-flex items-center gap-1.5 rounded-full border-2 px-3 py-1 text-xs font-bold {{ $color }}">
															@if($log->status === 'menunggu')
																<span class="w-1.5 h-1.5 rounded-full bg-yellow-600 animate-pulse"></span>
															@elseif($log->status === 'diterima')
																<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
															@elseif($log->status === 'selesai')
																<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
															@else
																<svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
															@endif
															{{ ucfirst($log->status) }}
														</span>
													</div>
													@if($log->complaint)
														<p class="text-sm text-gray-600 mb-2 flex items-center gap-2">
															<svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
															Aduan: <span class="font-semibold text-gray-900">{{ $log->complaint->name }}</span>
															@if($log->complaint->complaintType)
																<span class="text-gray-400">•</span>
																<span class="text-gray-600">{{ $log->complaint->complaintType->type_name }}</span>
															@endif
														</p>
													@endif
													@if($log->comment)
														<div class="mt-3 rounded-lg bg-white border border-gray-200 p-3">
															<p class="text-sm text-gray-700 flex items-start gap-2">
																<svg class="h-4 w-4 text-gray-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
																<span>{{ $log->comment }}</span>
															</p>
														</div>
													@endif
													<p class="mt-3 text-xs text-gray-500 flex items-center gap-2">
														<svg class="h-3 w-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
														{{ $log->created_at->format('d/m/Y H:i:s') }}
														<span class="text-gray-400">•</span>
														{{ $log->created_at->diffForHumans() }}
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			@else
				<div class="py-16 text-center">
					<div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
						<svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
						</svg>
					</div>
					<h3 class="text-base font-semibold text-gray-900 mb-1">Tiada aktiviti</h3>
					<p class="text-sm text-gray-500">Belum ada perubahan status aduan direkodkan.</p>
				</div>
			@endif
		</div>
	</div>

	@if($auditTrails->hasPages())
		<div class="mt-4">{{ $auditTrails->appends(request()->query())->links() }}</div>
	@endif
@endsection

