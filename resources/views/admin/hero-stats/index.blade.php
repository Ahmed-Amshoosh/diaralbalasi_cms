@extends('admin.layouts.app')
@section('title', __('messages.hero_stats_management'))
@section('page_title', __('messages.hero_stats_management'))

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="text-xl font-bold text-gray-800">{{ __('messages.hero_stats_management') }}</h2>
            @can('create hero-stats')
                <button onclick="openAddModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                    <i class="fas fa-plus"></i> {{ __('messages.add_stat') }}
                </button>
            @endcan
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.hero_order') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.stat_number') }}</th>
                    <th class="px-6 py-4 font-semibold">{{ __('messages.stat_label') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.status') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($stats as $stat)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $stat->order }}</td>
                        <td class="px-6 py-4 font-bold text-blue-600 text-lg">{{ $stat->number }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $stat->getTranslation('label', app()->getLocale()) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($stat->is_active)
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-100">{{ __('messages.active') }}</span>
                            @else
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold border border-gray-200">{{ __('messages.inactive') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @can('edit hero-stats')
                                    <button
                                        onclick="openEditModal({{ $stat->id }}, '{{ $stat->number }}', '{{ addslashes($stat->getTranslation('label', 'ar')) }}', '{{ addslashes($stat->getTranslation('label', 'en')) }}', {{ $stat->order }}, {{ $stat->is_active ? 1 : 0 }})"
                                        class="text-blue-600 hover:text-blue-800 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                                        title="{{ __('messages.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endcan
                                @can('delete hero-stats')
                                    <button
                                        onclick="confirmDelete('{{ route('admin.hero-stats.destroy', $stat->id) }}', '{{ addslashes($stat->getTranslation('label', app()->getLocale())) }}')"
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
    <div id="statModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-xl shadow-xl sm:my-8 sm:align-middle sm:p-6">
                <div class="flex justify-between items-center mb-5 border-b pb-3">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-blue-500"></i> <span
                            id="modalTitleText">{{ __('messages.add_stat') }}</span>
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="statForm" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-start">
                        <div class="md:col-span-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.stat_number') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="number" id="number"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   placeholder="{{ __('messages.stat_number_placeholder') }}" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-number"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.stat_label') }}
                                (عربي) <span class="text-red-500">*</span></label>
                            <input type="text" name="label_ar" id="label_ar"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_ar"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div class="relative">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.stat_label') }}
                                (English) <span class="text-red-500">*</span></label>
                            <input type="text" name="label_en" id="label_en"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                   required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-label_en"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 text-start">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.hero_order') }}</label>
                            <input type="number" name="order" id="order" value="0" min="0"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                                       class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-300 rounded-full
                                      peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:bg-blue-600
                                       transition-colors duration-200
                                       after:content-['']
                                       after:absolute
                                       after:top-[2px]
                                       after:start-[2px]
                                       after:w-5
                                       after:h-5
                                       after:bg-white
                                       after:rounded-full
                                       after:shadow
                                       after:transition-all
                                       after:duration-200

                                       peer-checked:after:translate-x-full
                                       rtl:peer-checked:after:-translate-x-full"></div>

                                <span class="ms-3 text-sm font-medium text-gray-700">
                                    {{ __('messages.hero_is_active') }}
                                </span>
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                            class="mt-2 px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i> {{ __('messages.save_updates') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const form = document.getElementById('statForm');
            const modal = document.getElementById('statModal');
            function openAddModal() {
                form.reset();
                form.action = "{{ route('admin.hero-stats.store') }}";
                document.getElementById('formMethod').value = "POST";
                document.getElementById('modalTitleText').innerText = "{{ __('messages.add_stat') }}";
                document.getElementById('is_active').checked = true;
                document.getElementById('order').value = 0;
                clearErrors();
                modal.classList.remove('hidden');
            }
            function openEditModal(id, number, labelAr, labelEn, order, isActive) {
                form.action = `/admin/hero-stats/${id}`;
                document.getElementById('formMethod').value = "PUT";
                document.getElementById('modalTitleText').innerText = "{{ __('messages.edit') }}";
                document.getElementById('number').value = number;
                document.getElementById('label_ar').value = labelAr;
                document.getElementById('label_en').value = labelEn;
                document.getElementById('order').value = order;
                document.getElementById('is_active').checked = isActive === 1;
                clearErrors();
                modal.classList.remove('hidden');
            }
            function closeModal() {
                modal.classList.add('hidden');
                clearErrors();
            }
            function clearErrors() {
                document.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
                ['number', 'label_ar', 'label_en'].forEach(id => {
                    const input = document.getElementById(id);
                    if (input) {
                        input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        input.classList.add('border-gray-300');
                    }
                });
            }
            form.addEventListener('submit', (e) => {
                let hasError = false, firstErrorField = null;
                clearErrors();
                const requiredFields = ['number', 'label_ar', 'label_en'];
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
                    const isAr = document.documentElement.dir === 'rtl';
                    if (typeof toastr !== 'undefined') {
                        toastr.error("{{ __('messages.fill_required_fields_both_langs') }}", "{{ __('messages.validation_error') }}", {
                            positionClass: isAr ? "toast-top-left" : "toast-top-right",
                            timeOut: 4000
                        });
                    }
                }
            });
            form.addEventListener('input', (e) => {
                if (['number', 'label_ar', 'label_en'].includes(e.target.id)) {
                    e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                    e.target.classList.add('border-gray-300');
                    document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');
                }
            });
            function copyField(sourceId, targetId) {
                const source = document.getElementById(sourceId);
                const target = document.getElementById(targetId);
                if (source && target && source.value.trim() !== '') {
                    target.value = source.value;
                    target.classList.add('bg-green-50', 'border-green-400', 'ring-2', 'ring-green-200');
                    setTimeout(() => target.classList.remove('bg-green-50', 'border-green-400', 'ring-2', 'ring-green-200'), 1500);
                    if (typeof toastr !== 'undefined') toastr.success("{{ app()->getLocale() === 'ar' ? 'تم النسخ بنجاح' : 'Copied successfully' }}", '', {timeOut: 1500});
                }
            }
        </script>
    @endpush
@endsection
