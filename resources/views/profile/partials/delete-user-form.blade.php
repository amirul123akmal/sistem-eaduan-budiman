<section>
    <div class="bg-gradient-to-r from-red-50 to-red-100/50 border-b border-red-200 px-6 py-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-red-500 flex items-center justify-center">
                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Padam Akaun') }}
                </h2>
                <p class="text-xs text-gray-600">
                    {{ __('Setelah akaun anda dipadam, semua sumber dan data akan dipadam secara kekal.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="mb-6">
            <p class="text-sm text-gray-700 leading-relaxed">
                {{ __('Sebelum memadam akaun anda, sila muat turun sebarang data atau maklumat yang anda ingin simpan. Setelah akaun anda dipadam, semua sumber dan data akan dipadam secara kekal dan tidak boleh dipulihkan.') }}
            </p>
        </div>

        <button
            type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-600 to-red-700 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform"
        >
            <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative flex items-center gap-2">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ __('Padam Akaun') }}
            </div>
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ __('Adakah anda pasti?') }}
                    </h2>
                </div>

                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ __('Setelah akaun anda dipadam, semua sumber dan data akan dipadam secara kekal dan tidak boleh dipulihkan. Sila masukkan kata laluan anda untuk mengesahkan bahawa anda ingin memadam akaun secara kekal.') }}
                </p>
            </div>

            <div class="mt-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-red-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        {{ __('Kata Laluan') }} <span class="text-red-500">*</span>
                    </div>
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-xl border-2 border-gray-200 px-4 py-3 shadow-sm focus:border-red-500 focus:ring-2 focus:ring-red-500/20 sm:text-sm transition-all @error('password', 'userDeletion') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                    placeholder="{{ __('Masukkan kata laluan anda') }}"
                    required
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 border-t-2 border-gray-200 pt-6">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="rounded-xl border-2 border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all"
                >
                    {{ __('Batal') }}
                </button>

                <button
                    type="submit"
                    class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-600 to-red-700 px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-[1.02] transform"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ __('Padam Akaun') }}
                    </div>
                </button>
            </div>
        </form>
    </x-modal>
</section>
