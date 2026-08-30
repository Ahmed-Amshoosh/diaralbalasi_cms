<div class="feature-item p-5 border border-gray-200 rounded-lg bg-gray-50/50 relative group transition-all hover:shadow-md">
    <div class="flex justify-between">
        <h4 class="text-sm font-bold text-gray-700 mb-4 border-b pb-2 flex items-center gap-2">
            {{ __('messages.feature_number', ['number' => $index + 1]) }}
        </h4>
        <button
            type="button"
            class="remove-feature-btn text-gray-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-full transition-colors"
            title="{{ __('messages.delete_feature') }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('messages.icon_class') }}
            </label>
            <input
                type="text"
                name="features[{{ $index }}][icon]"
                value="{{ old('features.'.$index.'.icon', $feat['icon'] ?? '') }}"
                placeholder="fa-certificate"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                dir="ltr">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('messages.title_arabic') }}
            </label>
            <input
                type="text"
                name="features[{{ $index }}][title_ar]"
                value="{{ old('features.'.$index.'.title_ar', $feat['title_ar'] ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                dir="rtl">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('messages.title_english') }}
            </label>
            <input
                type="text"
                name="features[{{ $index }}][title_en]"
                value="{{ old('features.'.$index.'.title_en', $feat['title_en'] ?? '') }}"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg"
                dir="ltr">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('messages.description_arabic') }}
            </label>
            <textarea
                name="features[{{ $index }}][desc_ar]"
                rows="2"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg resize-none"
                dir="rtl">{{ old('features.'.$index.'.desc_ar', $feat['desc_ar'] ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('messages.description_english') }}
            </label>
            <textarea
                name="features[{{ $index }}][desc_en]"
                rows="2"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg resize-none"
                dir="ltr">{{ old('features.'.$index.'.desc_en', $feat['desc_en'] ?? '') }}</textarea>
        </div>
    </div>
</div>
