@extends('admin.layouts.app')
@section('title', __('messages.why_us_management'))
@section('page_title', __('messages.why_us_management'))

@section('content')
    <div class="space-y-8">

        {{-- ═══════════════════════════════════════════ --}}
        {{-- الجزء الأول: إعدادات محتوى القسم --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-cog text-blue-500"></i> {{ __('messages.why_us_section_settings') }}
                </h3>
            </div>

            <form id="sectionForm" action="{{ route('admin.why-us.section.update') }}" method="POST" novalidate>
                @csrf @method('PUT')

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
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_label') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="label_ar" id="label_ar" value="{{ old('label_ar', $section?->getTranslation('label', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_heading') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="heading_ar" id="heading_ar" value="{{ old('heading_ar', $section?->getTranslation('heading', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-heading_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" dir="rtl" required>{{ old('description_ar', $section?->getTranslation('description', 'ar') ?? '') }}</textarea>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-description_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                    </div>

                    <div id="tab-content-en" class="tab-content space-y-5 hidden">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_label') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="label_en" id="label_en" value="{{ old('label_en', $section?->getTranslation('label', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_heading') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="heading_en" id="heading_en" value="{{ old('heading_en', $section?->getTranslation('heading', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-heading_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description_en" id="description_en" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" dir="ltr" required>{{ old('description_en', $section?->getTranslation('description', 'en') ?? '') }}</textarea>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-description_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-sm transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i> {{ __('messages.save_section_settings') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- الجزء الثاني: إدارة بطاقات لماذا نحن --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-layer-group text-purple-500"></i> {{ __('messages.why_us_items_management') }}
                </h3>
                @can('create why-us')
                    <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                    <i class="fas fa-plus"></i> {{ __('messages.add_why_us_item') }}
                </button>
                @endcan

            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold text">{{ __('messages.hero_order') }}</th>
                        <th class="px-6 py-4 font-semibold text">{{ __('messages.why_us_icon') }}</th>
                        <th class="px-6 py-4 font-semibold text">{{ __('messages.why_us_title') }}</th>
                        <th class="px-6 py-4 font-semibold text-center">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4 font-semibold text-center">{{ __('messages.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse($items as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->order }}</td>
                            <td class="px-6 py-4">
                                @if($item->icon)
                                    <i class="fas {{ $item->icon }} text-2xl text-blue-500"></i>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $item->getTranslation('title', app()->getLocale()) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->is_active)
                                    <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-100">{{ __('messages.active') }}</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold border border-gray-200">{{ __('messages.inactive') }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    @can('edit why-us')
                                        <button onclick="openEditModal({{ $item->id }}, '{{ $item->icon }}', '{{ addslashes($item->getTranslation('title', 'ar')) }}', '{{ addslashes($item->getTranslation('title', 'en')) }}', '{{ addslashes($item->getTranslation('description', 'ar')) }}', '{{ addslashes($item->getTranslation('description', 'en')) }}', {{ $item->order }}, {{ $item->is_active ? 1 : 0 }})"
                                                                class="text-blue-600 hover:text-blue-800 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors" title="{{ __('messages.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endcan
                                    @can('delete why-us')
                                        <button onclick="confirmDelete('{{ route('admin.why-us-items.destroy', $item->id) }}', '{{ addslashes($item->getTranslation('title', app()->getLocale())) }}')"
                                                                 class="text-red-600 hover:text-red-800 p-2 bg-red-50 rounded-lg hover:bg-red-100 transition-colors" title="{{ __('messages.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p>{{ __('messages.no_data') }}</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- Modal إدارة البطاقات (مع IDs فريدة) --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div id="itemModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="relative inline-block w-full max-w-3xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-xl shadow-xl sm:my-8 sm:align-middle sm:p-6">
                <div class="flex justify-between items-center mb-5 border-b pb-3">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-star text-yellow-500"></i> <span id="modalTitleText">{{ __('messages.add_why_us_item') }}</span>
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="itemForm" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-start">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_icon') }}</label>
                            <input type="text" name="icon" id="item_icon" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="fa-award" dir="ltr">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_title') }} (عربي) <span class="text-red-500">*</span></label>
                            <input type="text" name="title_ar" id="item_title_ar" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_title_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_title') }} (English) <span class="text-red-500">*</span></label>
                            <input type="text" name="title_en" id="item_title_en" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_title_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_item_description') }} (عربي) <span class="text-red-500">*</span></label>
                            <textarea name="description_ar" id="item_description_ar" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" dir="rtl" required></textarea>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_description_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.why_us_item_description') }} (English) <span class="text-red-500">*</span></label>
                            <textarea name="description_en" id="item_description_en" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" dir="ltr" required></textarea>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_description_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 text-start">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.hero_order') }}</label>
                            <input type="number" name="order" id="item_order" value="0" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" id="item_is_active" value="1" checked class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-300 rounded-full peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:bg-blue-600 transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:w-5 after:h-5 after:bg-white after:rounded-full after:shadow after:transition-all after:duration-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full"></div>
                                <span class="ms-3 text-sm font-medium text-gray-700">{{ __('messages.hero_is_active') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeModal()" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                            {{ __('messages.cancel') }}
                        </button>
                        <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
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
                // ─── 1. منطق تبويبات قسم الإعدادات والتحقق منها ───
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
                            { id: 'label_ar', tab: 'ar' }, { id: 'label_en', tab: 'en' },
                            { id: 'heading_ar', tab: 'ar' }, { id: 'heading_en', tab: 'en' },
                            { id: 'description_ar', tab: 'ar' }, { id: 'description_en', tab: 'en' }
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
                            window.switchTab(firstErrorTab);
                            setTimeout(() => { firstErrorField.focus(); firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 150);
                            const isAr = document.documentElement.dir === 'rtl';
                            if (typeof toastr !== 'undefined') {
                                toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", { positionClass: isAr ? "toast-top-left" : "toast-top-right", timeOut: 4000 });
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

                // ─── 2. منطق Modal البطاقات ───
                const itemForm = document.getElementById('itemForm');
                const modal = document.getElementById('itemModal');

                // ربط الدوال بـ window لتكون متاحة لـ onclick في HTML
                window.openAddModal = function() {
                    if (!itemForm || !modal) return;
                    itemForm.reset();
                    itemForm.action = "{{ route('admin.why-us-items.store') }}";
                    document.getElementById('formMethod').value = "POST";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.add_why_us_item') }}";
                    document.getElementById('item_is_active').checked = true;
                    document.getElementById('item_order').value = 0;
                    window.clearItemErrors();
                    modal.classList.remove('hidden');
                };

                window.openEditModal = function(id, icon, titleAr, titleEn, descAr, descEn, order, isActive) {
                    if (!itemForm || !modal) return;
                    itemForm.action = `/admin/why-us-items/${id}`;
                    document.getElementById('formMethod').value = "PUT";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.edit') }}";

                    document.getElementById('item_icon').value = icon || '';
                    document.getElementById('item_title_ar').value = titleAr;
                    document.getElementById('item_title_en').value = titleEn;
                    document.getElementById('item_description_ar').value = descAr;
                    document.getElementById('item_description_en').value = descEn;
                    document.getElementById('item_order').value = order;
                    document.getElementById('item_is_active').checked = isActive === 1;

                    window.clearItemErrors();
                    modal.classList.remove('hidden');
                };

                window.closeModal = function() {
                    if (!modal) return;
                    modal.classList.add('hidden');
                    window.clearItemErrors();
                };

                window.clearItemErrors = function() {
                    document.querySelectorAll('#itemModal .field-error').forEach(el => el.classList.add('hidden'));
                    ['item_title_ar', 'item_title_en', 'item_description_ar', 'item_description_en'].forEach(id => {
                        const input = document.getElementById(id);
                        if(input) {
                            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                            input.classList.add('border-gray-300');
                        }
                    });
                };

                itemForm.addEventListener('submit', (e) => {
                    let hasError = false, firstErrorField = null;
                    window.clearItemErrors();

                    const requiredFields = ['item_title_ar', 'item_title_en', 'item_description_ar', 'item_description_en'];
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
                        setTimeout(() => { firstErrorField.focus(); firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 150);
                        const isAr = document.documentElement.dir === 'rtl';
                        if (typeof toastr !== 'undefined') {
                            toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", { positionClass: isAr ? "toast-top-left" : "toast-top-right", timeOut: 4000 });
                        }
                    }
                });

                itemForm.addEventListener('input', (e) => {
                    if (['item_title_ar', 'item_title_en', 'item_description_ar', 'item_description_en'].includes(e.target.id)) {
                        e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        e.target.classList.add('border-gray-300');
                        document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');
                    }
                });
            });
        </script>
    @endpush
@endsection
