@extends('layouts.admin')

@section('content')
	<div class="mb-6">
		<h1 class="text-2xl font-semibold">Super Admin Dashboard</h1>
		<p class="mt-1 text-sm text-gray-600">Selamat datang ke panel pentadbir e-Aduan Kampung Budiman.</p>
	</div>

	<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
		<div class="rounded-lg border bg-white p-5">
			<p class="text-sm text-gray-500">Aduan Menunggu</p>
			<p class="mt-2 text-3xl font-semibold">—</p>
		</div>
		<div class="rounded-lg border bg-white p-5">
			<p class="text-sm text-gray-500">Aduan Diterima</p>
			<p class="mt-2 text-3xl font-semibold">—</p>
		</div>
		<div class="rounded-lg border bg-white p-5">
			<p class="text-sm text-gray-500">Aduan Ditolak</p>
			<p class="mt-2 text-3xl font-semibold">—</p>
		</div>
		<div class="rounded-lg border bg-white p-5">
			<p class="text-sm text-gray-500">Aduan Selesai</p>
			<p class="mt-2 text-3xl font-semibold">—</p>
		</div>
	</div>
@endsection
