@extends('admin.layouts.app')
@section('title', __('messages.settings_title'))
@section('page_title', __('messages.settings_page_title'))

@section('content')
    <div class="mx-auto">

        {{-- Tabs Navigation --}}
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="flex border-b overflow-x-auto">
                <button onclick="showTab('general')" id="tab-general"
                        class="tab-btn px-6 py-4 font-medium text-blue-600 border-b-2 border-blue-600 whitespace-nowrap transition-colors">
                    <i class="fas fa-info-circle ml-2"></i> {{ __('messages.tab_general') }}
                </button>
                <button onclick="showTab('company')" id="tab-company"
                        class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-gray-800 whitespace-nowrap transition-colors">
                    <i class="fas fa-building ml-2"></i> {{ __('messages.tab_company') }}
                </button>
                <button onclick="showTab('social')" id="tab-social"
                        class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-gray-800 whitespace-nowrap transition-colors">
                    <i class="fas fa-share-alt ml-2"></i> {{ __('messages.tab_social') }}
                </button>
            </div>
        </div>
        <div id="content-general" class="tab-content bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('admin.settings.updateGeneral') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-3 border-b">
                    <i class="fas fa-info-circle text-blue-500 ml-2"></i> {{ __('messages.tab_general') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.site_name_ar') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="site_name_ar" value="{{ old('site_name_ar', $settings['site_name'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" >
                        @error('site_name_ar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.site_name_en') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="site_name_en" value="{{ old('site_name_en', $settings['site_name'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" >
                        @error('site_name_en') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.site_desc_ar') }}</label>
                        <textarea name="site_description_ar" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('site_description_ar', $settings['site_description'] ?? '') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.site_desc_en') }}</label>
                        <textarea name="site_description_en" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('site_description_en', $settings['site_description'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.site_logo') }}</label>
                        @if(isset($settings['logo']) && $settings['logo'])
                            <div class="mb-3"><img src="{{ asset('storage/' . $settings['logo']) }}" class="h-30 w-auto object-contain rounded-lg border border-gray-200 p-1"></div>
                        @endif
                        <label for="logo" class="flex items-center gap-3 w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition-all">
                            <i class="fas fa-cloud-upload-alt text-blue-500 text-xl"></i>
                            <span id="logoFileName" class="text-sm text-gray-600">{{ __('messages.choose_file') }}</span>
                        </label>
                        <input type="file" id="logo" name="logo" accept="image/*" class="hidden">
                        @error('logo') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.site_favicon') }}</label>
                        @if(isset($settings['favicon']) && $settings['favicon'])
                            <div class="mb-3"><img src="{{ asset('storage/' . $settings['favicon']) }}" class="h-32 w-25 object-contain rounded-lg border border-gray-200 p-1"></div>
                        @endif
                        <label for="favicon" class="flex items-center gap-3 w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-purple-50 hover:border-purple-400 transition-all">
                            <i class="fas fa-cloud-upload-alt text-purple-500 text-xl"></i>
                            <span id="faviconFileName" class="text-sm text-gray-600">{{ __('messages.choose_file') }}</span>
                        </label>
                        <input type="file" id="favicon" name="favicon" accept="image/*" class="hidden">
                        @error('favicon') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-save ml-2"></i> {{ __('messages.save_settings') }}
                    </button>
                </div>
            </form>
        </div>
        <div id="content-company" class="tab-content bg-white rounded-lg shadow-sm p-6 hidden">
            <form action="{{ route('admin.settings.updateCompany') }}" method="POST">
                @csrf @method('PUT')
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-3 border-b">
                    <i class="fas fa-building text-blue-500 ml-2"></i> {{ __('messages.tab_company') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.company_name_ar') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name_ar" value="{{ old('company_name_ar', $settings['company_name'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" >
                        @error('company_name_ar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.company_name_en') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name_en" value="{{ old('company_name_en', $settings['company_name'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" >
                        @error('company_name_en') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.phone') }}</label>
                        <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.mobile') }}</label>
                        <input type="text" name="mobile" value="{{ old('mobile', $settings['mobile'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email') }}</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.address_ar') }}</label>
                        <textarea name="address_ar" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('address_ar', $settings['address'] ?? '') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.address_en') }}</label>
                        <textarea name="address_en" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('address_en', $settings['address'] ?? '') }}</textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-save ml-2"></i> {{ __('messages.save_settings') }}
                    </button>
                </div>
            </form>
        </div>

        <div id="content-social" class="tab-content bg-white rounded-lg shadow-sm p-6 hidden">
            <form action="{{ route('admin.settings.updateSocial') }}" method="POST">
                @csrf @method('PUT')
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-3 border-b">
                    <i class="fas fa-share-alt text-blue-500 ml-2"></i> {{ __('messages.social_media') }}
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fab fa-whatsapp text-green-500 ml-2"></i> WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" placeholder="966500000000+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fab fa-instagram text-pink-500 ml-2"></i> Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="https://instagram.com/username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fab fa-facebook text-blue-600 ml-2"></i> Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" placeholder="https://facebook.com/page" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fab fa-x-twitter text-gray-800 ml-2"></i> X (Twitter)</label>
                        <input type="text" name="twitter" value="{{ old('twitter', $settings['twitter'] ?? '') }}" placeholder="https://twitter.com/username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fab fa-linkedin text-blue-700 ml-2"></i> LinkedIn</label>
                        <input type="text" name="linkedin" value="{{ old('linkedin', $settings['linkedin'] ?? '') }}" placeholder="https://linkedin.com/company" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fab fa-youtube text-red-600 ml-2"></i> YouTube</label>
                        <input type="text" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" placeholder="https://youtube.com/channel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-save ml-2"></i> {{ __('messages.save_settings') }}
                    </button>
                </div>
            </form>
        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // 1. دالة التبويب
                window.showTab = function(tabName) {
                    document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
                    document.querySelectorAll('.tab-btn').forEach(btn => {
                        btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                        btn.classList.add('text-gray-600');
                    });
                    document.getElementById('content-' + tabName).classList.remove('hidden');
                    const activeBtn = document.getElementById('tab-' + tabName);
                    activeBtn.classList.remove('text-gray-600');
                    activeBtn.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                }

                // 2. تحديث اسم ملف الشعار
                const logoInput = document.getElementById('logo');
                const logoFileName = document.getElementById('logoFileName');
                if (logoInput) {
                    logoInput.addEventListener('change', function () {
                        logoFileName.textContent = this.files.length > 0 ? this.files[0].name : "{{ __('messages.no_file_chosen') }}";
                    });
                }

                // 3. تحديث اسم ملف الأيقونة
                const faviconInput = document.getElementById('favicon');
                const faviconFileName = document.getElementById('faviconFileName');
                if (faviconInput) {
                    faviconInput.addEventListener('change', function () {
                        faviconFileName.textContent = this.files.length > 0 ? this.files[0].name : "{{ __('messages.no_file_chosen') }}";
                    });
                }

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", "{{ __('messages.validation_error') ?? 'خطأ في التحقق' }}", {
                    positionClass: "{{ app()->getLocale() === 'ar' ? 'toast-top-left' : 'toast-top-right' }}",
                    timeOut: 4000
                });
                @endforeach
                @endif

            });
        </script>
    @endpush
@endsection
