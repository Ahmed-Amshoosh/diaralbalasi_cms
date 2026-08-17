@extends('admin.layouts.app')
@section('title', __('messages.contact_messages'))
@section('page_title', __('messages.contact_messages'))

@section('content')
    <div class="mx-auto">
        <form action="{{ route('admin.contact-section.update') }}" method="POST">
            @csrf @method('PUT')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-language text-blue-500"></i> {{ __('messages.text_content') }}
                    </h3>
                </div>
                <div class="px-6 pt-4">
                    <div class="flex border-b border-gray-200">
                        <button type="button" data-tab="ar" class="tab-btn flex items-center gap-2 px-6 py-3 text-sm font-bold text-blue-600 border-b-4 border-blue-600 bg-white rounded-t-lg shadow-sm transition-all duration-300">
                            <span>{{ __('messages.arabic_tab') }}</span>
                        </button>
                        <button type="button" data-tab="en" class="tab-btn flex items-center gap-2 px-6 py-3 text-sm font-medium text-gray-500 border-b-4 border-transparent hover:text-gray-700 hover:bg-gray-50 rounded-t-lg transition-all duration-300">
                            <span>{{ __('messages.english_tab') }}</span>
                        </button>
                    </div>
                </div>

                <div class="p-6">
                    <div id="tab-content-ar" class="tab-content space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.contact_label') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="label_ar" value="{{ old('label_ar', $section?->getTranslation('label', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="rtl" >
                            @error('label_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.contact_heading') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="heading_ar" value="{{ old('heading_ar', $section?->getTranslation('heading', 'ar') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="rtl" >
                            @error('heading_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.contact_description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description_ar" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all resize-none" dir="rtl" >{{ old('description_ar', $section?->getTranslation('description', 'ar') ?? '') }}</textarea>
                            @error('description_ar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div id="tab-content-en" class="tab-content space-y-5 hidden">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.contact_label') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="label_en" value="{{ old('label_en', $section?->getTranslation('label', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="ltr" >
                            @error('label_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.contact_heading') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="heading_en" value="{{ old('heading_en', $section?->getTranslation('heading', 'en') ?? '') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all" dir="ltr" >
                            @error('heading_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('messages.contact_description') }} <span class="text-red-500">*</span></label>
                            <textarea name="description_en" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all resize-none" dir="ltr" >{{ old('description_en', $section?->getTranslation('description', 'en') ?? '') }}</textarea>
                            @error('description_en') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pb-8">
                <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> {{ __('messages.save_updates') }}
                </button>
            </div>
        </form>
    </div>
    <div class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.contact-messages.index', ['filter' => 'all']) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all {{ $filter === 'all' ? 'ring-2 ring-blue-500' : '' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">{{ __('messages.total_messages') }}</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $messages->total() }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-inbox text-blue-500 text-2xl"></i>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.contact-messages.index', ['filter' => 'unread']) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all {{ $filter === 'unread' ? 'ring-2 ring-orange-500' : '' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">{{ __('messages.unread_messages') }}</p>
                        <p class="text-3xl font-bold text-orange-600">{{ $unreadCount }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-orange-50 flex items-center justify-center">
                        <i class="fas fa-envelope-open-text text-orange-500 text-2xl"></i>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.contact-messages.index', ['filter' => 'read']) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all {{ $filter === 'read' ? 'ring-2 ring-green-500' : '' }}">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">{{ __('messages.read_messages') }}</p>
                        <p class="text-3xl font-bold text-green-600">{{ \App\Models\ContactMessage::read()->count() }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center">
                        <i class="fas fa-envelope-open text-green-500 text-2xl"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-list text-blue-500"></i>
                    @if($filter === 'unread')
                        {{ __('messages.unread_messages') }}
                    @elseif($filter === 'read')
                        {{ __('messages.read_messages') }}
                    @else
                        {{ __('messages.all_messages') }}
                    @endif
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold">{{ __('messages.message_status') }}</th>
                        <th class="px-6 py-4 font-semibold">{{ __('messages.sender') }}</th>
                        <th class="px-6 py-4 font-semibold">{{ __('messages.message_subject') }}</th>
                        <th class="px-6 py-4 font-semibold">{{ __('messages.message_date') }}</th>
                        <th class="px-6 py-4 font-semibold text-center">{{ __('messages.actions') }}</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-gray-50/50 transition-colors {{ !$msg->is_read ? 'bg-blue-50/30' : '' }}">

                            <td class="px-6 py-4">
                                @if($msg->is_read)
                                    <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-100">
                                        <i class="fas fa-check-circle"></i> {{ __('messages.status_read') }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-orange-50 text-orange-700 rounded-full text-xs font-semibold border border-orange-100">
                                        <i class="fas fa-clock"></i> {{ __('messages.status_unread') }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $msg->name }}</div>
                                <div class="text-xs text-gray-500 mt-0.5" dir="ltr">{{ $msg->phone }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $msg->subject }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($msg->message, 50) }}</div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $msg->created_at->diffForHumans() }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('admin.contact-messages.show', $msg->id) }}"
                                       class="text-blue-600 hover:text-blue-800 p-2 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                                       title="{{ __('messages.view') }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if(!$msg->is_read)
                                        <form action="{{ route('admin.contact-messages.mark-read', $msg->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                    class="text-green-600 hover:text-green-800 p-2 bg-green-50 rounded-lg hover:bg-green-100 transition-colors"
                                                    title="{{ __('messages.mark_as_read') }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <button
                                        type="button"
                                        onclick="confirmDelete(
        '{{ route('admin.contact-messages.destroy', $msg->id) }}',
        '{{ addslashes($msg->subject) }}'
    )"
                                        class="text-red-600 hover:text-red-800 p-2 bg-red-50 rounded-lg hover:bg-red-100 transition-colors"
                                        title="{{ __('messages.delete') }}"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p>{{ __('messages.no_messages') }}</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($messages->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $messages->appends(['filter' => $filter])->links() }}
                </div>
            @endif
        </div>
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

                @if($errors->any())
                @foreach($errors->all() as $error)
                toastr.error("{{ $error }}", "خطأ", { positionClass: "{{ app()->getLocale() === 'ar' ? 'toast-top-left' : 'toast-top-right' }}", timeOut: 4000 });
                @endforeach
                @endif
            });
        </script>
    @endpush
@endsection
