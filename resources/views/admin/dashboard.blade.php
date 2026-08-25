@extends('admin.layouts.app')

@section('title', __('messages.home'))
@section('page_title', 'لوحة التحكم')

@section('content')
    <div class="space-y-6">

        {{-- ترحيب --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-6 text-white">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-2">
                        {{ __('messages.dashboard_welcome') }} {{ auth()->user()->name }}! 👋
                    </h2>
                    <p class="text-blue-100">
                        {{ __('messages.manage_site_easily') }}
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('home') }}" target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                        <i class="fas fa-external-link-alt {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.view_site') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- بطاقات الإحصائيات --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">

            @can('view products')
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ __('messages.products') }}</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['products'] }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-box text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            {{ __('messages.view_all') }} <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        </a>
                    </div>
                </div>
            @endcan

            @can('view categories')
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ __('messages.categories') }}</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['categories'] }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="fas fa-folder text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.categories.index') }}" class="text-sm text-green-600 hover:text-green-800 font-medium">
                            {{ __('messages.view_all') }} <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        </a>
                    </div>
                </div>
            @endcan

            @can('view brands')
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ __('messages.brands') }}</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['brands'] }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <i class="fas fa-tags text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.brands.index') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                            {{ __('messages.view_all') }} <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        </a>
                    </div>
                </div>
            @endcan

            @canany(['view content', 'view testimonials'])
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ __('messages.testimonials') }}</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['testimonials'] }}</p>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <i class="fas fa-comments text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-yellow-600 hover:text-yellow-800 font-medium">
                            {{ __('messages.view_all') }} <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        </a>
                    </div>
                </div>
            @endcanany

            @can('view messages')
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ __('messages.new_messages') }}</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['messages'] }}</p>
                        </div>
                        <div class="bg-red-100 rounded-full p-3">
                            <i class="fas fa-envelope text-red-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.contact-messages.index', ['filter' => 'unread']) }}" class="text-sm text-red-600 hover:text-red-800 font-medium">
                            {{ __('messages.view_all') }} <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        </a>
                    </div>
                </div>
            @endcan

            @can('view users')
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">{{ __('messages.users') }}</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['users'] }}</p>
                        </div>
                        <div class="bg-indigo-100 rounded-full p-3">
                            <i class="fas fa-users text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            {{ __('messages.view_all') }} <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        {{-- قسم الإجراءات السريعة --}}
        @canany(['create products', 'create categories', 'create brands', 'create testimonials', 'reply messages', 'edit settings'])
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-bolt text-yellow-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                    {{ __('messages.quick_actions') }}
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">

                    @can('create products')
                        <a href="{{ route('admin.products.index') }}" class="flex flex-col items-center p-4 bg-gray-50 hover:bg-blue-50 rounded-lg transition-colors group">
                            <div class="bg-blue-100 rounded-full p-3 mb-2 group-hover:bg-blue-200 transition-colors">
                                <i class="fas fa-plus text-blue-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 text-center">{{ __('messages.new_product') }}</span>
                        </a>
                    @endcan

                    @can('create categories')
                        <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center p-4 bg-gray-50 hover:bg-green-50 rounded-lg transition-colors group">
                            <div class="bg-green-100 rounded-full p-3 mb-2 group-hover:bg-green-200 transition-colors">
                                <i class="fas fa-folder-plus text-green-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 text-center">{{ __('messages.new_category') }}</span>
                        </a>
                    @endcan

                    @can('create brands')
                        <a href="{{ route('admin.brands.index') }}" class="flex flex-col items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-lg transition-colors group">
                            <div class="bg-purple-100 rounded-full p-3 mb-2 group-hover:bg-purple-200 transition-colors">
                                <i class="fas fa-tag text-purple-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 text-center">{{ __('messages.new_brand') }}</span>
                        </a>
                    @endcan

                    @canany(['view content', 'edit content'])
                        <a href="{{ route('admin.testimonials.index') }}" class="flex flex-col items-center p-4 bg-gray-50 hover:bg-yellow-50 rounded-lg transition-colors group">
                            <div class="bg-yellow-100 rounded-full p-3 mb-2 group-hover:bg-yellow-200 transition-colors">
                                <i class="fas fa-comment-dots text-yellow-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 text-center">{{ __('messages.new_testimonial') }}</span>
                        </a>
                    @endcanany

                    @can('view messages')
                        <a href="{{ route('admin.contact-messages.index') }}" class="flex flex-col items-center p-4 bg-gray-50 hover:bg-red-50 rounded-lg transition-colors group">
                            <div class="bg-red-100 rounded-full p-3 mb-2 group-hover:bg-red-200 transition-colors">
                                <i class="fas fa-envelope-open text-red-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 text-center">{{ __('messages.messages') }}</span>
                        </a>
                    @endcan

                    @can('view settings')
                        <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center p-4 bg-gray-50 hover:bg-indigo-50 rounded-lg transition-colors group">
                            <div class="bg-indigo-100 rounded-full p-3 mb-2 group-hover:bg-indigo-200 transition-colors">
                                <i class="fas fa-cog text-indigo-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700 text-center">{{ __('messages.settings') }}</span>
                        </a>
                    @endcan
                </div>
            </div>
        @endcanany

        {{-- قسم المعلومات الإضافية --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- آخر الرسائل --}}
            @can('view messages')
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-800">
                            <i class="fas fa-envelope text-red-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ __('messages.recent_messages') }}
                        </h3>
                        <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                            {{ __('messages.view_all') }}
                        </a>
                    </div>

                    <div class="space-y-3">
                        @if($recentMessages->count() > 0)
                            @foreach($recentMessages as $message)
                                <div class="p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-800">{{ $message->name }}</p>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->message, 50) }}</p>
                                        </div>
                                        <span class="text-xs text-gray-500 whitespace-nowrap {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                                <p class="text-gray-500">{{ __('messages.no_messages_now') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endcan

            {{-- معلومات النظام --}}
            @canany(['view settings', 'view users'])
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-info-circle text-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.system_info') }}
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">{{ __('messages.laravel_version') }}</span>
                            <span class="font-medium text-gray-800">{{ app()->version() }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">{{ __('messages.php_version') }}</span>
                            <span class="font-medium text-gray-800">{{ phpversion() }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">{{ __('messages.current_language') }}</span>
                            <span class="font-medium text-gray-800">
                            {{ app()->getLocale() === 'ar' ? __('messages.arabic') : __('messages.english') }}
                        </span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">{{ __('messages.timezone') }}</span>
                            <span class="font-medium text-gray-800">{{ config('app.timezone') }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600">{{ __('messages.system_status') }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle text-green-500 text-xs {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            {{ __('messages.running_normally') }}
                        </span>
                        </div>
                    </div>
                </div>
            @endcanany
        </div>
    </div>
@endsection
