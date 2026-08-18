<header class="bg-white shadow-sm border-b sticky top-0 z-30">
    <div class="flex items-center justify-between px-4 md:px-6 py-4">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-gray-900">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <div>
                <h1 class="text-lg md:text-xl font-semibold text-gray-800">@yield('page_title', 'لوحة التحكم')</h1>
                <p class="text-xs text-gray-500 hidden md:block">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 md:gap-4">
            <form action="{{ route('locale.switch') }}" method="POST" class="hidden md:inline">
                @csrf
                <select name="locale" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="ar" {{ app()->getLocale() === 'ar' ? 'selected' : '' }}>العربية</option>
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                </select>
            </form>

            <form action="{{ route('locale.switch') }}" method="POST" class="md:hidden">
                @csrf
                <button type="submit" name="locale" value="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}"
                        class="text-gray-600 hover:text-gray-900 p-2">
                    <i class="fas fa-globe text-lg"></i>
                </button>
            </form>

            <a href="{{ route('home') }}" target="_blank"
               class="hidden md:inline-flex items-center px-3 py-2 text-gray-600 hover:text-gray-900">
                <i class="fas fa-external-link-alt"></i>
            </a>

            <div class="relative" x-data="{ open: false }">
                @php
                    $userName = auth()->user()->getTranslation('name', app()->getLocale());

                    if (empty($userName)) {
                        $userName = auth()->user()->getTranslation('name', 'ar');
                    }
                @endphp

                <button onclick="toggleUserMenu()" class="flex items-center gap-2 hover:bg-gray-100 rounded-lg p-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                        {{ mb_substr($userName, 0, 1) }}
                    </div>

                    <span class="hidden md:block text-sm font-medium text-gray-700">
                        {{ $userName }}
                    </span>

                    <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block"></i>
                </button>
                <div id="userDropdown"
                     class="hidden absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-user w-5"></i>
                        <span>{{ __('messages.profile') }}</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-cog w-5"></i>
                        <span>{{ __('messages.settings') }}</span>
                    </a>
                    <hr class="my-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>{{ __('messages.logout') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    }

    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('userDropdown');
        const button = event.target.closest('button');

        if (dropdown && !dropdown.classList.contains('hidden')) {
            if (!button || !button.onclick || button.onclick.toString().indexOf('toggleUserMenu') === -1) {
                dropdown.classList.add('hidden');
            }
        }
    });
</script>
