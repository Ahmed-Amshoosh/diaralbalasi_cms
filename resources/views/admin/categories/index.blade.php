@extends('admin.layouts.app')
@section('title', __('messages.categories_management'))
@section('page_title', __('messages.categories_management'))

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-tags text-blue-500"></i> {{ __('messages.categories_management') }}
            </h3>
            <button onclick="window.openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-plus"></i> {{ __('messages.add_category') }}
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold text-start">{{ __('messages.hero_order') }}</th>
                    <th class="px-6 py-4 font-semibold text-start">{{ __('messages.category_image') }}</th>
                    <th class="px-6 py-4 font-semibold text-start">{{ __('messages.category_name') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.status') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800 text-start">{{ $category->order }}</td>
                        <td class="px-6 py-4">
                            @if($category->image)
                                <img src="{{ $category->image_url }}" alt="{{ $category->getTranslation('name', app()->getLocale()) }}" class="h-12 w-12 object-cover rounded-lg border border-gray-200">
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800 text-start">
                            {{ $category->getTranslation('name', app()->getLocale()) }}
                            @if($category->icon)
                                <span class="ml-2 text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded"><i class="{{ $category->icon }}"></i> {{ $category->icon }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($category->is_active)
                                <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-100">{{ __('messages.active') }}</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold border border-gray-200">{{ __('messages.inactive') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick='window.openEditModal(@json($category))' class="text-blue-600 hover:text-blue-800 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors" title="{{ __('messages.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا التصنيف؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 bg-red-50 rounded-lg hover:bg-red-100 transition-colors" title="{{ __('messages.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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

    {{-- Modal إضافة/تعديل تصنيف --}}
    <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="window.closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-xl shadow-xl sm:my-8 sm:align-middle sm:p-6">
                <div class="flex justify-between items-center mb-5 border-b pb-3">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-tag text-blue-500"></i> <span id="modalTitleText">{{ __('messages.add_category') }}</span>
                    </h3>
                    <button onclick="window.closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                {{-- ملاحظة هامة: إضافة enctype="multipart/form-data" ضرورية لرفع الملفات --}}
                <form id="categoryForm" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-start">
                        {{-- الاسم عربي --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.category_name') }} (عربي) <span class="text-red-500">*</span></label>
                            <input type="text" name="name_ar" id="item_name_ar" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="rtl" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_name_ar"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>

                        {{-- الاسم إنجليزي --}}
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.category_name') }} (English) <span class="text-red-500">*</span></label>
                            <input type="text" name="name_en" id="item_name_en" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_name_en"><i class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}</p>
                        </div>

                        {{-- الأيقونة --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.category_icon') }}</label>
                            <input type="text" name="icon" id="item_icon" placeholder="{{ __('messages.icon_placeholder') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="ltr">
                        </div>

                        {{-- الترتيب --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.hero_order') }}</label>
                            <input type="number" name="order" id="item_order" value="0" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        {{-- صورة التصنيف --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                {{ __('messages.category_image') }}
                            </label>

                            <div id="current_image_preview" class="hidden mb-3">
                                <img
                                    src=""
                                    alt="{{ __('messages.category_image') }}"
                                    class="h-20 w-auto object-contain rounded-lg border border-gray-200 p-1 bg-gray-50"
                                >
                            </div>

                            <input
                                type="file"
                                name="image"
                                id="item_image"
                                accept="image/*"
                                class="hidden"
                            >

                            <label
                                for="item_image"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-700 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors"
                            >
                                <i class="fas fa-upload"></i>
                                {{ __('messages.choose_file') }}
                            </label>

                            <span id="selected_image" class="text-sm text-gray-500 ms-2">
        {{ __('messages.no_file_chosen') }}
    </span>
                        </div>

                        {{-- الحالة --}}
                        <div class="md:col-span-2 flex items-center pb-1">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" id="item_is_active" value="1" checked class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-300 rounded-full peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:bg-blue-600 transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:w-5 after:h-5 after:bg-white after:rounded-full after:shadow after:transition-all after:duration-200 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full"></div>
                                <span class="ms-3 text-sm font-medium text-gray-700">{{ __('messages.hero_is_active') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" onclick="window.closeModal()" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">{{ __('messages.cancel') }}</button>
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
                const form = document.getElementById('categoryForm');
                const modal = document.getElementById('categoryModal');

                window.openAddModal = function() {
                    if (!form || !modal) return;
                    form.reset();
                    form.action = "{{ route('admin.categories.store') }}";
                    document.getElementById('formMethod').value = "POST";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.add_category') }}";
                    document.getElementById('item_is_active').checked = true;
                    document.getElementById('item_order').value = 0;
                    document.getElementById('current_image_preview').classList.add('hidden'); // إخفاء المعاينة عند الإضافة
                    window.clearErrors();
                    modal.classList.remove('hidden');
                };

                window.openEditModal = function(category) {
                    if (!form || !modal) return;
                    form.action = `/admin/categories/${category.id}`;
                    document.getElementById('formMethod').value = "PUT";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.edit') }}";

                    document.getElementById('item_name_ar').value = category.name?.ar || '';
                    document.getElementById('item_name_en').value = category.name?.en || '';
                    document.getElementById('item_icon').value = category.icon || '';
                    document.getElementById('item_order').value = category.order || 0;
                    document.getElementById('item_is_active').checked = Boolean(category.is_active);

                    // عرض الصورة الحالية إذا كانت موجودة
                    const previewDiv = document.getElementById('current_image_preview');
                    const previewImg = previewDiv.querySelector('img');
                    if (category.image) {
                        previewImg.src = '/storage/' + category.image;
                        previewDiv.classList.remove('hidden');
                    } else {
                        previewDiv.classList.add('hidden');
                    }

                    window.clearErrors();
                    modal.classList.remove('hidden');
                };

                window.closeModal = function() {
                    if (modal) {
                        modal.classList.add('hidden');
                        window.clearErrors();
                    }
                };

                window.clearErrors = function() {
                    document.querySelectorAll('#categoryModal .field-error').forEach(el => el.classList.add('hidden'));
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
                        setTimeout(() => { firstErrorField.focus(); firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 150);
                        if (typeof toastr !== 'undefined') toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", { positionClass: document.documentElement.dir === 'rtl' ? "toast-top-left" : "toast-top-right", timeOut: 4000 });
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
        </script>
    @endpush
@endsection
