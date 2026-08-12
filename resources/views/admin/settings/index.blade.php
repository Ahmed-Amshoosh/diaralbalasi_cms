@extends('admin.layouts.app')

@section('title', 'الإعدادات')
@section('page_title', 'إعدادات الموقع')

@section('content')
    <div class="max-w-5xl mx-auto">

        {{-- Tabs Navigation --}}
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="flex border-b overflow-x-auto">
                <button onclick="showTab('general')"
                        id="tab-general"
                        class="tab-btn px-6 py-4 font-medium text-blue-600 border-b-2 border-blue-600 whitespace-nowrap">
                    <i class="fas fa-info-circle ml-2"></i>
                    معلومات الموقع
                </button>
                <button onclick="showTab('company')"
                        id="tab-company"
                        class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-gray-800 whitespace-nowrap">
                    <i class="fas fa-building ml-2"></i>
                    بيانات الشركة
                </button>
                <button onclick="showTab('social')"
                        id="tab-social"
                        class="tab-btn px-6 py-4 font-medium text-gray-600 hover:text-gray-800 whitespace-nowrap">
                    <i class="fas fa-share-alt ml-2"></i>
                    وسائل التواصل
                </button>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tab: General --}}
            <div id="content-general" class="tab-content bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-3 border-b">
                    <i class="fas fa-info-circle text-blue-500 ml-2"></i>
                    معلومات الموقع
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- اسم الموقع عربي --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            اسم الموقع (عربي) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="site_name_ar"
                               value="{{ $settings['site_name']['ar'] ?? old('site_name_ar') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        @error('site_name_ar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- اسم الموقع إنجليزي --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Site Name (English) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="site_name_en"
                               value="{{ $settings['site_name']['en'] ?? old('site_name_en') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        @error('site_name_en')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- الوصف عربي --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            وصف الموقع (عربي)
                        </label>
                        <textarea name="site_description_ar" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $settings['site_description']['ar'] ?? old('site_description_ar') }}</textarea>
                    </div>

                    {{-- الوصف إنجليزي --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Site Description (English)
                        </label>
                        <textarea name="site_description_en" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $settings['site_description']['en'] ?? old('site_description_en') }}</textarea>
                    </div>

                    {{-- الشعار --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            شعار الموقع (Logo)
                        </label>
                        @if(isset($settings['logo']) && $settings['logo'])
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="h-16 object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, SVG (الحد الأقصى 2MB)</p>
                    </div>

                    {{-- الأيقونة --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            أيقونة الموقع (Favicon)
                        </label>
                        @if(isset($settings['favicon']) && $settings['favicon'])
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" class="h-12 object-contain">
                            </div>
                        @endif
                        <input type="file" name="favicon" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, ICO (الحد الأقصى 2MB)</p>
                    </div>
                </div>
            </div>

            {{-- Tab: Company --}}
            <div id="content-company" class="tab-content bg-white rounded-lg shadow-sm p-6 hidden">
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-3 border-b">
                    <i class="fas fa-building text-blue-500 ml-2"></i>
                    بيانات الشركة
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- اسم الشركة عربي --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            اسم الشركة (عربي) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="company_name_ar"
                               value="{{ $settings['company_name']['ar'] ?? old('company_name_ar') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    {{-- اسم الشركة إنجليزي --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Company Name (English) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="company_name_en"
                               value="{{ $settings['company_name']['en'] ?? old('company_name_en') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    {{-- الهاتف --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الهاتف
                        </label>
                        <input type="text" name="phone"
                               value="{{ $settings['phone'] ?? old('phone') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- الجوال --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الجوال
                        </label>
                        <input type="text" name="mobile"
                               value="{{ $settings['mobile'] ?? old('mobile') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- البريد الإلكتروني --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            البريد الإلكتروني
                        </label>
                        <input type="email" name="email"
                               value="{{ $settings['email'] ?? old('email') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- العنوان عربي --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            العنوان (عربي)
                        </label>
                        <textarea name="address_ar" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $settings['address']['ar'] ?? old('address_ar') }}</textarea>
                    </div>

                    {{-- العنوان إنجليزي --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Address (English)
                        </label>
                        <textarea name="address_en" rows="2"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $settings['address']['en'] ?? old('address_en') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tab: Social --}}
            <div id="content-social" class="tab-content bg-white rounded-lg shadow-sm p-6 hidden">
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-3 border-b">
                    <i class="fas fa-share-alt text-blue-500 ml-2"></i>
                    وسائل التواصل الاجتماعي
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- WhatsApp --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-whatsapp text-green-500 ml-2"></i>
                            WhatsApp
                        </label>
                        <input type="text" name="whatsapp"
                               value="{{ $settings['whatsapp'] ?? old('whatsapp') }}"
                               placeholder="966500000000+"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- Instagram --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-instagram text-pink-500 ml-2"></i>
                            Instagram
                        </label>
                        <input type="text" name="instagram"
                               value="{{ $settings['instagram'] ?? old('instagram') }}"
                               placeholder="https://instagram.com/username"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- Facebook --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-facebook text-blue-600 ml-2"></i>
                            Facebook
                        </label>
                        <input type="text" name="facebook"
                               value="{{ $settings['facebook'] ?? old('facebook') }}"
                               placeholder="https://facebook.com/page"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- Twitter/X --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-x-twitter text-gray-800 ml-2"></i>
                            X (Twitter)
                        </label>
                        <input type="text" name="twitter"
                               value="{{ $settings['twitter'] ?? old('twitter') }}"
                               placeholder="https://twitter.com/username"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- LinkedIn --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-linkedin text-blue-700 ml-2"></i>
                            LinkedIn
                        </label>
                        <input type="text" name="linkedin"
                               value="{{ $settings['linkedin'] ?? old('linkedin') }}"
                               placeholder="https://linkedin.com/company"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    {{-- YouTube --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-youtube text-red-600 ml-2"></i>
                            YouTube
                        </label>
                        <input type="text" name="youtube"
                               value="{{ $settings['youtube'] ?? old('youtube') }}"
                               placeholder="https://youtube.com/channel"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-save ml-2"></i>
                    حفظ الإعدادات
                </button>
            </div>
        </form>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                btn.classList.add('text-gray-600');
            });

            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');

            // Add active class to selected button
            const activeBtn = document.getElementById('tab-' + tabName);
            activeBtn.classList.remove('text-gray-600');
            activeBtn.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        }
    </script>
@endsection
