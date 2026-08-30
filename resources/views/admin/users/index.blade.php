@extends('admin.layouts.app')
@section('title', __('messages.users_management'))
@section('page_title', __('messages.users_management'))

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-users text-blue-500"></i> {{ __('messages.users_list') }}
            </h3>
            <button onclick="window.openAddModal()"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-plus"></i> {{ __('messages.add_user') }}
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold text-start">{{ __('messages.user_name') }}</th>
                    <th class="px-6 py-4 font-semibold text-start">{{ __('messages.user_email') }}</th>
                    <th class="px-6 py-4 font-semibold text-start">{{ __('messages.user_roles') }}</th>
                    <th class="px-6 py-4 font-semibold text-center">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-800 text-start">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-600 text-start" >{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach($user->roles as $role)
                                    <span
                                        class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-semibold border border-blue-100">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    type="button"
                                    onclick='window.openEditModal(
                                        {{ $user->id }},
                                        @json($user->name),
                                        @json($user->email),
                                        @json($user->roles->pluck("name")->toArray())
                                    )'
                                    class="text-blue-600 hover:text-blue-800 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                                    title="{{ __('messages.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="confirmDelete('{{ route('admin.users.destroy', $user->id) }}', '{{ $user->gname }}')"
                                        class="text-red-600 hover:text-red-800 p-2 bg-red-50 rounded-lg hover:bg-red-100 transition-colors" title="{{ __('messages.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-users-slash text-4xl mb-3 text-gray-300"></i>
                            <p>{{ __('messages.no_users_found') }}</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="window.closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-xl shadow-xl sm:my-8 sm:align-middle sm:p-6">
                <div class="flex justify-between items-center mb-5 border-b pb-3">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-user-plus text-blue-500"></i> <span
                            id="modalTitleText">{{ __('messages.add_user') }}</span>
                    </h3>
                    <button onclick="window.closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="userForm" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-start">
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.user_name') }}
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="item_name"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_name"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.user_email') }}
                                <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="item_email"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   dir="ltr" required>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_email"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.password') }}
                                <span id="password_required" class="text-red-500">*</span></label>
                            <input type="password" name="password" id="item_password"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   dir="ltr">
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_password"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.this_field_is_required') }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.confirm_password') }}
                                <span id="confirm_password_required" class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" id="item_password_confirmation"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all"
                                   dir="ltr">
                        </div>
                        <div class="md:col-span-2">
                            <label
                                class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.user_roles') }}
                                <span class="text-red-500">*</span></label>
                            <div
                                class="grid grid-cols-2 md:grid-cols-3 gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200"
                                id="roles_container">
                                @foreach($roles as $role)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                               class="role-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="field-error text-red-500 text-xs mt-1.5 hidden" id="error-item_roles"><i
                                    class="fas fa-exclamation-circle"></i> {{ __('messages.select_at_least_one_role') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" onclick="window.closeModal()"
                                class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">{{ __('messages.cancel') }}</button>
                        <button type="submit"
                                class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> {{ __('messages.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('userForm');
                const modal = document.getElementById('userModal');
                window.openAddModal = function () {
                    if (!form || !modal) return;
                    form.reset();
                    form.action = "{{ route('admin.users.store') }}";
                    document.getElementById('formMethod').value = "POST";
                    document.getElementById('user_id').value = "";
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.add_user') }}";
                    document.getElementById('item_password').setAttribute('required', 'required');
                    document.getElementById('item_password_confirmation').setAttribute('required', 'required');
                    document.getElementById('password_required').classList.remove('hidden');
                    document.getElementById('confirm_password_required').classList.remove('hidden');

                    window.clearErrors();
                    modal.classList.remove('hidden');
                };

                window.openEditModal = function (userId, userName, userEmail, userRoles) {
                    if (!form || !modal) return;
                    form.action = `/admin/users/${userId}`;
                    document.getElementById('formMethod').value = "PUT";
                    document.getElementById('user_id').value = userId;
                    document.getElementById('modalTitleText').innerText = "{{ __('messages.edit_user') }}";
                    document.getElementById('item_name').value = userName;
                    document.getElementById('item_email').value = userEmail;

                    document.getElementById('item_password').removeAttribute('required');
                    document.getElementById('item_password_confirmation').removeAttribute('required');
                    document.getElementById('password_required').classList.add('hidden');
                    document.getElementById('confirm_password_required').classList.add('hidden');
                    document.querySelectorAll('.role-checkbox').forEach(checkbox => {
                        checkbox.checked = userRoles.includes(checkbox.value);
                    });
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
                    document.querySelectorAll('#userModal .field-error').forEach(el => el.classList.add('hidden'));
                    ['item_name', 'item_email', 'item_password', 'item_roles'].forEach(id => {
                        const input = document.getElementById(id);
                        if (input) {
                            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                            input.classList.add('border-gray-300');
                        }
                    });
                };
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    let hasError = false;
                    let firstErrorField = null;
                    window.clearErrors();
                    const requiredFields = ['item_name', 'item_email'];
                    const isAdding =
                        document.getElementById('formMethod').value === 'POST';
                    if (isAdding) {
                        requiredFields.push('item_password');
                    }
                    requiredFields.forEach(id => {
                        const input = document.getElementById(id);
                        if (input && !input.value.trim()) {
                            hasError = true;
                            if (!firstErrorField) {
                                firstErrorField = input;
                            }
                            document.getElementById(`error-${id}`)
                                ?.classList.remove('hidden');
                            input.classList.remove('border-gray-300');
                            input.classList.add(
                                'border-red-500',
                                'ring-2',
                                'ring-red-200'
                            );
                        }
                    });
                    const checkedRoles = document.querySelectorAll('.role-checkbox:checked');
                    if (checkedRoles.length === 0) {
                        hasError = true;
                        document.getElementById('error-item_roles')
                            ?.classList.remove('hidden');
                    }
                    if (hasError) {
                        if (firstErrorField) {
                            setTimeout(() => {
                                firstErrorField.focus();
                                firstErrorField.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }, 150);
                        }
                        toastr.error(
                            "{{ __('messages.fill_required_fields') }}",
                            "{{ __('messages.validation_error') }}",
                            {
                                positionClass: "{{ app()->getLocale() === 'ar' ? 'toast-top-left' : 'toast-top-right' }}",
                                timeOut: 4000
                            }
                        );
                        return;
                    }
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalButtonHtml = submitButton.innerHTML;
                    submitButton.disabled = true;
                    submitButton.innerHTML = `
                                <i class="fas fa-spinner fa-spin"></i>
                                {{ __('messages.saving') }}
                                            `;
                    try {
                        const formData = new FormData(form);
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        const data = await response.json();
                        if (response.status === 422) {
                            const errors = data.errors || {};
                            Object.keys(errors).forEach(field => {
                                const messages = errors[field];
                                let inputId = '';
                                if (field === 'name') {
                                    inputId = 'item_name';
                                }
                                if (field === 'email') {
                                    inputId = 'item_email';
                                }
                                if (field === 'password') {
                                    inputId = 'item_password';
                                }
                                if (field === 'roles' || field.startsWith('roles.')) {
                                    inputId = 'item_roles';
                                }
                                if (inputId) {
                                    const input =
                                        document.getElementById(inputId);
                                    const errorElement =
                                        document.getElementById(`error-${inputId}`);
                                    if (input) {
                                        input.classList.remove(
                                            'border-gray-300'
                                        );
                                        input.classList.add(
                                            'border-red-500',
                                            'ring-2',
                                            'ring-red-200'
                                        );
                                    }
                                    if (errorElement) {
                                        errorElement.innerHTML = `
                            <i class="fas fa-exclamation-circle"></i>
                            ${messages[0]}
                        `;
                                        errorElement.classList.remove('hidden');
                                    }
                                }
                                messages.forEach(message => {
                                    toastr.error(
                                        message,
                                        "{{ __('messages.validation_error') }}",
                                        {
                                            positionClass:
                                                "{{ app()->getLocale() === 'ar' ? 'toast-top-left' : 'toast-top-right' }}",
                                            timeOut: 5000
                                        }
                                    );
                                });
                            });
                            return;
                        }
                        if (response.ok && data.success) {
                            toastr.success(
                                data.message,
                                "{{ __('messages.success') }}",
                                {
                                    positionClass:
                                        "{{ app()->getLocale() === 'ar' ? 'toast-top-left' : 'toast-top-right' }}",
                                    timeOut: 3000
                                }
                            );
                            window.closeModal();
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                            return;
                        }
                        toastr.error(
                            "{{ __('messages.something_went_wrong') }}",
                            "{{ __('messages.error') }}"
                        );
                    } catch (error) {
                        console.error(error);
                        toastr.error(
                            "{{ __('messages.something_went_wrong') }}",
                            "{{ __('messages.error') }}"
                        );
                    } finally {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonHtml;
                    }
                });
                form.addEventListener('input', (e) => {
                    if (['item_name', 'item_email', 'item_password'].includes(e.target.id)) {
                        e.target.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                        e.target.classList.add('border-gray-300');
                        document.getElementById(`error-${e.target.id}`)?.classList.add('hidden');
                    }
                });
            });
        </script>
    @endpush
@endsection
