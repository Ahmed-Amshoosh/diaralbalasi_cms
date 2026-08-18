@extends('frontend.layouts.app')
@section('title', $product->getTranslation('name', app()->getLocale()) . ' - ' . config('app.name'))

@section('content')
    <div class="container mx-auto px-4 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home ml-2"></i> الرئيسية
                    </a>
                </li>
                @if($product->category)
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 mx-2"></i>
                            <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">{{ $product->category->getTranslation('name', app()->getLocale()) }}</a>
                        </div>
                    </li>
                @endif
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-gray-400 mx-2"></i>
                        <span class="text-sm font-medium text-gray-500">{{ $product->getTranslation('name', app()->getLocale()) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- ═══════════════════════════════════════════ --}}
            {{-- معرض الصور (Gallery) --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div class="space-y-4">
                {{-- الصورة الرئيسية --}}
                <div class="relative rounded-2xl overflow-hidden bg-gray-100 aspect-square">
                    @if($product->images->count() > 0)
                        <img id="main-product-image" src="{{ $product->images->first()->image_url }}" alt="{{ $product->getTranslation('name', app()->getLocale()) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-6xl"></i>
                        </div>
                    @endif
                </div>

                {{-- الصور المصغرة (Thumbnails) --}}
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($product->images as $index => $image)
                            <button onclick="changeMainImage('{{ $image->image_url }}')" class="thumbnail-btn aspect-square rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-blue-600' : 'border-transparent hover:border-gray-300' }} transition-all">
                                <img src="{{ $image->image_url }}" alt="صورة {{ $index + 1 }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ═══════════════════════════════════════════ --}}
            {{-- تفاصيل المنتج --}}
            {{-- ═══════════════════════════════════════════ --}}
            <div class="space-y-6">
                <div>
                    @if($product->brand)
                        <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-sm font-semibold rounded-full mb-3">
                        {{ $product->brand->getTranslation('name', app()->getLocale()) }}
                    </span>
                    @endif
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ $product->getTranslation('name', app()->getLocale()) }}
                    </h1>
                    @if($product->price)
                        <div class="flex items-baseline gap-3">
                            <span class="text-4xl font-bold text-green-600">{{ number_format($product->price, 2) }}</span>
                            <span class="text-xl text-gray-500">ر.س</span>
                        </div>
                    @endif
                </div>

                @if($product->getTranslation('description', app()->getLocale()))
                    <div class="prose prose-lg max-w-none">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">الوصف</h3>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-wrap">
                            {{ $product->getTranslation('description', app()->getLocale()) }}
                        </p>
                    </div>
                @endif

                {{-- معلومات إضافية --}}
                <div class="bg-gray-50 rounded-xl p-6 space-y-3">
                    @if($product->category)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-tag text-blue-500"></i>
                            <span class="font-semibold text-gray-700">التصنيف:</span>
                            <span class="text-gray-600">{{ $product->category->getTranslation('name', app()->getLocale()) }}</span>
                        </div>
                    @endif
                    @if($product->brand)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-award text-purple-500"></i>
                            <span class="font-semibold text-gray-700">الماركة:</span>
                            <span class="text-gray-600">{{ $product->brand->getTranslation('name', app()->getLocale()) }}</span>
                        </div>
                    @endif
                </div>

                {{-- أزرار الإجراء --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp') ?? '' }}?text=مرحباً، أريد الاستفسار عن المنتج: {{ urlencode($product->getTranslation('name', app()->getLocale())) }}" target="_blank" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-4 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span>اطلب عبر الواتساب</span>
                    </a>
                    <a href="{{ route('frontend.contact') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-4 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <span>تواصل معنا</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function changeMainImage(imageUrl) {
                document.getElementById('main-product-image').src = imageUrl;

                // تحديث حدود الصور المصغرة
                document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                    btn.classList.remove('border-blue-600');
                    btn.classList.add('border-transparent');
                });
                event.currentTarget.classList.remove('border-transparent');
                event.currentTarget.classList.add('border-blue-600');
            }
        </script>
    @endpush
@endsection
