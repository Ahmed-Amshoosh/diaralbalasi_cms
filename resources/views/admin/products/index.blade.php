@extends('admin.layouts.app')
@section('title', __('messages.products_management'))
@section('page_title', __('messages.products_management'))

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-cog text-blue-500"></i> {{ __('messages.testimonials_section_settings') }}
                </h3>
            </div>
            <form id="sectionForm" action="{{ route('admin.products.section.update') }}" method="POST" novalidate>
                @csrf @method('PUT')

                <div class="px-6 pt-4">
                    <div class="inline-flex bg-gray-100 rounded-lg p-1 gap-1">
                        <button type="button" data-tab="ar"
                                class="tab-btn flex-1 md:flex-none px-6 py-2.5 rounded-md text-sm font-semibold transition-all bg-white text-blue-600 shadow-sm">
                            {{ __('messages.arabic') }} <span id="badge-ar"
                                                              class="hidden w-2 h-2 bg-red-500 rounded-full inline-block mr-1 animate-pulse"></span>
                        </button>
                        <button type="button" data-tab="en"
                                class="tab-btn flex-1 md:flex-none px-6 py-2.5 rounded-md text-sm font-semibold transition-all text-gray-500 hover:text-gray-700">
                            {{ __('messages.english') }} <span id="badge-en"
                                                               class="hidden w-2 h-2 bg-red-500 rounded-full inline-block mr-1 animate-pulse"></span>
                        </button>
                    </div>
                </div>

                <div class="p-6">

                    {{-- Arabic --}}
                    <div id="tab-content-ar" class="tab-content space-y-5">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.section_label') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="label_ar"
                                id="label_ar"
                                value="{{ old('label_ar', $section?->getTranslation('label', 'ar') ?? '') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                dir="rtl"
                                required
                            >

                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_ar">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>


                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.main_heading') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="heading_ar"
                                id="heading_ar"
                                value="{{ old('heading_ar', $section?->getTranslation('heading', 'ar') ?? '') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                dir="rtl"
                                required
                            >

                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-heading_ar">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>


                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.description') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea
                                name="description_ar"
                                id="description_ar"
                                rows="3"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                dir="rtl"
                                required
                            >{{ old('description_ar', $section?->getTranslation('description', 'ar') ?? '') }}</textarea>

                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-description_ar">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>

                    </div>


                    {{-- English --}}
                    <div id="tab-content-en" class="tab-content space-y-5 hidden">

                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.section_label') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="label_en"
                                id="label_en"
                                value="{{ old('label_en', $section?->getTranslation('label', 'en') ?? '') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                dir="ltr"
                                required
                            >

                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_en">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>


                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.main_heading') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="heading_en"
                                id="heading_en"
                                value="{{ old('heading_en', $section?->getTranslation('heading', 'en') ?? '') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                dir="ltr"
                                required
                            >

                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-heading_en">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>


                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.description') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea
                                name="description_en"
                                id="description_en"
                                rows="3"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                                dir="ltr"
                                required
                            >{{ old('description_en', $section?->getTranslation('description', 'en') ?? '') }}</textarea>

                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-description_en">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>

                    </div>

                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-sm transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i> {{ __('messages.save_section_settings') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-box text-blue-500"></i> {{ __('messages.products_management') }}
            </h3>
            @can('create products')
                <button onclick="window.openAddModal()"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                    <i class="fas fa-plus"></i> {{ __('messages.add_product') }}
                </button>
            @endcan

        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.hero_order') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.product_images') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.product_name') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.product_category') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.product_brand') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.product_price') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.status') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $product->order }}</td>
                        <td class="px-6 py-4">
                            @if($product->main_image)
                                <img src="{{ $product->main_image }}"
                                     alt="{{ $product->getTranslation('name', app()->getLocale()) }}"
                                     class="h-12 w-12 object-cover rounded-lg border">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $product->getTranslation('name', app()->getLocale()) }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->category?->getTranslation('name', app()->getLocale()) ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->partner?->getTranslation('name', app()->getLocale()) ?? '-' }}</td>
                        <td class="px-6 py-4 font-semibold text-green-600">{{ $product->price ? number_format($product->price, 2) : '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($product->is_active)
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-100">{{ __('messages.active') }}</span>
                            @else
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold border border-gray-200">{{ __('messages.inactive') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">

                                @can('edit products')
                                    <button onclick='window.openEditModal(@json($product))'
                                            class="text-blue-600 hover:text-blue-800 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                                            title="{{ __('messages.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endcan
                                @can('delete products')
                                    <button
                                        onclick="confirmDelete('{{ route('admin.products.destroy', $product->id) }}', '{{ addslashes($product->getTranslation('name', app()->getLocale())) }}')"
                                        class="text-red-600 hover:text-red-800 p-2 bg-red-50 rounded-lg hover:bg-red-100 transition-colors"
                                        title="{{ __('messages.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                            <p>{{ __('messages.no_data') }}</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal إضافة/تعديل منتج --}}
    <div id="productModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="window.closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block w-full max-w-4xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-xl shadow-xl sm:my-8 sm:align-middle sm:p-6">
                <div class="flex justify-between items-center mb-5 border-b pb-3">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-box text-blue-500"></i> <span
                            id="modalTitleText">{{ __('messages.add_product') }}</span>
                    </h3>
                    <button onclick="window.closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="productForm" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-start">
                        {{-- الاسم عربي --}}
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_name') }}
                                (عربي) <span class="text-red-500">*</span></label>
                            <input type="text" name="name_ar" id="item_name_ar"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_name_ar"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        {{-- الاسم إنجليزي --}}
                        <div class="relative">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_name') }}
                                (English) <span class="text-red-500">*</span></label>
                            <input type="text" name="name_en" id="item_name_en"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   dir="ltr" required>
                            <button type="button" onclick="window.copyField('item_name_ar', 'item_name_en')"
                                    class="absolute top-9 right-2.5 bg-gray-100 hover:bg-blue-100 text-xs px-2 py-1 rounded">
                                <i class="fas fa-copy"></i></button>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_name_en"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>

                        {{-- الوصف عربي --}}
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_description') }}
                                (عربي)</label>
                            <textarea name="description_ar" id="item_description_ar" rows="3"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all resize-none"
                                      dir="rtl"></textarea>
                        </div>
                        {{-- الوصف إنجليزي --}}
                        <div class="relative">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_description') }}
                                (English)</label>
                            <textarea name="description_en" id="item_description_en" rows="3"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all resize-none"
                                      dir="ltr"></textarea>
                            <button type="button"
                                    onclick="window.copyField('item_description_ar', 'item_description_en')"
                                    class="absolute top-9 right-2.5 bg-gray-100 hover:bg-blue-100 text-xs px-2 py-1 rounded">
                                <i class="fas fa-copy"></i></button>
                        </div>

                        {{-- السعر --}}
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_price') }}</label>
                            <input type="number" name="price" id="item_price" step="0.01" min="0"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   dir="ltr">
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.hero_order') }}</label>
                            <input type="number" name="order" id="item_order" value="0" min="0"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_category') }}</label>
                            <select name="category_id" id="item_category_id"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">{{ __('messages.select_category') }}</option>
                                @foreach($categories as $cat)
                                    <option
                                        value="{{ $cat->id }}">{{ $cat->getTranslation('name', app()->getLocale()) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.product_brand') }}</label>
                            <select name="partner_id" id="item_brand_id"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">{{ __('messages.select_brand') }}</option>
                                @foreach($partners as $partner)
                                    <option
                                        value="{{ $partner->id }}">{{ $partner->getTranslation('name', app()->getLocale()) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.upload_images') }}
                            </label>

                            <input
                                type="file"
                                name="images[]"
                                id="item_images"
                                multiple
                                accept="image/*"
                                class="hidden"
                            >

                            <label
                                for="item_images"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-700 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors"
                            >
                                <i class="fas fa-upload"></i>
                                {{ __('messages.choose_images') }}
                            </label>

                            <span id="selected_images" class="text-sm text-gray-500 ms-2">
        {{ __('messages.no_images_selected') }}
    </span>

                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle"></i>
                                {{ __('messages.can_upload_multiple_images') }}
                            </p>
                        </div>

                        <div class="md:col-span-2 hidden" id="current_images_section">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.current_images') }}</label>
                            <div id="current_images_grid" class="grid grid-cols-2 md:grid-cols-4 gap-3"></div>
                        </div>

                        <div class="md:col-span-2 flex items-center pb-1">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" id="item_is_active" value="1" checked
                                       class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-300 rounded-full peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:bg-blue-600 transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:w-5 after:h-5 after:bg-white after:rounded-full after:shadow after:transition-all after:duration-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full"></div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-700">{{ __('messages.hero_is_active') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" onclick="window.closeModal()"
                                class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">{{ __('messages.cancel') }}</button>
                        <button type="submit"
                                class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> {{ __('messages.save_updates') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const sectionForm = document.getElementById('sectionForm');
                if (sectionForm) {
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
                    document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', () => window.switchTab(btn.dataset.tab)));

                    sectionForm.addEventListener('submit', (e) => {
                        let hasError = false, firstErrorTab = null, firstErrorField = null;
                        document.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
                        document.querySelectorAll('#sectionForm input[required], #sectionForm textarea[required]').forEach(el => {
                            el.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                            el.classList.add('border-gray-300');
                        });
                        document.getElementById('badge-ar').classList.add('hidden');
                        document.getElementById('badge-en').classList.add('hidden');

                        const requiredFields = [
                            {id: 'label_ar', tab: 'ar'}, {id: 'label_en', tab: 'en'},
                            {id: 'heading_ar', tab: 'ar'}, {id: 'heading_en', tab: 'en'},
                            {id: 'description_ar', tab: 'ar'}, {id: 'description_en', tab: 'en'}
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
                            window.switchTab(firstErrorTab);
                            setTimeout(() => {
                                firstErrorField.focus();
                                firstErrorField.scrollIntoView({behavior: 'smooth', block: 'center'});
                            }, 150);
                            const isAr = document.documentElement.dir === 'rtl';
                            if (typeof toastr !== 'undefined') {
                                toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", {
                                    positionClass: isAr ? "toast-top-left" : "toast-top-right",
                                    timeOut: 4000
                                });
                            }
                        }
                    });

                    sectionForm.addEventListener('input', (e) => {
                        if (e.target.hasAttribute('required')) {
                            e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                            e.target.classList.add('border-gray-300');
                            document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');
                            const lang = e.target.id.split('_')[1];
                            if (e.target.value.trim()) document.getElementById(`badge-${lang}`).classList.add('hidden');
                        }
                    });
                }




                const form = document.getElementById('productForm');
                const modal = document.getElementById('productModal');

                window.openAddModal = function () {
                    if (!form || !modal) return;
                    form.reset();
                    form.action = "{{ route('admin.products.store') }}";
                    document.getElementById('formMethod').value = "POST";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.add_product') }}";
                    document.getElementById('item_is_active').checked = true;
                    document.getElementById('item_order').value = 0;
                    document.getElementById('current_images_section').classList.add('hidden');
                    window.clearErrors();
                    modal.classList.remove('hidden');
                };

                window.openEditModal = function (product) {
                    if (!form || !modal) return;
                    form.action = `/admin/products/${product.id}`;
                    document.getElementById('formMethod').value = "PUT";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.edit') }}";

                    document.getElementById('item_name_ar').value = product.name?.ar || '';
                    document.getElementById('item_name_en').value = product.name?.en || '';
                    document.getElementById('item_description_ar').value = product.description?.ar || '';
                    document.getElementById('item_description_en').value = product.description?.en || '';
                    document.getElementById('item_price').value = product.price || '';
                    document.getElementById('item_order').value = product.order || 0;
                    document.getElementById('item_category_id').value = product.category_id || '';
                    document.getElementById('item_brand_id').value = product.partner_id || '';
                    document.getElementById('item_is_active').checked = Number(product.is_active) === 1;

                    // عرض الصور الحالية
                    const imagesSection = document.getElementById('current_images_section');
                    const imagesGrid = document.getElementById('current_images_grid');
                    imagesGrid.innerHTML = '';

                    if (product.images && product.images.length > 0) {
                        product.images.forEach(img => {
                            const div = document.createElement('div');
                            div.className = 'relative group';
                            div.innerHTML = `
                    <img src="/storage/${img.image}" class="w-full h-24 object-cover rounded-lg border">
                    <form action="/admin/product-images/${img.id}" method="POST" class="absolute top-1 right-1 hidden group-hover:block">
                        @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-1 rounded-full text-xs" onclick="return confirm('حذف هذه الصورة؟')">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
`;
                            imagesGrid.appendChild(div);
                        });
                        imagesSection.classList.remove('hidden');
                    } else {
                        imagesSection.classList.add('hidden');
                    }

                    window.clearErrors();
                    modal.classList.remove('hidden');
                };

                window.closeModal = function () {
                    if (modal) {
                        modal.classList.add('hidden');
                        window.clearErrors();
                    }
                };

                window.clearErrors = function () {
                    document.querySelectorAll('#productModal .field-error').forEach(el => el.classList.add('hidden'));
                    ['item_name_ar', 'item_name_en'].forEach(id => {
                        const input = document.getElementById(id);
                        if (input) {
                            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                            input.classList.add('border-gray-300');
                        }
                    });
                };

                form.addEventListener('submit', (e) => {
                    let hasError = false, firstErrorField = null;
                    window.clearErrors();

                    const requiredFields = ['item_name_ar', 'item_name_en'];
                    requiredFields.forEach(id => {
                        const input = document.getElementById(id);
                        if (input && !input.value.trim()) {
                            hasError = true;
                            if (!firstErrorField) firstErrorField = input;
                            document.getElementById(`error-${id}`).classList.remove('hidden');
                            input.classList.remove('border-gray-300');
                            input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                        }
                    });

                    if (hasError) {
                        e.preventDefault();
                        setTimeout(() => {
                            firstErrorField.focus();
                            firstErrorField.scrollIntoView({behavior: 'smooth', block: 'center'});
                        }, 150);
                        if (typeof toastr !== 'undefined') toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", {
                            positionClass: document.documentElement.dir === 'rtl' ? "toast-top-left" : "toast-top-right",
                            timeOut: 4000
                        });
                    }
                });

                form.addEventListener('input', (e) => {
                    if (['item_name_ar', 'item_name_en'].includes(e.target.id)) {
                        e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        e.target.classList.add('border-gray-300');
                        document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');
                    }
                });
            });

            window.copyField = function (sourceId, targetId) {
                const source = document.getElementById(sourceId);
                const target = document.getElementById(targetId);
                if (source && target && source.value.trim() !== '') {
                    target.value = source.value;
                    target.classList.add('bg-green-50', 'border-green-400', 'ring-2', 'ring-green-200');
                    setTimeout(() => target.classList.remove('bg-green-50', 'border-green-400', 'ring-2', 'ring-green-200'), 1500);
                    if (typeof toastr !== 'undefined') toastr.success('تم النسخ بنجاح', '', {timeOut: 1500});
                }
            };
        </script>
    @endpush
@endsection
