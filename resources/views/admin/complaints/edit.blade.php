@extends('layouts.admin')

@section('content')
	<div class="mb-6">
		<h1 class="text-2xl font-semibold text-gray-900">Kemaskini Aduan</h1>
		<p class="mt-1 text-sm text-gray-500">Kemaskini maklumat aduan di bawah.</p>
	</div>

	<div class="rounded-lg border border-gray-200 bg-white shadow-sm">
		<form action="{{ route($isAdminPanel ? 'admin.panel.complaints.update' : 'admin.complaints.update', $complaint) }}" method="POST" class="p-6" enctype="multipart/form-data" id="complaintForm" novalidate>
			@csrf
			@method('PUT')

			<div class="grid gap-6 md:grid-cols-2">
				{{-- Nama --}}
				<div>
					<label for="name" class="block text-sm font-medium text-gray-700">
						Nama <span class="text-red-500">*</span>
					</label>
					<input 
						type="text" 
						name="name" 
						id="name" 
						value="{{ old('name', $complaint->name) }}" 
						required
						maxlength="100"
						pattern="[a-zA-Z\s]+"
						title="Nama hanya boleh mengandungi huruf dan ruang"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('name') border-red-300 @enderror"
						oninput="validateName(this)"
					/>
					<div id="name-error" class="mt-1 text-sm text-red-600 hidden"></div>
					@error('name')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
					<p class="mt-1 text-xs text-gray-500">Hanya huruf dan ruang dibenarkan</p>
				</div>

				{{-- Telefon --}}
				<div>
					<label for="phone_number" class="block text-sm font-medium text-gray-700">
						Telefon <span class="text-red-500">*</span>
					</label>
					<input 
						type="text" 
						name="phone_number" 
						id="phone_number" 
						value="{{ old('phone_number', $complaint->phone_number) }}" 
						required
						maxlength="20"
						pattern="[0-9]+"
						title="Nombor telefon hanya boleh mengandungi nombor"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('phone_number') border-red-300 @enderror"
						oninput="validatePhone(this)"
					/>
					<div id="phone_number-error" class="mt-1 text-sm text-red-600 hidden"></div>
					@error('phone_number')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
					<p class="mt-1 text-xs text-gray-500">Hanya nombor dibenarkan</p>
				</div>

				{{-- Alamat --}}
				<div class="md:col-span-2">
					<label for="address" class="block text-sm font-medium text-gray-700">
						Alamat <span class="text-red-500">*</span>
					</label>
					<textarea 
						name="address" 
						id="address" 
						rows="2"
						required
						maxlength="200"
						pattern="[a-zA-Z0-9\s.,-]+"
						title="Alamat hanya boleh mengandungi huruf, nombor, dan aksara khas (., -)"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('address') border-red-300 @enderror"
						oninput="updateCharCounter('address', 200); validateAddress(this)"
					>{{ old('address', $complaint->address) }}</textarea>
					<div class="mt-1 flex items-center justify-between">
						<div id="address-error" class="text-sm text-red-600 hidden"></div>
						<div id="address-counter" class="text-xs text-gray-500">
							<span id="address-count">0</span>/200 aksara
						</div>
					</div>
					@error('address')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				{{-- Jenis Aduan --}}
				<div>
					<label for="complaint_type_id" class="block text-sm font-medium text-gray-700">
						Jenis Aduan <span class="text-red-500">*</span>
					</label>
					<select 
						name="complaint_type_id" 
						id="complaint_type_id" 
						required
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('complaint_type_id') border-red-300 @enderror"
					>
						<option value="">Pilih Jenis Aduan</option>
						@foreach($complaintTypes as $type)
							<option value="{{ $type->id }}" {{ old('complaint_type_id', $complaint->complaint_type_id) == $type->id ? 'selected' : '' }}>
								{{ $type->type_name }}
							</option>
						@endforeach
					</select>
					@error('complaint_type_id')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				{{-- Status --}}
				<div>
					<label for="status" class="block text-sm font-medium text-gray-700">
						Status <span class="text-red-500">*</span>
					</label>
					<select 
						name="status" 
						id="status" 
						required
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-300 @enderror"
					>
						@foreach($statuses as $status)
							<option value="{{ $status }}" {{ old('status', $complaint->status) === $status ? 'selected' : '' }}>
								{{ ucfirst($status) }}
							</option>
						@endforeach
					</select>
					@error('status')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				{{-- Penerangan --}}
				<div class="md:col-span-2">
					<label for="description" class="block text-sm font-medium text-gray-700">
						Penerangan <span class="text-red-500">*</span>
					</label>
					<textarea 
						name="description" 
						id="description" 
						rows="4"
						required
						maxlength="500"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('description') border-red-300 @enderror"
						oninput="updateCharCounter('description', 500)"
					>{{ old('description', $complaint->description) }}</textarea>
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

				{{-- Gambar --}}
				<div class="md:col-span-2">
					<label for="image_path" class="block text-sm font-medium text-gray-700">
						Gambar
					</label>
					@if($complaint->hasImages())
						<div class="mb-4">
							<p class="mb-2 text-sm font-medium text-gray-700">Gambar Semasa:</p>
							<div class="grid grid-cols-2 gap-3 md:grid-cols-4">
								@foreach($complaint->image_path as $imagePath)
									<div class="relative group">
										{{-- Image Container --}}
										<div class="relative w-full rounded-md border border-gray-300 overflow-hidden bg-gray-100">
											{{-- Image --}}
											<div class="relative w-full h-24">
												<img src="{{ asset('storage/' . $imagePath) }}" alt="Gambar Aduan" class="w-full h-full object-cover">
												
												{{-- Delete Checkbox - Always on top, fully clickable, positioned first so it's above everything --}}
												<div class="absolute top-1 right-1 z-50">
													<label class="flex items-center gap-1 bg-white border-2 border-red-400 px-2 py-1 rounded-md text-xs cursor-pointer hover:bg-red-50 hover:border-red-500 shadow-lg transition-all" 
														   onclick="event.stopPropagation(); event.preventDefault();">
														<input type="checkbox" 
															   name="remove_images[]" 
															   value="{{ $imagePath }}" 
															   class="rounded border-gray-300 text-red-600 focus:ring-red-500 cursor-pointer w-3.5 h-3.5"
															   onclick="event.stopPropagation(); event.cancelBubble = true;">
														<span class="text-red-600 font-semibold text-[11px]">Padam</span>
													</label>
												</div>
												
												{{-- Preview Overlay - Clickable but excludes top-right corner --}}
												<a href="{{ asset('storage/' . $imagePath) }}" 
												   target="_blank" 
												   class="absolute left-0 bottom-0 right-0 top-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity z-10 rounded-md"
												   style="clip-path: polygon(0 0, calc(100% - 70px) 0, calc(100% - 70px) 35px, 100% 35px, 100% 100%, 0 100%);"
												   onclick="if(event.target.closest('.z-50')) { event.preventDefault(); event.stopPropagation(); return false; }">
													<svg class="h-6 w-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
													</svg>
												</a>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					@endif
					<input 
						type="file" 
						name="image_path[]" 
						id="image_path" 
						accept="image/*"
						multiple
						class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 @error('image_path') border-red-300 @enderror"
					/>
					<p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimum: 10 gambar, setiap satu 2MB</p>
					<div id="image-preview-container" class="mt-3 grid grid-cols-2 gap-3 md:grid-cols-4"></div>
					@error('image_path')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
					@error('image_path.*')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				{{-- Komen Admin --}}
				<div class="md:col-span-2">
					<label for="admin_comment" class="block text-sm font-medium text-gray-700">
						Komen Admin (Pilihan)
					</label>
					<textarea 
						name="admin_comment" 
						id="admin_comment" 
						rows="3"
						maxlength="500"
						class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors @error('admin_comment') border-red-300 @enderror"
						oninput="updateCharCounter('admin_comment', 500)"
					>{{ old('admin_comment', $complaint->admin_comment) }}</textarea>
					<div class="mt-1 flex items-center justify-between">
						<div id="admin_comment-error" class="text-sm text-red-600 hidden"></div>
						<div id="admin_comment-counter" class="text-xs text-gray-500">
							<span id="admin_comment-count">0</span>/500 aksara
						</div>
					</div>
					@error('admin_comment')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>
			</div>

			{{-- Actions --}}
			<div class="mt-6 flex items-center justify-end gap-3 border-t border-gray-200 pt-6">
				<a href="{{ route($isAdminPanel ? 'admin.panel.complaints.index' : 'admin.complaints.index') }}" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Batal
				</a>
				<button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Kemaskini
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
				window.location.href = '{{ route($isAdminPanel ? "admin.panel.complaints.index" : "admin.complaints.index") }}';
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
			updateCharCounter('address', 200);
			updateCharCounter('description', 500);
			updateCharCounter('admin_comment', 500);
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

		// Validate name field (letters and spaces only)
		function validateName(input) {
			const value = input.value;
			const errorDiv = document.getElementById('name-error');
			const pattern = /^[a-zA-Z\s]*$/;
			
			if (value && !pattern.test(value)) {
				input.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.remove('border-gray-300');
				errorDiv.textContent = 'Nama hanya boleh mengandungi huruf dan ruang.';
				errorDiv.classList.remove('hidden');
				return false;
			} else {
				input.classList.remove('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.add('border-gray-300');
				errorDiv.classList.add('hidden');
				return true;
			}
		}

		// Validate phone field (numbers only)
		function validatePhone(input) {
			const value = input.value;
			const errorDiv = document.getElementById('phone_number-error');
			const pattern = /^[0-9]*$/;
			
			if (value && !pattern.test(value)) {
				input.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.remove('border-gray-300');
				errorDiv.textContent = 'Nombor telefon hanya boleh mengandungi nombor.';
				errorDiv.classList.remove('hidden');
				return false;
			} else {
				input.classList.remove('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.add('border-gray-300');
				errorDiv.classList.add('hidden');
				return true;
			}
		}

		// Validate address field (letters, numbers, and special chars)
		function validateAddress(input) {
			const value = input.value;
			const errorDiv = document.getElementById('address-error');
			const pattern = /^[a-zA-Z0-9\s.,-]*$/;
			
			if (value && !pattern.test(value)) {
				input.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.remove('border-gray-300');
				errorDiv.textContent = 'Alamat hanya boleh mengandungi huruf, nombor, dan aksara khas (., -).';
				errorDiv.classList.remove('hidden');
				return false;
			} else {
				input.classList.remove('border-red-300', 'ring-2', 'ring-red-200');
				input.classList.add('border-gray-300');
				errorDiv.classList.add('hidden');
				return true;
			}
		}

		// Image preview functionality
		document.getElementById('image_path').addEventListener('change', function(e) {
			const container = document.getElementById('image-preview-container');
			container.innerHTML = '';
			
			if (this.files && this.files.length > 0) {
				Array.from(this.files).forEach((file, index) => {
					if (file.type.startsWith('image/')) {
						const reader = new FileReader();
						reader.onload = function(e) {
							const div = document.createElement('div');
							div.className = 'relative group';
							div.innerHTML = `
								<img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-24 object-cover rounded-md border border-gray-300">
								<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-opacity rounded-md flex items-center justify-center">
									<span class="text-white text-xs opacity-0 group-hover:opacity-100">Gambar ${index + 1}</span>
								</div>
							`;
							container.appendChild(div);
						};
						reader.readAsDataURL(file);
					}
				});
			}
		});

		// Form submission validation
		document.getElementById('complaintForm').addEventListener('submit', function(e) {
			const name = document.getElementById('name');
			const phone = document.getElementById('phone_number');
			const address = document.getElementById('address');
			const description = document.getElementById('description');
			const adminComment = document.getElementById('admin_comment');
			
			let isValid = true;
			
			// Validate all fields
			if (!validateName(name)) isValid = false;
			if (!validatePhone(phone)) isValid = false;
			if (!validateAddress(address)) isValid = false;
			
			// Check max lengths
			if (address.value.length > 200) {
				address.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				const errorDiv = document.getElementById('address-error');
				errorDiv.textContent = 'Alamat tidak boleh melebihi 200 aksara.';
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
			
			if (adminComment.value.length > 500) {
				adminComment.classList.add('border-red-300', 'ring-2', 'ring-red-200');
				const errorDiv = document.getElementById('admin_comment-error');
				errorDiv.textContent = 'Komen admin tidak boleh melebihi 500 aksara.';
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

		// Ensure delete checkboxes are always clickable
		document.addEventListener('DOMContentLoaded', function() {
			// Find all delete checkboxes
			const deleteCheckboxes = document.querySelectorAll('input[name="remove_images[]"]');
			
			deleteCheckboxes.forEach(function(checkbox) {
				// Make sure checkbox and its label are always on top
				const label = checkbox.closest('label');
				if (label) {
					label.style.zIndex = '9999';
					label.style.position = 'relative';
					
					// Prevent any parent click handlers from interfering
					label.addEventListener('click', function(e) {
						e.stopPropagation();
						e.preventDefault();
						checkbox.checked = !checkbox.checked;
					});
					
					checkbox.addEventListener('click', function(e) {
						e.stopPropagation();
						e.cancelBubble = true;
					});
				}
			});
			
			// Prevent preview links from blocking checkbox clicks
			const previewLinks = document.querySelectorAll('a[target="_blank"]');
			previewLinks.forEach(function(link) {
				link.addEventListener('click', function(e) {
					// If click is on or near a delete checkbox, don't open preview
					const deleteBtn = e.target.closest('.z-50');
					if (deleteBtn) {
						e.preventDefault();
						e.stopPropagation();
						return false;
					}
				});
			});
		});
	</script>
	@endpush
@endsection

