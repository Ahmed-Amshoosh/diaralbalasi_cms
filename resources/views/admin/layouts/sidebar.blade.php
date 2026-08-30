<aside id="sidebar"
       class="sidebar fixed lg:static inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0' : 'left-0' }} z-50 w-64 bg-gray-900 text-white overflow-y-auto transform -translate-x-full lg:translate-x-0 lg:inset-auto transition-transform duration-300">
    <h2 class="text-xl pt-5 px-5 font-bold truncate flex items-center gap-2">
        @php
            $favicon = \App\Models\Setting::get('favicon');
            $siteNameRaw = \App\Models\Setting::get('site_name', __('messages.site_name'));
            $siteName = is_array($siteNameRaw)
                ? ($siteNameRaw[app()->getLocale()] ?? $siteNameRaw['ar'] ?? __('messages.site_name'))
                : $siteNameRaw;
        @endphp
        @if($favicon)
            <img src="{{ asset('storage/' . $favicon) }}" alt="{{ $siteName }}" class="w-7 h-7 object-contain rounded">
        @else
            <i class="fas fa-cubes text-blue-400"></i>
        @endif
        <span>{{ $siteName }}</span>
    </h2>
    <nav class="p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : '' }}">
            <i class="fas fa-home w-6"></i>
            <span>{{ __('messages.home') }}</span>
        </a>
        @canany(['view content', 'view partners', 'view brands'])
            <div class="pt-4">
                <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                    {{ __('messages.page_management') }}
                </p>
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.hero.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.hero.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-image w-6"></i>
                        <span>{{ __('messages.hero') }}</span>
                    </a>
                @endcanany
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.marquee.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.marquee.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-bullhorn w-6"></i>
                        <span>{{ __('messages.marquee_management') }}</span>
                    </a>
                @endcanany
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.about.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.about.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-info-circle w-6"></i>
                        <span>{{ __('messages.about_management') }}</span>
                    </a>
                @endcanany
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.hero-stats.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.hero-stats.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-chart-bar w-6"></i>
                        <span>{{ __('messages.hero_stats_management') }}</span>
                    </a>
                @endcanany
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.why-us.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.why-us.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-check-circle w-6"></i>
                        <span>{{ __('messages.why_us_section_management') }}</span>
                    </a>
                @endcanany
                @can('view partners')
                    <a href="{{ route('admin.partners.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.partners.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-handshake w-6"></i>
                        <span>{{ __('messages.partners') }}</span>
                    </a>
                @endcan
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-comments w-6"></i>
                        <span>{{ __('messages.testimonials_management') }}</span>
                    </a>
                @endcanany
                @canany(['view content', 'edit content'])
                    <a href="{{ route('admin.cta.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.cta.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-bullseye w-6"></i>
                        <span>{{ __('messages.cta_management') }}</span>
                    </a>
                @endcanany
            </div>
        @endcanany
        @canany(['view categories', 'view brands', 'view products'])
            <div class="pt-4">
                <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                    {{ __('messages.catalog') }}
                </p>
                @can('view categories')
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-folder w-6"></i>
                        <span>{{ __('messages.categories') }}</span>
                    </a>
                @endcan
                @can('view brands')
                    <a href="{{ route('admin.brands.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.brands.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-tags w-6"></i>
                        <span>{{ __('messages.brands') }}</span>
                    </a>
                @endcan
                @can('view products')
                    <a href="{{ route('admin.products.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-box w-6"></i>
                        <span>{{ __('messages.products') }}</span>
                    </a>
                @endcan
            </div>
        @endcanany
        @can('view messages')
            <div class="pt-4">
                <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                    {{ __('messages.communication') }}
                </p>
                <a href="{{ route('admin.contact-messages.index') }}"
                   class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-800 text-white' : '' }}">
                    <i class="fas fa-envelope w-6"></i>
                    <span>{{ __('messages.contact_messages') }}</span>
                </a>
            </div>
        @endcan
        @canany(['view seo', 'view users', 'view settings'])
            <div class="pt-4">
                <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                    {{ __('messages.administration') }}
                </p>
                @can('view seo')
                    <a href="{{ route('admin.seo.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.seo.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-search w-6"></i>
                        <span>{{ __('messages.seo_management') }}</span>
                    </a>
                @endcan
                @can('view users')
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-users w-6"></i>
                        <span>{{ __('messages.users') }}</span>
                    </a>
                @endcan
                @can('view settings')
                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800 text-white' : '' }}">
                        <i class="fas fa-cog w-6"></i>
                        <span>{{ __('messages.settings') }}</span>
                    </a>
                @endcan
            </div>
        @endcanany
    </nav>
</aside>
