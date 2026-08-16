@extends('admin.layouts.app')
@section('title', __('messages.cta_management'))
@section('page_title', __('messages.cta_management'))

@section('content')
    <div class="mx-auto">
        <form action="{{ route('admin.cta.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-language text-blue-500"></i> {{ __('messages.text_content') }}
                    </h3>
                </div>
                <div class="px-6 pt-4">
                    <div class="flex border-b border-gray-200">
                        <button type="button" data-tab="ar"
                                class="tab-btn flex items-center gap-2 px-6 py-3 text-sm font-bold text-blue-600 border-b-4 border-blue-600 bg-white rounded-t-lg shadow-sm transition-all duration-300">
                            <span class="text-xl">🇸🇦</span>
                            <span>{{ __('messages.arabic_tab') }}</span>
                        </button>
                        <button type="button" data-tab="en"
                                class="tab-btn flex items-center gap-2 px-6 py-3 text-sm font-medium text-gray-500 border-b-4 border-transparent hover:text-gray-700 hover:bg-gray-50 rounded-t-lg transition-all duration-300">
                            <span class="text-xl">🇬🇧</span>
                            <span>{{ __('messages.english_tab') }}</span>
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div id="tab-content-ar" class="tab-content space-y-5">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.cta_heading') }}
                                <span class="text-red-500">*</span></label>
                            <textarea name="heading_ar" rows="2"
                                      class="w-full px-4 py-2.5 border {{ $errors->has('heading_ar') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                      dir="rtl">{{ old('heading_ar', $cta?->getTranslation('heading', 'ar') ?? '') }}</textarea>
                            @error('heading_ar') <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            <p class="text-xs text-gray-500 mt-1"><i
                                    class="fas fa-code"></i> {!! __('messages.html_support_note') !!}</p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.cta_desc') }}
                                <span class="text-red-500">*</span></label>
                            <textarea name="description_ar" rows="4"
                                      class="w-full px-4 py-2.5 border {{ $errors->has('description_ar') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                      dir="rtl">{{ old('description_ar', $cta?->getTranslation('description', 'ar') ?? '') }}</textarea>
                            @error('description_ar') <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.cta_button_text') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="button_text_ar"
                                   value="{{ old('button_text_ar', $cta?->getTranslation('button_text', 'ar') ?? '') }}"
                                   class="w-full px-4 py-2.5 border {{ $errors->has('button_text_ar') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="rtl">
                            @error('button_text_ar') <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div id="tab-content-en" class="tab-content space-y-5 hidden">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.cta_heading') }}
                                <span class="text-red-500">*</span></label>
                            <textarea name="heading_en" rows="2"
                                      class="w-full px-4 py-2.5 border {{ $errors->has('heading_en') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                      dir="ltr">{{ old('heading_en', $cta?->getTranslation('heading', 'en') ?? '') }}</textarea>
                            @error('heading_en') <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                            <p class="text-xs text-gray-500 mt-1"><i
                                    class="fas fa-code"></i> {!! __('messages.html_support_note') !!}</p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.cta_desc') }}
                                <span class="text-red-500">*</span></label>
                            <textarea name="description_en" rows="4"
                                      class="w-full px-4 py-2.5 border {{ $errors->has('description_en') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                      dir="ltr">{{ old('description_en', $cta?->getTranslation('description', 'en') ?? '') }}</textarea>
                            @error('description_en') <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.cta_button_text') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="button_text_en"
                                   value="{{ old('button_text_en', $cta?->getTranslation('button_text', 'en') ?? '') }}"
                                   class="w-full px-4 py-2.5 border {{ $errors->has('button_text_en') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr">
                            @error('button_text_en') <p class="text-red-500 text-xs mt-1.5"><i
                                    class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.cta_image') }}
                        </label>

                        {{-- معاينة الصورة الحالية --}}
                        @if(isset($cta) && $cta->image)
                            <div class="mb-3 flex items-center justify-start">
                                <div
                                    class="w-70 h-40 bg-gray-50 rounded-lg border border-gray-200 p-2 flex items-center justify-center">
                                    <img
                                        src="{{ $cta->image_url }}"
                                        alt="{{ __('messages.cta_image') }}"
                                        class="max-w-full max-h-full object-contain rounded-md"
                                    >
                                </div>
                            </div>
                        @endif

                        {{-- رفع الصورة --}}
                        <div class="w-full md:w-1/2">
                            <label
                                for="image"
                                class="flex items-center justify-center gap-3 px-4 py-3
                   border-2 border-dashed border-gray-300
                   rounded-lg cursor-pointer
                   bg-gray-50 hover:bg-purple-50
                   hover:border-purple-400
                   transition-all"
                            >
                                <i class="fas fa-cloud-upload-alt text-purple-500 text-xl"></i>

                                <span id="fileName" class="text-sm text-gray-600">
                {{ __('messages.choose_file') }}
            </span>
                            </label>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="hidden"
                            >
                        </div>

                        @error('image')
                        <p class="text-red-500 text-xs mt-1.5">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pb-8">
                <button type="submit"
                        class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> {{ __('messages.save_updates') }}
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const imageInput = document.getElementById('image');
                const fileName = document.getElementById('fileName');

                if (imageInput) {
                    imageInput.addEventListener('change', function () {

                        const file = this.files[0];

                        if (!file) {
                            fileName.textContent = "{{ __('messages.no_file_chosen') }}";
                            return;
                        }

                        fileName.textContent = file.name;
                    });
                }

            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // ================================
                // تبديل التبويبات
                // ================================
                window.switchTab = (lang) => {

                    document.querySelectorAll('.tab-content').forEach(el => {
                        el.classList.add('hidden');
                        el.classList.remove('tab-animate');
                    });

                    document.querySelectorAll('.tab-btn').forEach(btn => {
                        btn.classList.remove(
                            'text-blue-600',
                            'border-blue-600',
                            'bg-white',
                            'font-bold',
                            'shadow-sm'
                        );

                        btn.classList.add(
                            'text-gray-500',
                            'border-transparent',
                            'hover:text-gray-700',
                            'hover:bg-gray-50',
                            'font-medium'
                        );
                    });

                    const targetContent = document.getElementById(`tab-content-${lang}`);

                    if (!targetContent) return;

                    targetContent.classList.remove('hidden');

                    requestAnimationFrame(() => {
                        targetContent.classList.add('tab-animate');
                    });

                    const activeBtn = document.querySelector(
                        `.tab-btn[data-tab="${lang}"]`
                    );

                    if (activeBtn) {
                        activeBtn.classList.remove(
                            'text-gray-500',
                            'border-transparent',
                            'hover:text-gray-700',
                            'hover:bg-gray-50',
                            'font-medium'
                        );

                        activeBtn.classList.add(
                            'text-blue-600',
                            'border-blue-600',
                            'bg-white',
                            'font-bold',
                            'shadow-sm'
                        );
                    }
                };


                // ================================
                // ربط أزرار التبويبات
                // ================================
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        window.switchTab(btn.dataset.tab);
                    });
                });


                // ================================
                // اكتشاف أخطاء Validation
                // ================================
                const arabicFields = [
                    'heading_ar',
                    'description_ar',
                    'button_text_ar'
                ];

                const englishFields = [
                    'heading_en',
                    'description_en',
                    'button_text_en'
                ];

                const commonFields = [
                    'custom_link',
                    'image'
                ];


                const hasError = (field) => {
                    const input = document.querySelector(`[name="${field}"]`);

                    return input &&
                        input.classList.contains('border-red-500');
                };


                const hasArabicError = arabicFields.some(hasError);
                const hasEnglishError = englishFields.some(hasError);
                const hasCommonError = commonFields.some(hasError);


                // ================================
                // تحديد التبويب الذي سيتم فتحه
                // ================================
                if (hasArabicError) {

                    window.switchTab('ar');

                } else if (hasEnglishError) {

                    window.switchTab('en');

                } else {

                    // الحقول العامة لا تتبع أي تبويب
                    window.switchTab('ar');
                }

            });
        </script>
    @endpush
@endsection
