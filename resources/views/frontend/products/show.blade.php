@extends('frontend.layouts.app')

@section('title', $product->getTranslation('name', app()->getLocale()) . ' - ' . config('app.name'))

@section('content')
    <div class="product-details-page" style="padding: 4rem 0; background: var(--cream);">
        <div class="section-container">

            {{-- Breadcrumb --}}
            <nav class="breadcrumb-new" data-aos="fade-up" style="margin-bottom: 2rem;">
                <a href="{{ route('home') }}">{{ __('messages.home') }}</a>
                <i class="fas fa-chevron-left"></i>
                @if($product->category)
                    <a href="">
                        {{ $product->category->getTranslation('name', app()->getLocale()) }}
                    </a>
                    <i class="fas fa-chevron-left"></i>
                @endif
                <span class="current">{{ $product->getTranslation('name', app()->getLocale()) }}</span>
            </nav>

            <div class="product-details-grid" data-aos="fade-up">

                <div class="product-gallery">
                    <div class="main-image-container">
                        <img id="mainProductImage"
                             src="{{ $product->main_image ?: asset('frontend/img/product-placeholder.png') }}"
                             alt="{{ $product->getTranslation('name', app()->getLocale()) }}">
                    </div>

                    @if($product->images->count() > 1)
                        <div class="thumbnail-grid">
                            @foreach($product->images as $index => $image)
                                <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}"
                                     onclick="changeMainImage('{{ asset('storage/' . $image->image) }}', this)">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- العمود الأيسر: تفاصيل المنتج --}}
                <div class="product-info-panel">
                    @if($product->partner)
                        <span class="brand-badge">
                        <i class="fas fa-award"></i> {{ $product->partner->getTranslation('name', app()->getLocale()) }}
                    </span>
                    @endif

                    <h3 class="product-main-title">
                        {{ $product->getTranslation('name', app()->getLocale()) }}
                    </h3>

                    @if($product->price)
                        <div class="product-price-tag">
                            {{ number_format($product->price, 2) }} <span>{{ __('messages.currency') }}</span>
                        </div>
                    @endif

                    <div class="product-meta-info">
                        @if($product->category)
                            <div class="meta-item">
                                <i class="fas fa-folder"></i>
                                <span>{{ $product->category->getTranslation('name', app()->getLocale()) }}</span>
                            </div>
                        @endif
                    </div>

                    @if($product->getTranslation('description', app()->getLocale()))
                        <div class="product-description-box">
                            <h4>{{ __('messages.description') }}</h4>
                            <p style="white-space: pre-line;">{{ $product->getTranslation('description', app()->getLocale()) }}</p>
                        </div>
                    @endif

                    <div class="product-actions">
                        @php
                            $productName = $product->getTranslation('name', app()->getLocale());
                            $whatsappMsg = urlencode("مرحباً، أود الاستفسار عن المنتج: " . $productName);
                            // استبدل الرقم أدناه برقم الواتساب الخاص بالموقع من الإعدادات
                            $whatsappNumber = \App\Models\Setting::get('mobile', '');
                            $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                        @endphp


                        <div class="">
                            <a href="https://wa.me/{{ $cleanNumber }}?text={{ $whatsappMsg }}"
                               class="btn-hero-outline btn-whatsapp-action" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                {{ __('messages.inquire_via_whatsapp') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($similarProducts->count() > 0)
                <div class="similar-products-section" style="margin-top: 5rem;" data-aos="fade-up">
                    <div class="section-header-new" style="text-align: center; margin-bottom: 3rem;">
                        <h5 class="section-heading">{{ __('messages.similar_products') }}</h5>
                    </div>

                    <div class="products-showcase" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem;">
                        @foreach($similarProducts as $similar)
                            <a href="{{ route('frontend.products.show', $similar->id) }}" class="product-showcase-card">
                                <div class="product-showcase-image">
                                    <img src="{{ $similar->main_image ?: asset('frontend/img/product-placeholder.png') }}"
                                         alt="{{ $similar->getTranslation('name', app()->getLocale()) }}" loading="lazy">
                                </div>
                                <div class="product-showcase-info">
                                    <h3 class="product-name">{{ $similar->getTranslation('name', app()->getLocale()) }}</h3>
                                    @if($similar->price)
                                        <span class="product-price">{{ number_format($similar->price, 2) }} {{ __('messages.currency') }}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        .section-heading {
            font-size: 2rem;
        }
        .product-name {
            color: var(--brown);
            font-size: 1rem;
            font-weight: bold;
        }
        .navbar-premium {
            background: var(--brown);
        }
        .product-details-page{padding: 9rem 0 4rem !important;}
        /* تنسيقات صفحة التفاصيل */
        .breadcrumb-new {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            color: var(--gray-500);
        }
        .product-price{color: black}
        .product-showcase-info {padding:10px 10px 0 0px !important;}
        .breadcrumb-new a {font-weight: bold; color: var(--brown); text-decoration: none; transition: color 0.3s; }
        .breadcrumb-new a:hover { color: var(--gold); }
        .breadcrumb-new .current { color: var(--dark); font-weight: 600; }
        .breadcrumb-new i { font-size: 0.7rem; }

        .product-details-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        @media (min-width: 992px) {
            .product-details-grid { grid-template-columns: 1fr 1fr; }
        }

        /* معرض الصور */
        .main-image-container {
            background: none;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 1rem;
        }
        .main-image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 1rem;
        }
        .thumbnail-item {
            border: 2px solid transparent;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s;
            aspect-ratio: 1 / 1;
        }
        .thumbnail-item.active, .thumbnail-item:hover {
            border-color: var(--gold);
        }
        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* لوحة المعلومات */
        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--cream-dark);
            color: var(--brown);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .product-main-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.3;
            margin-bottom: 1rem;
        }
        .product-price-tag {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--gold-dark);
            margin-bottom: 1.5rem;
        }
        .product-price-tag span {
            font-size: 1rem;
            color: var(--gray-500);
            font-weight: 500;
        }
        .product-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--cream-dark);
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-500);
            font-weight: 500;
        }
        .meta-item i { color: var(--gold); }

        .product-description-box {
            margin-bottom: 2.5rem;
        }
        .product-description-box h4 {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }
        .product-description-box p {
            color: var(--gray-500);
            line-height: 1.8;
        }

        /* أزرار الإجراءات */
        .product-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        @media (min-width: 576px) {
            .product-actions { flex-direction: row; }
        }
        .btn-whatsapp-action {
            flex: 1;
            justify-content: center;
            background: #25D366;
            color: white;
        }

        .btn-secondary-action {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border: 2px solid var(--brown);
            color: var(--brown);
            font-weight: 700;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-secondary-action:hover {
            background: var(--brown);
            color: var(--white);
        }

        /* Infinite Scroll Sentinel */
        .scroll-sentinel { height: 1px; width: 100%; }
    </style>

    <script>
        function changeMainImage(src, element) {
            document.getElementById('mainProductImage').src = src;
            document.querySelectorAll('.thumbnail-item').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
        }
    </script>
@endsection
