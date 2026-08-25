@extends('admin.layouts.app')
@section('title', __('messages.about_management'))
@section('page_title', __('messages.about_management'))

@section('content')
    <div class="mx-auto">
        <form id="aboutForm" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-language text-blue-500"></i> {{ __('messages.text_content') }}
                    </h3>
                </div>
                <div class="px-6 pt-4">
                    <div class="inline-flex bg-gray-100 rounded-lg p-1 gap-1">
                        <button type="button" data-tab="ar" class="tab-btn flex-1 md:flex-none px-6 py-2.5 rounded-md text-sm font-semibold transition-all bg-white text-blue-600 shadow-sm">
                            {{ __('messages.arabic') }} <span id="badge-ar" class="hidden w-2 h-2 bg-red-500 rounded-full inline-block mr-1 animate-pulse"></span>
                        </button>
                        <button type="button" data-tab="en" class="tab-btn flex-1 md:flex-none px-6 py-2.5 rounded-md text-sm font-semibold transition-all text-gray-500 hover:text-gray-700">
                            {{ __('messages.english') }} <span id="badge-en" class="hidden w-2 h-2 bg-red-500 rounded-full inline-block mr-1 animate-pulse"></span>
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div id="tab-content-ar" class="tab-content space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.section_label') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="label_ar" id="label_ar" value="{{ old('label_ar', $about?->getTranslation('label', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.main_heading') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="heading_ar" id="heading_ar" value="{{ old('heading_ar', $about?->getTranslation('heading', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-heading_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" dir="rtl" required>{{ old('description_ar', $about?->getTranslation('description', 'ar') ?? '') }}</textarea>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-description_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.experience_number') }}</label>
                                <input type="text" name="experience_number" id="experience_number" value="{{ old('experience_number', $about->experience_number ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.experience_text') }} <span class="text-red-500">*</span></label>
                                <input type="text" name="experience_text_ar" id="experience_text_ar" value="{{ old('experience_text_ar', $about?->getTranslation('experience_text', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl" required>
                                <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-experience_text_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- تبويب الإنجليزية --}}
                    <div id="tab-content-en" class="tab-content space-y-5 hidden">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.section_label') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="label_en" id="label_en" value="{{ old('label_en', $about?->getTranslation('label', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.main_heading') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="heading_en" id="heading_en" value="{{ old('heading_en', $about?->getTranslation('heading', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-heading_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description_en" id="description_en" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" dir="ltr" required>{{ old('description_en', $about?->getTranslation('description', 'en') ?? '') }}</textarea>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-description_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.experience_text') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="experience_text_en" id="experience_text_en" value="{{ old('experience_text_en', $about?->getTranslation('experience_text', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-experience_text_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. الصور --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-image text-purple-500"></i> {{ __('messages.images') }}</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Main Image --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.main_image') }}
                        </label>

                        @if($about?->main_image)
                            <img
                                src="{{ $about->main_image_url }}"
                                alt="{{ __('messages.main_image') }}"
                                class="object-cover rounded-lg border mb-3"
                            >
                        @endif

                        <div>
                            <label
                                for="main_image"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3
                       border-2 border-dashed border-gray-300
                       rounded-lg cursor-pointer
                       bg-gray-50 hover:bg-purple-50
                       hover:border-purple-400 transition-all"
                            >
                                <i class="fas fa-cloud-upload-alt text-purple-500 text-xl"></i>

                                <span id="main_image_name" class="text-sm text-gray-600">
                    {{ __('messages.choose_file') }}
                </span>
                            </label>

                            <input
                                type="file"
                                name="main_image"
                                id="main_image"
                                accept="image/*"
                                class="hidden"
                            >
                        </div>

                        @error('main_image')
                        <p class="text-red-500 text-xs mt-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>


                    {{-- Secondary Image --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.secondary_image') }}
                        </label>

                        @if($about?->secondary_image)
                            <img
                                src="{{ $about->secondary_image_url }}"
                                alt="{{ __('messages.secondary_image') }}"
                                class="object-cover rounded-lg border mb-3"
                            >
                        @endif

                        <div>
                            <label
                                for="secondary_image"
                                class="flex items-center justify-center gap-3 w-full px-4 py-3
                       border-2 border-dashed border-gray-300
                       rounded-lg cursor-pointer
                       bg-gray-50 hover:bg-purple-50
                       hover:border-purple-400 transition-all"
                            >
                                <i class="fas fa-cloud-upload-alt text-purple-500 text-xl"></i>

                                <span id="secondary_image_name" class="text-sm text-gray-600">
                    {{ __('messages.choose_file') }}
                </span>
                            </label>

                            <input
                                type="file"
                                name="secondary_image"
                                id="secondary_image"
                                accept="image/*"
                                class="hidden"
                            >
                        </div>

                        @error('secondary_image')
                        <p class="text-red-500 text-xs mt-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-star text-yellow-500"></i> {{ __('messages.features_management') }}</h3>
                    <button type="button" id="add-feature-btn" class="text-sm bg-green-50 text-green-700 hover:bg-green-100 px-4 py-2 rounded-lg font-semibold transition-colors flex items-center gap-2 border border-green-200">
                        <i class="fas fa-plus-circle"></i> {{ __('messages.add_new_feature') }}
                    </button>
                </div>

                <div class="p-6">
                    <div id="features-container" class="space-y-6">
                        @if(isset($about) && is_array($about->features))
                            @foreach($about->features as $index => $feat)
                                @include('admin.about.partials.feature-item', ['index' => $index, 'feat' => $feat])
                            @endforeach
                        @endif
                    </div>

                    <div id="no-features-msg" class="text-center py-8 text-gray-500 {{ (isset($about) && is_array($about->features) && count($about->features) > 0) ? 'hidden' : '' }}">
                        <i class="fas fa-layer-group text-3xl mb-2 text-gray-300"></i>
                        <p>{{ __('messages.no_features_added') }}</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> {{ __('messages.save_updates') }}
            </button>
        </form>
    </div>

    <template id="feature-template">

        <div class="feature-item p-5 border border-gray-200 rounded-lg bg-gray-50/50 relative group transition-all hover:shadow-md">

            <div class="flex justify-between">

                <h4 class="text-sm font-bold text-gray-700 mb-4 border-b pb-2 flex items-center gap-2">
                    {{ __('messages.new_feature') }}
                </h4>

                <button
                    type="button"
                    class="remove-feature-btn text-gray-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-full transition-colors"
                    title="{{ __('messages.delete_feature') }}">
                    <i class="fas fa-trash-alt"></i>
                </button>

            </div>

            {{-- بيانات الـ Feature الجديدة --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

                {{-- Icon --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.icon_class') }}
                    </label>

                    <input
                        type="text"
                        name="features[__INDEX__][icon]"
                        placeholder="fa-certificate"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                        dir="ltr">
                </div>

                {{-- العنوان العربي --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.title_arabic') }}
                    </label>

                    <input
                        type="text"
                        name="features[__INDEX__][title_ar]"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                        dir="rtl">
                </div>

                {{-- العنوان الإنجليزي --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.title_english') }}
                    </label>

                    <input
                        type="text"
                        name="features[__INDEX__][title_en]"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                        dir="ltr">
                </div>

            </div>

            {{-- الوصف --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- الوصف العربي --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.description_arabic') }}
                    </label>

                    <textarea
                        name="features[__INDEX__][desc_ar]"
                        rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg resize-none"
                        dir="rtl"></textarea>
                </div>

                {{-- الوصف الإنجليزي --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        {{ __('messages.description_english') }}
                    </label>

                    <textarea
                        name="features[__INDEX__][desc_en]"
                        rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg resize-none"
                        dir="ltr"></textarea>
                </div>

            </div>

        </div>

    </template>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('aboutForm');
                if (!form) return;

                // 1. منطق التبويبات
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
                document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.tab)));

                // 2. التحقق الذكي عند الحفظ
                form.addEventListener('submit', (e) => {
                    let hasError = false, firstErrorTab = null, firstErrorField = null;

                    document.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
                    document.querySelectorAll('input[required], textarea[required]').forEach(el => {
                        el.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        el.classList.add('border-gray-300');
                    });
                    document.getElementById('badge-ar').classList.add('hidden');
                    document.getElementById('badge-en').classList.add('hidden');

                    const requiredFields = [
                        { id: 'label_ar', tab: 'ar' }, { id: 'label_en', tab: 'en' },
                        { id: 'heading_ar', tab: 'ar' }, { id: 'heading_en', tab: 'en' },
                        { id: 'description_ar', tab: 'ar' }, { id: 'description_en', tab: 'en' },
                        { id: 'experience_text_ar', tab: 'ar' }, { id: 'experience_text_en', tab: 'en' }
                    ];

                    requiredFields.forEach(field => {
                        const input = document.getElementById(field.id);
                        if (input && !input.value.trim()) {
                            hasError = true;
                            if (!firstErrorTab) { firstErrorTab = field.tab; firstErrorField = input; }
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
                            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 150);

                        const isAr = document.documentElement.dir === 'rtl';
                        if (typeof toastr !== 'undefined') {
                            toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", { positionClass: isAr ? "toast-top-left" : "toast-top-right", timeOut: 4000 });
                        }
                    }
                });

                form.addEventListener('input', (e) => {
                    if (e.target.hasAttribute('required')) {
                        e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        e.target.classList.add('border-gray-300');
                        document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');
                        const lang = e.target.id.split('_')[1];
                        if (e.target.value.trim()) document.getElementById(`badge-${lang}`).classList.add('hidden');
                    }
                });
                let featureIndex = {{ isset($about) && is_array($about->features) ? count($about->features) : 0 }};
                const container = document.getElementById('features-container');
                const noFeaturesMsg = document.getElementById('no-features-msg');

                function updateNoFeaturesMessage() {
                    if (container.children.length === 0) {
                        noFeaturesMsg.classList.remove('hidden');
                    } else {
                        noFeaturesMsg.classList.add('hidden');
                    }
                }

                document.getElementById('add-feature-btn').addEventListener('click', function() {
                    const template = document.getElementById('feature-template').innerHTML;
                    const newHtml = template.replace(/__INDEX__/g, featureIndex);

                    container.insertAdjacentHTML('beforeend', newHtml);
                    featureIndex++;
                    updateNoFeaturesMessage();
                    const newFeature = container.lastElementChild;
                    newFeature.scrollIntoView({ behavior: 'smooth', block: 'center' });
                });
                container.addEventListener('click', function(e) {
                    const removeBtn = e.target.closest('.remove-feature-btn');
                    if (removeBtn) {
                        const featureItem = removeBtn.closest('.feature-item');
                        featureItem.style.opacity = '0';
                        featureItem.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            featureItem.remove();
                            updateNoFeaturesMessage();
                        }, 200);
                    }
                });
                updateNoFeaturesMessage();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const mainImage = document.getElementById('main_image');
                const mainImageName = document.getElementById('main_image_name');

                const secondaryImage = document.getElementById('secondary_image');
                const secondaryImageName = document.getElementById('secondary_image_name');


                // Main Image
                if (mainImage) {
                    mainImage.addEventListener('change', function () {

                        if (this.files && this.files.length > 0) {
                            mainImageName.textContent = this.files[0].name;
                        } else {
                            mainImageName.textContent =
                                "{{ __('messages.no_file_chosen') }}";
                        }

                    });
                }


                // Secondary Image
                if (secondaryImage) {
                    secondaryImage.addEventListener('change', function () {

                        if (this.files && this.files.length > 0) {
                            secondaryImageName.textContent = this.files[0].name;
                        } else {
                            secondaryImageName.textContent =
                                "{{ __('messages.no_file_chosen') }}";
                        }

                    });
                }

            });
        </script>
    @endpush
@endsection
