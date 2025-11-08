@extends('layouts.admin')

@section('content')
	<div class="mb-6">
		<h1 class="text-2xl font-semibold text-gray-900">Tambah Jenis Aduan</h1>
		<p class="mt-1 text-sm text-gray-500">Isi maklumat di bawah untuk menambah jenis aduan baharu.</p>
	</div>

	<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
		<form action="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaint-types.store' : 'admin.complaint-types.store') }}" method="POST" class="p-6" id="complaintTypeForm" novalidate>
			@csrf

			<div class="space-y-6">
				{{-- Nama Jenis Aduan --}}
				<div>
					<label for="type_name" class="block text-sm font-medium text-gray-700">
						Nama Jenis Aduan <span class="text-red-500">*</span>
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
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('type_name') border-red-300 @enderror"
						placeholder="Contoh: Masalah Jalan Raya"
						oninput="validateTypeName(this); updateCharCounter('type_name', 100)"
					/>
					<div class="mt-1 flex items-center justify-between">
						<div id="type_name-error" class="text-sm text-red-600 hidden"></div>
						<div id="type_name-counter" class="text-xs text-gray-500">
							<span id="type_name-count">0</span>/100 aksara
						</div>
					</div>
					@error('type_name')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
					<p class="mt-1 text-xs text-gray-500">Hanya huruf, nombor, dan aksara khas (., -) dibenarkan</p>
				</div>

				{{-- Penerangan --}}
				<div>
					<label for="description" class="block text-sm font-medium text-gray-700">
						Penerangan
					</label>
					<textarea 
						name="description" 
						id="description" 
						rows="4"
						maxlength="500"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('description') border-red-300 @enderror"
						placeholder="Masukkan penerangan jenis aduan ini (pilihan)"
						oninput="updateCharCounter('description', 500)"
					>{{ old('description') }}</textarea>
					<div class="mt-1 flex items-center justify-between">
						<div id="description-error" class="text-sm text-red-600 hidden"></div>
						<div id="description-counter" class="text-xs text-gray-500">
							<span id="description-count">0</span>/500 aksara
						</div>
					</div>
					@error('description')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>
			</div>

			{{-- Actions --}}
			<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-200 pt-6">
				<a href="{{ route(isset($isAdminPanel) && $isAdminPanel ? 'admin.panel.complaint-types.index' : 'admin.complaint-types.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Batal
				</a>
				<button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Simpan
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

