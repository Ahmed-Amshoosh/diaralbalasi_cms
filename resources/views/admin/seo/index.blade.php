@extends('admin.layouts.app')
@section('title', __('messages.seo_management'))
@section('page_title', __('messages.seo_management'))

@section('content')
    <div class="space-y-6">
        <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-tags text-blue-500"></i>
                        {{ __('messages.seo_meta_tags') }}
                    </h3>
                </div>

                <div class="px-6 pt-4">
                    <div class="flex border-b border-gray-200">
                        <button type="button"
                                data-tab="ar"
                                class="tab-btn flex items-center gap-2 px-6 py-3 text-sm font-bold text-blue-600 border-b-4 border-blue-600 bg-white rounded-t-lg shadow-sm transition-all duration-300">
                            <span>{{ __('messages.arabic_tab') }}</span>
                        </button>

                        <button type="button"
                                data-tab="en"
                                class="tab-btn flex items-center gap-2 px-6 py-3 text-sm font-medium text-gray-500 border-b-4 border-transparent hover:text-gray-700 hover:bg-gray-50 rounded-t-lg transition-all duration-300">
                            <span>{{ __('messages.english_tab') }}</span>
                        </button>
                    </div>
                </div>

                <div class="p-6">

                    {{-- Arabic --}}
                    <div id="tab-content-ar" class="tab-content space-y-5">

                        <div>
                            <label for="title_ar"
                                   class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-1.5">
                        <span>
                            {{ __('messages.seo_title') }}
                            <span class="text-red-500">*</span>
                        </span>

                                <span class="ms-auto text-xs text-gray-500 whitespace-nowrap">
                            <span id="title_ar_count">0</span>/70
                            {{ __('messages.seo_chars_count') }}
                        </span>
                            </label>

                            <input type="text"
                                   name="title_ar"
                                   id="title_ar"
                                   maxlength="70"
                                   value="{{ old('title_ar', $seo['title_ar'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="rtl"
                                   required>

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_title_hint') }}
                            </p>

                            @error('title_ar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description_ar"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_description') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea name="description_ar"
                                      id="description_ar"
                                      maxlength="160"
                                      rows="3"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                      dir="rtl"
                                      required>{{ old('description_ar', $seo['description_ar'] ?? '') }}</textarea>

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_description_hint') }}
                            </p>

                            @error('description_ar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keywords_ar"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_keywords') }}
                            </label>

                            <input type="text"
                                   name="keywords_ar"
                                   id="keywords_ar"
                                   value="{{ old('keywords_ar', $seo['keywords_ar'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="rtl"
                                   placeholder="كلمة1, كلمة2, كلمة3">

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_keywords_hint') }}
                            </p>
                        </div>

                    </div>

                    {{-- English --}}
                    <div id="tab-content-en" class="tab-content space-y-5 hidden">

                        <div>
                            <label for="title_en"
                                   class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-1.5">
                        <span>
                            {{ __('messages.seo_title') }}
                            <span class="text-red-500">*</span>
                        </span>

                                <span class="ms-auto text-xs text-gray-500 whitespace-nowrap">
                            <span id="title_en_count">0</span>/70
                            {{ __('messages.seo_chars_count') }}
                        </span>
                            </label>

                            <input type="text"
                                   name="title_en"
                                   id="title_en"
                                   maxlength="70"
                                   value="{{ old('title_en', $seo['title_en'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr"
                                   required>

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_title_hint') }}
                            </p>

                            @error('title_en')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description_en"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_description') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea name="description_en"
                                      id="description_en"
                                      maxlength="160"
                                      rows="3"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                      dir="ltr"
                                      required>{{ old('description_en', $seo['description_en'] ?? '') }}</textarea>

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_description_hint') }}
                            </p>

                            @error('description_en')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keywords_en"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_keywords') }}
                            </label>

                            <input type="text"
                                   name="keywords_en"
                                   id="keywords_en"
                                   value="{{ old('keywords_en', $seo['keywords_en'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr"
                                   placeholder="keyword1, keyword2, keyword3">

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_keywords_hint') }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-share-alt text-purple-500"></i>
                        {{ __('messages.seo_social') }}
                    </h3>
                </div>

                <div class="p-6 space-y-5">

                    <div>
                        <label for="og_image"
                               class="block text-sm font-semibold text-gray-700 mb-1.5">
                            {{ __('messages.seo_og_image') }}
                        </label>

                        @if($seo['og_image'])
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $seo['og_image']) }}"
                                     alt="OG Image"
                                     width="600"
                                     height="315"
                                     class="h-40 w-auto object-contain rounded-lg border border-gray-200 p-1">
                            </div>
                        @endif

                        <input type="file"
                               name="og_image"
                               id="og_image"
                               accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">

                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle"></i>
                            {{ __('messages.seo_og_image_hint') }}
                        </p>

                        @error('og_image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label for="twitter_card"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_twitter_card') }}
                            </label>

                            <select name="twitter_card"
                                    id="twitter_card"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">

                                <option value="summary"
                                    {{ ($seo['twitter_card'] ?? '') === 'summary' ? 'selected' : '' }}>
                                    Summary (صغيرة)
                                </option>

                                <option value="summary_large_image"
                                    {{ ($seo['twitter_card'] ?? '') === 'summary_large_image' ? 'selected' : '' }}>
                                    Summary Large Image (كبيرة)
                                </option>

                            </select>
                        </div>

                        <div>
                            <label for="twitter_site"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_twitter_site') }}
                            </label>

                            <input type="text"
                                   name="twitter_site"
                                   id="twitter_site"
                                   value="{{ old('twitter_site', $seo['twitter_site'] ?? '') }}"
                                   placeholder="@username"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr">
                        </div>

                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-cogs text-orange-500"></i>
                        {{ __('messages.seo_advanced') }}
                    </h3>
                </div>

                <div class="p-6 space-y-5">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label for="author"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_author') }}
                            </label>

                            <input type="text"
                                   name="author"
                                   id="author"
                                   value="{{ old('author', $seo['author'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="robots"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_robots') }}
                            </label>

                            <input type="text"
                                   name="robots"
                                   id="robots"
                                   value="{{ old('robots', $seo['robots'] ?? 'index, follow') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr">

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.seo_robots_hint') }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <label for="canonical_url"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_canonical_url') }}
                            </label>

                            <input type="url"
                                   name="canonical_url"
                                   id="canonical_url"
                                   value="{{ old('canonical_url', $seo['canonical_url'] ?? '') }}"
                                   placeholder="https://yourwebsite.com"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr">
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 border-t border-gray-100">

                        <div>
                            <label for="google_analytics"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_google_analytics') }}
                            </label>

                            <input type="text"
                                   name="google_analytics"
                                   id="google_analytics"
                                   value="{{ old('google_analytics', $seo['google_analytics'] ?? '') }}"
                                   placeholder="G-XXXXXXXXXX"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr">
                        </div>

                        <div>
                            <label for="google_tag_manager"
                                   class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.seo_google_tag_manager') }}
                            </label>

                            <input type="text"
                                   name="google_tag_manager"
                                   id="google_tag_manager"
                                   value="{{ old('google_tag_manager', $seo['google_tag_manager'] ?? '') }}"
                                   placeholder="GTM-XXXXXXX"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   dir="ltr">
                        </div>

                    </div>

                    <button type="submit"
                            class="px-8 mb-2 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        {{ __('messages.save_updates') }}
                    </button>

                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                window.switchTab = (lang) => {
                    document.querySelectorAll('.tab-content').forEach(el => { el.classList.add('hidden'); el.classList.remove('tab-animate'); });
                    document.querySelectorAll('.tab-btn').forEach(btn => {
                        btn.classList.remove('text-blue-600', 'border-blue-600', 'bg-white', 'font-bold', 'shadow-sm');
                        btn.classList.add('text-gray-500', 'border-transparent', 'hover:text-gray-700', 'hover:bg-gray-50', 'font-medium');
                    });
                    const target = document.getElementById(`tab-content-${lang}`);
                    target.classList.remove('hidden');
                    requestAnimationFrame(() => target.classList.add('tab-animate'));
                    const activeBtn = document.querySelector(`.tab-btn[data-tab="${lang}"]`);
                    activeBtn.classList.remove('text-gray-500', 'border-transparent', 'hover:text-gray-700', 'hover:bg-gray-50', 'font-medium');
                    activeBtn.classList.add('text-blue-600', 'border-blue-600', 'bg-white', 'font-bold', 'shadow-sm');
                };
                document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', () => window.switchTab(btn.dataset.tab)));
                window.switchTab('ar');
                const counters = {
                    'title_ar': { max: 70, counter: 'title_ar_count' },
                    'title_en': { max: 70, counter: 'title_en_count' },
                    'description_ar': { max: 160, counter: 'desc_ar_count' },
                    'description_en': { max: 160, counter: 'desc_en_count' },
                };
                Object.keys(counters).forEach(id => {
                    const input = document.getElementById(id);
                    const counter = document.getElementById(counters[id].counter);
                    if (input && counter) {
                        const update = () => {
                            const len = input.value.length;
                            counter.textContent = len;
                            counter.style.color = len > counters[id].max * 0.9 ? '#ef4444' : '#6b7280';
                        };
                        input.addEventListener('input', update);
                        update();
                    }
                });

                const previewTitle = document.getElementById('preview-title');
                const previewDesc = document.getElementById('preview-description');
                const titleAr = document.getElementById('title_ar');
                const descAr = document.getElementById('description_ar');

                if (titleAr && previewTitle) {
                    titleAr.addEventListener('input', () => {
                        previewTitle.textContent = titleAr.value || 'عنوان الموقع';
                    });
                }
                if (descAr && previewDesc) {
                    descAr.addEventListener('input', () => {
                        previewDesc.textContent = descAr.value || 'وصف الموقع سيظهر هنا...';
                    });
                }
                @if($errors->any())
                @foreach($errors->all() as $error)
                toastr.error("{{ $error }}", "خطأ", { positionClass: "{{ app()->getLocale() === 'ar' ? 'toast-top-left' : 'toast-top-right' }}", timeOut: 4000 });
                @endforeach
                @endif
            });
        </script>
    @endpush
@endsection
