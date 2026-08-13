@extends('admin.layouts.app')
@section('title', __('messages.hero_settings'))
@section('page_title', __('messages.hero_settings_page'))

@section('content')
    <div class="mx-auto">
        <form id="heroForm" action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-language text-blue-500"></i> {{ __('messages.text_content') }}
                    </h3>
                </div>
                <div class="px-6 pt-4">
                    <div class="inline-flex bg-gray-100 rounded-lg p-1 gap-1 w-full md:w-auto">
                        <button type="button" data-tab="ar"
                                class="tab-btn flex-1 md:flex-none px-6 py-2.5 rounded-md text-sm font-semibold transition-all duration-200 bg-white text-blue-600 shadow-sm">
                            {{ __('messages.arabic') }}
                            <span id="badge-ar"
                                  class="hidden w-2 h-2 bg-red-500 rounded-full inline-block mr-1 animate-pulse"></span>
                        </button>
                        <button type="button" data-tab="en"
                                class="tab-btn flex-1 md:flex-none px-6 py-2.5 rounded-md text-sm font-semibold transition-all duration-200 text-gray-500 hover:text-gray-700">
                            {{ __('messages.english') }}
                            <span id="badge-en"
                                  class="hidden w-2 h-2 bg-red-500 rounded-full inline-block mr-1 animate-pulse"></span>
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div id="tab-content-ar" class="tab-content space-y-5">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.main_title') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="title_ar" id="title_ar"
                                   value="{{ old('title_ar', $hero?->getTranslation('title', 'ar') ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-title_ar"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.subtitle') }}</label>
                            <input type="text" name="sub_title_ar"
                                   value="{{ old('sub_title_ar', $hero?->getTranslation('sub_title', 'ar') ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="rtl">
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.description') }}</label>
                            <textarea name="description_ar" rows="4"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                      dir="rtl">{{ old('description_ar', $hero?->getTranslation('description', 'ar') ?? '') }}</textarea>
                        </div>
                    </div>

                    {{-- محتوى تبويب الإنجليزية --}}
                    <div id="tab-content-en" class="tab-content space-y-5 hidden">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.main_title') }}
                                <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" name="title_en" id="title_en"
                                       value="{{ old('title_en', $hero?->getTranslation('title', 'en') ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                       dir="ltr" required>
                            </div>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-title_en"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.subtitle') }}</label>
                            <div class="relative">
                                <input type="text" name="sub_title_en"
                                       value="{{ old('sub_title_en', $hero?->getTranslation('sub_title', 'en') ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                       dir="ltr">
                            </div>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.description') }}</label>
                            <div class="relative">
                                <textarea name="description_en" rows="4"
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                          dir="ltr">{{ old('description_en', $hero?->getTranslation('description', 'en') ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-image text-purple-500"></i> {{ __('messages.background_image') }}
                    </h3>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.background_image') }}
                    </label>

                    {{-- الصورة الحالية --}}
                    @if(isset($hero) && $hero->bg_image)
                        <div class="relative mb-3 group w-full md:w-1/2">
                            <img
                                id="bgImagePreview"
                                src="{{ $hero->bg_image_url }}"
                                class="object-cover rounded-lg border"
                                alt="{{ __('messages.background_image') }}"
                            >

                            <div class="absolute inset-0 bg-black/40 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <span class="text-white text-xs font-medium">
                    {{ __('messages.will_be_replaced_on_new_upload') }}
                </span>
                            </div>
                        </div>
                    @else
                        {{-- المعاينة عند عدم وجود صورة --}}
                        <div id="previewContainer" class="hidden mb-3 w-full md:w-1/2">
                            <img
                                id="bgImagePreview"
                                src=""
                                class="w-full h-40 object-cover rounded-lg border"
                                alt="{{ __('messages.background_image') }}"
                            >
                        </div>
                    @endif

                    {{-- اختيار الصورة --}}
                    <div class="w-full md:w-1/2">
                        <label
                            for="bg_image"
                            class="flex items-center justify-center gap-2 px-4 py-3 bg-purple-50 text-purple-700 border border-purple-200 rounded-lg cursor-pointer hover:bg-purple-100 transition-colors"
                        >
                            <i class="fas fa-upload"></i>

                            <span id="fileChooseText">
                {{ __('messages.choose_file') }}
            </span>
                        </label>

                        <input
                            type="file"
                            id="bg_image"
                            name="bg_image"
                            accept="image/*"
                            class="hidden"
                        >

                        <p id="fileName" class="text-xs text-gray-500 mt-2">
                            {{ __('messages.no_file_chosen') }}
                        </p>
                    </div>

                    @error('bg_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit"
                    class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> {{ __('messages.save_updates') }}
            </button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.getElementById('bg_image')?.addEventListener('change', function () {
                const file = this.files[0];

                if (!file) {
                    document.getElementById('fileName').textContent =
                        "{{ __('messages.no_file_chosen') }}";
                    return;
                }

                // عرض اسم الملف
                document.getElementById('fileName').textContent = file.name;

                // معاينة الصورة
                const reader = new FileReader();

                reader.onload = function (e) {
                    let preview = document.getElementById('bgImagePreview');
                    let container = document.getElementById('previewContainer');

                    preview.src = e.target.result;

                    if (container) {
                        container.classList.remove('hidden');
                    }
                };

                reader.readAsDataURL(file);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('heroForm');
                if (!form) return;

                window.switchTab = (lang) => {
                    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
                    document.querySelectorAll('.tab-btn').forEach(btn => {
                        btn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
                        btn.classList.add('text-gray-500', 'hover:text-gray-700');
                    });

                    document.getElementById(`tab-content-${lang}`).classList.remove('hidden');
                    const activeBtn = document.querySelector(`.tab-btn[data-tab="${lang}"]`);
                    activeBtn.classList.remove('text-gray-500', 'hover:text-gray-700');
                    activeBtn.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
                };

                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.addEventListener('click', () => switchTab(btn.dataset.tab));
                });

                form.addEventListener('submit', (e) => {
                    let hasError = false;
                    let firstErrorTab = null;
                    let firstErrorField = null;

                    document.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
                    document.querySelectorAll('input[required], textarea[required]').forEach(el => {
                        el.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        el.classList.add('border-gray-300');
                    });
                    document.getElementById('badge-ar').classList.add('hidden');
                    document.getElementById('badge-en').classList.add('hidden');

                    const requiredFields = [
                        {id: 'title_ar', tab: 'ar'},
                        {id: 'title_en', tab: 'en'}
                    ];

                    requiredFields.forEach(field => {
                        const input = document.getElementById(field.id);
                        if (input && !input.value.trim()) {
                            hasError = true;
                            if (!firstErrorTab) {
                                firstErrorTab = field.tab;
                                firstErrorField = input;
                            }

                            document.getElementById(`error-${field.id}`).classList.remove('hidden');
                            input.classList.remove('border-gray-300');
                            input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                            document.getElementById(`badge-${field.tab}`).classList.remove('hidden');
                        }
                    });

                    if (hasError) {
                        e.preventDefault();
                        switchTab(firstErrorTab);
                        setTimeout(() => {
                            firstErrorField.focus();
                            firstErrorField.scrollIntoView({behavior: 'smooth', block: 'center'});
                        }, 150);

                        const isAr = document.documentElement.dir === 'rtl';
                        if (typeof toastr !== 'undefined') {
                            toastr.error(
                                "{{ __('messages.fill_required_fields_both_langs') }}",
                                "{{ __('messages.validation_error') }}",
                                {positionClass: isAr ? "toast-top-left" : "toast-top-right", timeOut: 4000}
                            );
                        }
                    }
                });

                form.addEventListener('input', (e) => {
                    if (e.target.hasAttribute('required')) {
                        e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        e.target.classList.add('border-gray-300');
                        document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');

                        const lang = e.target.id.split('_')[1];
                        if (e.target.value.trim()) {
                            document.getElementById(`badge-${lang}`).classList.add('hidden');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
