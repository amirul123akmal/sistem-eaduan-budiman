<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#F0F7F0] via-white to-[#F0F7F0] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            {{-- Main Card --}}
            <div class="bg-white/90 backdrop-blur-sm p-8 sm:p-10 rounded-3xl shadow-2xl border border-[#2F4F2F]/10">
                {{-- Header Section --}}
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="absolute inset-0 bg-[#132A13]/10 rounded-full blur-xl"></div>
                            <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#132A13] to-[#2F4F2F] flex items-center justify-center shadow-lg">
                                <i class="fa fa-user-shield text-3xl text-white" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-3 tracking-tight bg-gradient-to-r from-[#132A13] via-[#2F4F2F] to-[#132A13] bg-clip-text text-transparent">
                        Log Masuk
                    </h1>
                    <p class="text-[#2F4F2F]/70 text-base font-medium">
                        Sila log masuk ke akaun admin anda
                    </p>
                </div>

                {{-- Form Section --}}
                <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-6">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-[#132A13]">
                            Emel <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa fa-envelope text-[#2F4F2F]/50" aria-hidden="true"></i>
                            </div>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                autocomplete="username"
                                placeholder="nama@email.com"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-200 focus:ring-[#132A13] focus:border-[#132A13] @enderror bg-white text-sm transition-all"
                            />
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-[#132A13]">
                            Kata Laluan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa fa-lock text-[#2F4F2F]/50" aria-hidden="true"></i>
                            </div>
                            <input 
                                id="password" 
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 @error('password') border-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-200 focus:ring-[#132A13] focus:border-[#132A13] @enderror bg-white text-sm transition-all"
                            />
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-[#132A13] shadow-sm focus:ring-[#132A13] cursor-pointer" 
                                name="remember"
                            />
                            <span class="ms-2 text-sm text-[#2F4F2F]/70 font-medium">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-[#132A13] hover:text-[#2F4F2F] font-semibold transition-colors" href="{{ route('password.request') }}">
                                Lupa kata laluan?
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#132A13] to-[#2F4F2F] p-4 text-white shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform"
                        >
                            <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-center justify-center gap-3">
                                <i class="fa fa-sign-in-alt text-lg" aria-hidden="true"></i>
                                <span class="text-base font-bold">Log Masuk</span>
                            </div>
                        </button>
                    </div>
                </form>

                {{-- Navigation Buttons --}}
                <div class="mt-6 pt-6 border-t border-[#2F4F2F]/10">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ config('app.website_url') }}" 
                            target="_blank"
                            class="group flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-[#F0F7F0] bg-[#F0F7F0]/50 text-[#132A13] text-sm font-semibold shadow-sm transition-all duration-300 hover:bg-[#132A13] hover:text-white hover:border-[#132A13] hover:shadow-md active:scale-95 touch-manipulation">
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            <span>Laman Utama</span>
                        </a>
                        <a href="{{ route('public.home') }}" 
                            class="group flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-[#F0F7F0] bg-[#F0F7F0]/50 text-[#132A13] text-sm font-semibold shadow-sm transition-all duration-300 hover:bg-[#132A13] hover:text-white hover:border-[#132A13] hover:shadow-md active:scale-95 touch-manipulation">
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Sistem e-Aduan</span>
                        </a>
                    </div>
                </div>

                {{-- Footer Info --}}
                <div class="mt-6 pt-6 border-t border-[#2F4F2F]/10">
                    <p class="text-xs text-center text-[#2F4F2F]/60">
                        <i class="fa fa-shield-alt mr-1" aria-hidden="true"></i>
                        Akses terhad untuk kakitangan pentadbiran sahaja
                    </p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Show error messages from validation
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Ralat Log Masuk!',
                html: '<ul class="text-left list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                confirmButtonColor: '#dc2626'
            });
        @endif

        // Show success message if redirected after logout
        @if (session('status'))
            Swal.fire({
                icon: 'info',
                title: 'Maklumat',
                text: '{{ session('status') }}',
                confirmButtonColor: '#132A13'
            });
        @endif
    </script>
    @endpush
</x-guest-layout>
