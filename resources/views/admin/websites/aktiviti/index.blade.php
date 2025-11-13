@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
                <p class="text-sm text-gray-600">Selamat datang. Anda mempunyai akses untuk mengurus sistem e-Aduan sahaja.
                </p>
            </div>
            <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg bg-[#F0F7F0] border border-[#F0F7F0]">
                <div class="w-2 h-2 rounded-full bg-[#132A13] animate-pulse"></div>
                <span class="text-sm font-medium text-[#132A13]">Sistem Aktif</span>
            </div>
        </div>
    </div>
    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Senarai Aktiviti Kampung</h2>
        </div>

        {{-- search --}}
        <div class="mb-6">
            <label for="search" class="sr-only">Cari Aktiviti</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 dark:text-gray-500" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                </div>
                <input type="text" id="search" name="search"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm focus:border-secondary-500 focus:ring-secondary-500 dark:text-white text-sm"
                    placeholder="Cari mengikut Nama Aktiviti">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg overflow-hidden shadow-md">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Nama Aktiviti</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Tarikh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Penandaan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Tindakan</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($activities as $index => $activity)
                        @php
                            $images = array_filter(explode(',', $activity->image_path));
                            $imagePaths = array_map(fn($img) => config('app.website_url') . '/storage/' . trim($img), $images);
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $loop->iteration }}
                            </td>

                            {{-- CAROUSEL --}}
                            <td class="px-6 py-4">
                                <div
                                    class="w-36 h-24 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700 relative group carousel hover:shadow-lg transition">
                                    @if (!empty($imagePaths))
                                        <div class="carousel-container flex transition-transform duration-300 h-full" data-index="0">
                                            @foreach ($imagePaths as $img)
                                                <img src="{{ $img }}" alt="Gambar Aktiviti" class="w-full h-full object-cover flex-shrink-0">
                                            @endforeach
                                        </div>

                                        @if (count($imagePaths) > 1)
                                            <button
                                                class="carousel-btn-prev absolute left-0 top-1/2 -translate-y-1/2 p-1 bg-black/40 hover:bg-black/70 text-white opacity-0 group-hover  carousel transition-opacity rounded-r-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m15 18-6-6 6-6" />
                                                </svg>
                                            </button>
                                            <button
                                                class="carousel-btn-next absolute right-0 top-1/2 -translate-y-1/2 p-1 bg-black/40 hover:bg-black/70 text-white opacity-0 group-hover  carousel transition-opacity rounded-l-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m9 18 6-6-6-6" />
                                                </svg>
                                            </button>
                                            <div class="absolute bottom-1 right-1 text-xs px-1 bg-black/50 text-white rounded carousel-indicator">
                                                1/{{ count($imagePaths) }}
                                            </div>
                                        @else
                                            <div class="absolute bottom-1 right-1 text-xs px-1 bg-black/50 text-white rounded">
                                                1/1
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                                            Tiada Gambar
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $activity->title }}
                            </td>
                            <td class="px-6 py-4 max-w-xs text-sm text-gray-900 dark:text-gray-100 truncate">
                                {{ $activity->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ \Carbon\Carbon::parse($activity->activity_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{-- Tags here --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- Actions here --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
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

            document.querySelectorAll('.carousel-container').forEach(carousel => {
                const container = carousel.closest('.group');
                const images = carousel.querySelectorAll('img');
                const totalImages = images.length;

                if (totalImages <= 1) return;

                const prevBtn = container.querySelector('.carousel-btn-prev');
                const nextBtn = container.querySelector('.carousel-btn-next');
                const indicator = container.querySelector('.carousel-indicator');

                const navigate = (direction) => {
                    let currentIndex = parseInt(carousel.dataset.index);
                    currentIndex += direction;

                    if (currentIndex >= totalImages) currentIndex = 0;
                    if (currentIndex < 0) currentIndex = totalImages - 1;

                    carousel.dataset.index = currentIndex;
                    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                    indicator.textContent = `${currentIndex + 1}/${totalImages}`;
                };

                prevBtn?.addEventListener('click', () => navigate(-1));
                nextBtn?.addEventListener('click', () => navigate(1));
            });
        </script>
    @endpush
@endsection
