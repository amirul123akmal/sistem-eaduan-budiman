@extends('layouts.admin')

@section('content')
	<div class="mb-8">
		<div class="flex items-center justify-between">
			<div>
				<h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Jenis Aduan</h1>
				<p class="text-sm text-gray-600">Isi maklumat di bawah untuk menambah jenis aduan baharu</p>
			</div>
			<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
				<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
				Kembali
			</a>
		</div>
	</div>

	<div class="rounded-2xl border border-gray-200 bg-white shadow-lg">
		<div class="bg-gradient-to-r from-[#F0F7F0] to-[#F0F7F0]/80 border-b border-gray-200 px-6 py-4">
			<div class="flex items-center gap-3">
				<div class="w-10 h-10 rounded-lg bg-[#132A13] flex items-center justify-center">
					<svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
				</div>
				<div>
					<h2 class="text-lg font-bold text-gray-900">Maklumat Jenis Aduan</h2>
					<p class="text-xs text-gray-600">Sila isi semua maklumat yang diperlukan</p>
				</div>
			</div>
		</div>
		<form action="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaint-types.store' : 'admin.complaint-types.store') }}" method="POST" class="p-6" id="complaintTypeForm" novalidate>
			@csrf

			<div class="space-y-6">
				{{-- Nama Jenis Aduan --}}
				<div>
					<label for="type_name" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
							Nama Jenis Aduan <span class="text-red-500">*</span>
						</div>
					</label>
					<input 
						type="text" 
						name="type_name" 
						id="type_name" 
						value="{{ old('type_name') }}" 
						required
						maxlength="100"
						pattern="[a-zA-Z0-9\s.,-]+"
						title="Nama jenis aduan hanya boleh mengandungi huruf, nombor, dan aksara khas (., -)"
						class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all @error('type_name') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
						placeholder="Contoh: Masalah Jalan Raya"
						oninput="validateTypeName(this); updateCharCounter('type_name', 100)"
					/>
					<div class="mt-2 flex items-center justify-between">
						<div id="type_name-error" class="text-sm text-red-600 hidden flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
						</div>
						<div id="type_name-counter" class="text-xs font-medium text-gray-500">
							<span id="type_name-count" class="text-[#132A13]">0</span>/100 aksara
						</div>
					</div>
					@error('type_name')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
					<p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
						<svg class="h-3 w-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
						Hanya huruf, nombor, dan aksara khas (., -) dibenarkan
					</p>
				</div>

				{{-- Penerangan --}}
				<div>
					<label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
						<div class="flex items-center gap-2">
							<svg class="h-4 w-4 text-[#132A13]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
							Penerangan
						</div>
					</label>
					<textarea 
						name="description" 
						id="description" 
						rows="4"
						maxlength="500"
						class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-[#132A13] focus:ring-2 focus:ring-[#132A13]/20 sm:text-sm transition-all resize-none @error('description') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
						placeholder="Masukkan penerangan jenis aduan ini (pilihan)"
						oninput="updateCharCounter('description', 500)"
					>{{ old('description') }}</textarea>
					<div class="mt-2 flex items-center justify-between">
						<div id="description-error" class="text-sm text-red-600 hidden flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
						</div>
						<div id="description-counter" class="text-xs font-medium text-gray-500">
							<span id="description-count" class="text-[#132A13]">0</span>/500 aksara
						</div>
					</div>
					@error('description')
						<p class="mt-1 text-sm text-red-600 flex items-center gap-1">
							<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
							{{ $message }}
						</p>
					@enderror
				</div>
			</div>

			{{-- Actions --}}
			<div class="mt-8 flex items-center justify-end gap-3 border-t-2 border-gray-200 pt-6">
				<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index') }}" class="rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
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
			}).then(() => {
				window.location.href = '{{ route(isset($isAdminPanel) && $isAdminPanel ? "admin.panel.complaint-types.index" : "admin.complaint-types.index") }}';
			});
		@endif

		@if ($errors->any())
			Swal.fire({
				icon: 'error',
				title: 'Ralat Pengesahan!',
				html: '<ul class="text-left list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
				confirmButtonColor: '#dc2626'
			});
		@endif

		// Initialize character counters on page load
		document.addEventListener('DOMContentLoaded', function() {
			updateCharCounter('type_name', 100);
			updateCharCounter('description', 500);
		});

		// Character counter function
		function updateCharCounter(fieldId, maxLength) {
			const field = document.getElementById(fieldId);
			const counter = document.getElementById(fieldId + '-count');
			if (field && counter) {
				const currentLength = field.value.length;
				counter.textContent = currentLength;
				
				// Update counter color based on length
				const counterDiv = document.getElementById(fieldId + '-counter');
				if (currentLength > maxLength * 0.9) {
					counterDiv.classList.remove('text-gray-500');
					counterDiv.classList.add('text-orange-600', 'font-medium');
				} else if (currentLength > maxLength) {
					counterDiv.classList.remove('text-gray-500', 'text-orange-600');
					counterDiv.classList.add('text-red-600', 'font-semibold');
				} else {
					counterDiv.classList.remove('text-orange-600', 'text-red-600', 'font-medium', 'font-semibold');
					counterDiv.classList.add('text-gray-500');
				}
			}
		}

		// Validate type name field (letters, numbers, spaces, and special chars)
		function validateTypeName(input) {
			const value = input.value;
			const errorDiv = document.getElementById('type_name-error');
			const pattern = /^[a-zA-Z0-9\s.,-]*$/;
			
			if (value && !pattern.test(value)) {
				input.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.remove('border-gray-300');
				errorDiv.textContent = 'Nama jenis aduan hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).';
				errorDiv.classList.remove('hidden');
				return false;
			} else {
				input.classList.remove('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.add('border-gray-300');
				errorDiv.classList.add('hidden');
				return true;
			}
		}

		// Form submission validation
		document.getElementById('complaintTypeForm').addEventListener('submit', function(e) {
			const typeName = document.getElementById('type_name');
			const description = document.getElementById('description');
			
			let isValid = true;
			
			// Validate type name
			if (!validateTypeName(typeName)) isValid = false;
			
			// Check max lengths
			if (typeName.value.length > 100) {
				typeName.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				const errorDiv = document.getElementById('type_name-error');
				errorDiv.textContent = 'Nama jenis aduan tidak boleh melebihi 100 aksara.';
				errorDiv.classList.remove('hidden');
				isValid = false;
			}
			
			if (description.value.length > 500) {
				description.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				const errorDiv = document.getElementById('description-error');
				errorDiv.textContent = 'Penerangan tidak boleh melebihi 500 aksara.';
				errorDiv.classList.remove('hidden');
				isValid = false;
			}
			
			if (!isValid) {
				e.preventDefault();
				// Scroll to first error
				const firstError = document.querySelector('.border-red-300');
				if (firstError) {
					firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
					firstError.focus();
				}
			}
		});
	</script>
	@endpush
@endsection

