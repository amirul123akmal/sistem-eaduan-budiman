@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div>
			<h1 class="text-3xl font-bold text-gray-900 mb-2">Profil Saya</h1>
			<p class="text-sm text-gray-600">Urus maklumat profil, kata laluan, dan tetapan akaun anda</p>
		</div>
	</div>

	<div class="space-y-6">
		{{-- Profile Information --}}
		<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
			@include('profile.partials.update-profile-information-form')
		</div>

		{{-- Update Password --}}
		<div class="rounded-2xl border border-gray-200 bg-white shadow-lg overflow-hidden">
			@include('profile.partials.update-password-form')
		</div>

		{{-- Delete Account --}}
		<div class="rounded-2xl border-2 border-red-200 bg-gradient-to-br from-red-50 to-white shadow-lg overflow-hidden">
			@include('profile.partials.delete-user-form')
		</div>
	</div>
@endsection
