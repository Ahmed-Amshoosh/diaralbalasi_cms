<aside id="sidebar"
       class="sidebar fixed lg:static inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0' : 'left-0' }} z-50 w-64 bg-gray-900 text-white overflow-y-auto transform -translate-x-full lg:translate-x-0 lg:inset-auto">

    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between p-4 border-b border-gray-800">
        <h2 class="text-xl font-bold truncate">
            <i class="fas fa-cubes ml-2 text-blue-400"></i>
            {{ __('messages.site_name') }}
        </h2>

        {{-- Close Button (فقط للشاشات الصغيرة) --}}
        <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white p-1">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="p-4 space-y-1">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : '' }}">
            <i class="fas fa-home w-6"></i>
            <span>{{ __('messages.home') }}</span>
        </a>

        {{-- الصفحة الرئيسية --}}
        <div class="pt-4">
            <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                إدارة الصفحة
            </p>
            <a href="{{ route('admin.hero.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.hero.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-image w-6"></i>
                <span>{{ __('messages.hero') }}</span>
            </a>
            <a href="{{ route('admin.marquee.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.marquee.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-bullhorn w-6"></i>
                <span>{{ __('messages.marquee_management') }}</span>
            </a>

            <a href="{{ route('admin.about.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.about.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-info-circle w-6"></i>
                <span>{{ __('messages.about_management') }}</span>
            </a>
            <a href="{{ route('admin.hero-stats.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.statistics.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-chart-bar w-6"></i>
                <span>{{__('messages.hero_stats_management')}}</span>
            </a>
            <a href="{{ route('admin.why-us.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.why-us.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-check-circle w-6"></i>
                <span>{{__('messages.why_us_section_management')}}</span>
            </a>
            <a href="{{ route('admin.partners.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.why-us.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-check-circle w-6"></i>
                <span>{{__('messages.partners')}}</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.why-us.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-check-circle w-6"></i>
                <span>{{__('messages.testimonials_management')}}</span>
            </a>
        </div>

        {{-- الكتالوج --}}
        <div class="pt-4">
            <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                الكتالوج
            </p>
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-folder w-6"></i>
                <span>التصنيفات</span>
            </a>
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.brands.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-tags w-6"></i>
                <span>العلامات التجارية</span>
            </a>
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-box w-6"></i>
                <span>المنتجات</span>
            </a>
        </div>

        {{-- آراء العملاء --}}
        <div class="pt-4">
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-comments w-6"></i>
                <span>آراء العملاء</span>
            </a>
        </div>

        {{-- التواصل --}}
        <div class="pt-4">
            <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                التواصل
            </p>
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.contact.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-address-book w-6"></i>
                <span>بيانات التواصل</span>
            </a>
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-envelope w-6"></i>
                <span>الرسائل</span>
                <span class="mr-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">3</span>
            </a>
        </div>

        {{-- SEO --}}
        <div class="pt-4">
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.seo.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-search w-6"></i>
                <span>SEO</span>
            </a>
        </div>

        {{-- الإدارة --}}
        <div class="pt-4">
            <p class="px-4 text-xs text-gray-500 uppercase tracking-wider mb-2">
                الإدارة
            </p>
            <a href=""
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-users w-6"></i>
                <span>المستخدمون</span>
            </a>
            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800 text-white' : '' }}">
                <i class="fas fa-cog w-6"></i>
                <span>الإعدادات</span>
            </a>
        </div>
    </nav>
</aside>
