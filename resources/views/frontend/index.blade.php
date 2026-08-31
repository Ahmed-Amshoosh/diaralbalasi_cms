@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .testimonials-swiper {
            width: 100%;
            overflow: hidden;
            padding: 10px 5px 50px;
        }
        .testimonials-swiper .swiper-wrapper {
            align-items: stretch;
        }
        .testimonials-swiper .swiper-slide {
            height: auto;
            display: flex;
        }
        .testimonial-card {
            width: 100%;
            height: 100%;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
        }
        .testimonial-quote-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gold);
            color: #fff;
            margin-bottom: 20px;
        }
        .testimonial-text {
            flex: 1;
            margin: 0 0 25px;
            line-height: 1.9;
            color: #555;
        }
        .testimonial-author {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-top: auto;
        }
        .author-name {
            margin: 0 0 5px;
            font-size: 18px;
            font-weight: 700;
            color: #222;
        }
        .author-role {
            display: block;
            font-size: 14px;
            color: #888;
        }
        .author-rating {
            display: flex;
            gap: 3px;
            direction: ltr;
        }
        .author-rating i {
            color: #ddd;
            font-size: 14px;
        }
        .author-rating i.active {
            color: var(--gold);
        }
        .testimonials-swiper .swiper-pagination {
            bottom: 5px;
        }
        .testimonials-swiper
        .swiper-pagination-bullet-active {
            background: var(--gold);
        }
    </style>
    <style>
        .premium-cta-section {
            position: relative;
            padding: 6rem 1rem;
            background: var(--cream);
            overflow: hidden;
        }
        .premium-cta-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            align-items: center;
        }
        @media (min-width: 992px) {
            .premium-cta-grid {
                grid-template-columns: 1fr 1fr;
                gap: 5rem;
            }
        }
        .premium-cta-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .cta-split-heading .accent {
            color: var(--gold);
            position: relative;
            display: inline-block;
        }
        .cta-split-heading .accent::after {
            content: '';
            position: absolute;
            bottom: 5px;
            right: 0;
            width: 100%;
            height: 8px;
            background: rgba(238, 182, 23, 0.2);
            border-radius: 4px;
            z-index: -1;
        }
        .quick-contact-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }
        .qc-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.1rem;
            color: var(--dark);
            font-weight: 600;
        }
        .qc-item i {
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            box-shadow: var(--shadow-sm);
        }
        .btn-hero-outline:hover {
            background: var(--gold);
            color: var(--white);
            box-shadow: var(--shadow-gold);
            transform: translateY(-2px);
        }
        .testimonials-section{    padding-top: 30px;}
        .premium-form-wrapper {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            border-top: 4px solid var(--gold);
            position: relative;
        }
        .form-title-bar {
            margin-bottom: 2rem;
            position: relative;
        }
        .form-title-bar h4 {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }
        .title-bar-accent {
            width: 60px;
            height: 3px;
            background: var(--gradient-gold);
            margin-top: 0.75rem;
            border-radius: 2px;
        }
        .form-row-new {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 768px) {
            .form-row-new { grid-template-columns: 1fr 1fr; }
        }
        .form-group-new {
            position: relative;
        }
        .form-group-new input,
        .form-group-new textarea,
        .form-group-new select {
            width: 100%;
            padding: 1rem 1rem 0.5rem;
            border: 1px solid var(--cream-dark);
            border-radius: 8px;
            background: var(--cream);
            font-family: 'Cairo', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            transition: all 0.3s ease;
            outline: none;
        }
        .form-group-new textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-group-new label {
            position: absolute;
            right: 1rem;
            top: 1rem;
            font-size: 0.95rem;
            color: var(--gray-500);
            pointer-events: none;
            transition: all 0.2s ease;
            background: transparent;
            padding: 0 0.25rem;
        }
        .form-group-new .req {
            color: var(--brown);
        }
        .form-group-new input:focus,
        .form-group-new textarea:focus,
        .form-group-new select:focus,
        .form-group-new input:not(:placeholder-shown),
        .form-group-new textarea:not(:placeholder-shown),
        .form-group-new select:valid {
            border-color: var(--gold);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(238, 182, 23, 0.1);
        }
        .form-group-new input:focus ~ label,
        .form-group-new textarea:focus ~ label,
        .form-group-new select:focus ~ label,
        .form-group-new input:not(:placeholder-shown) ~ label,
        .form-group-new textarea:not(:placeholder-shown) ~ label,
        .form-group-new select:valid ~ label {
            top: -0.6rem;
            right: 0.8rem;
            font-size: 0.75rem;
            color: var(--gold-dark);
            background: var(--white);
            font-weight: 600;
        }
        .select-wrapper-new {
            position: relative;
        }
        .select-wrapper-new select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23707070'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 1rem center;
            background-size: 1rem;
            cursor: pointer;
        }
        .error-msg {
            display: block;
            font-size: 0.75rem;
            color: var(--brown);
            margin-top: 0.3rem;
            min-height: 1rem;
            opacity: 0;
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .form-group-new.has-error input,
        .form-group-new.has-error textarea,
        .form-group-new.has-error select {
            border-color: var(--brown);
            background: #FFF5F5;
        }
        .form-group-new.has-error .error-msg {
            opacity: 1;
            transform: translateY(0);
        }
        .btn-premium-submit {
            width: 100%;
            padding: 1rem;
            background: var(--gradient-brand);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        .btn-premium-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(44, 0, 0, 0.3);
        }
        .btn-premium-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        .btn-loader { display: none; }
        .btn-premium-submit.loading .btn-text,
        .btn-premium-submit.loading .btn-icon { display: none; }
        .btn-premium-submit.loading .btn-loader { display: inline-block; }
        @media (max-width: 768px) {
            .premium-cta-section { padding: 4rem 1rem; }
            .premium-form-wrapper { padding: 1.5rem; }
            .section-heading { font-size: 2rem !important; }
        }
    </style>
    <!-- NEW HERO SECTION WITH BACKGROUND IMAGE -->
    <section class="hero-new" id="home">
        <div class="hero-bg">
            <img src="{{ asset('storage/' . $hero->bg_image) }}"
                 alt="{{ $hero->getTranslation('title', app()->getLocale()) }}" class="hero-bg-image">
        </div>
        <div class="hero-content">
            <div class="hero-badge-new">
                <i class="fas fa-award"></i>
                <span>
                    {{ $hero->getTranslation('sub_title', app()->getLocale()) }}
                </span>
            </div>
            <h1 class="hero-title-new">
                {{ $hero->getTranslation('title', app()->getLocale()) }}
            </h1>
            <p class="hero-desc-new">
                {{ $hero->getTranslation('description', app()->getLocale()) }}
            </p>
        </div>
        <div class="hero-stats-floating">
            @foreach($heroStats as $stat)
                <div class="hero-stat-float">
                    <span class="number" data-target="{{ $stat->number }}">0</span>
                    <span class="label">
                        {{ $stat->getTranslation('label', app()->getLocale()) }}
                    </span>
                </div>
            @endforeach
        </div>
        <div class="hero-scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <div class="marquee-strip">
        <div class="marquee-track">
            @foreach($marqueeItems as $marquee)
                <div class="marquee-item">
                    {{ $marquee->getTranslation('text', app()->getLocale()) }}
                    <span class="star">✦</span>
                </div>
            @endforeach
            @foreach($marqueeItems as $marquee)
                <div class="marquee-item">
                    {{ $marquee->getTranslation('text', app()->getLocale()) }}
                    <span class="star">✦</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- BENTO GRID SECTION (Moved from Hero) -->
    <section class="bento-grid-section" id="categories">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label">
                        {{ $categorySection->label}}
                    </div>
                    <h2 class="section-heading">
                        {!! sectionHeading($categorySection->heading ) !!}
                    </h2>
                </div>
                <p class="section-desc">
                    {{ $categorySection->description }}
                </p>
            </div>
            <div class="bento-grid">
                @foreach($categories as $index => $category)
                    <div
                        class="bento-item {{ count($categories) === 3 && $index === 0 ? 'large' : '' }}"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ $category->image_url }}"
                            alt="{{ $category->getTranslation('name', app()->getLocale()) }}">
                        <div class="bento-arrow">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="bento-content">
                            @if($category->icon)
                                <div class="bento-icon">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                            @endif
                            <h3 class="bento-title">
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="section-container">
            <div class="about-grid">
                <div class="about-visual" data-aos="fade-left">
                    <div class="about-img-main">
                        <img src="{{ Storage::url($about->main_image) }}" alt="{{$about->heading}}">
                    </div>
                    <div class="about-img-secondary">
                        <img src="{{ Storage::url($about->secondary_image) }}" alt="{{$about->heading}}">
                    </div>
                    <div class="about-experience-badge">
                        <div class="number">{{$about->experience_number}}</div>
                        <div class="text">{{$about->experience_text}}</div>
                    </div>
                </div>
                <div class="about-content" data-aos="fade-right">
                    <div class="section-label">{{$about->label}}</div>
                    <h2 class="section-heading">
                        {!! sectionHeading($about->heading ) !!}
                    </h2>
                    <p style="color: var(--gray-500); margin-top: 25px; line-height: 1.9; font-size: 1.05rem;">{{$about->description}}</p>
                    <div class="about-features">
                        @if(!empty($about?->features))
                            @foreach($about->features as $feature)
                                <div class="about-feature">
                                    <div class="about-feature-icon">
                                        <i class="{{ $feature['icon'] ?? 'fas fa-check' }}"></i>
                                    </div>
                                    <div>
                                        <div class="about-feature-title">
                                            {{ $feature['title_' . app()->getLocale()] ?? $feature['title_ar'] ?? '' }}
                                        </div>
                                        <div class="about-feature-desc">
                                            {{ $feature['desc_' . app()->getLocale()] ?? $feature['desc_ar'] ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label">
                        {{ $productSection->label }}
                    </div>
                    <h2 class="section-heading">
                        {!! sectionHeading($productSection->heading) !!}
                    </h2>
                </div>
                <p class="section-desc">
                    {{ $productSection->description }}
                </p>
            </div>
            <div
                class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4"
                data-aos="fade-up">
                <div class="filter-tabs-new">
                    <button
                        class="filter-tab-new active"
                        data-filter="all">
                        {{ __('messages.all') }}
                    </button>
                    @foreach($categories as $category)
                        <button
                            class="filter-tab-new"
                            data-filter="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="products-showcase" id="productsShowcase">
                <div class="text-center py-5">
                    <div class="spinner"></div>
                    <p>{{ __('messages.loading_products') }}</p>
                </div>
            </div>
            <div class="text-center mt-60" data-aos="fade-up">
                <a href="{{route('frontend.products.index')}}"
                   class="btn-hero-outline">
                    {{ __('messages.view_all_products') }}
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="whyus-section" id="whyus">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label" style="color: var(--gold);">{{$whyUsSectionSection->label ?? ''}}</div>
                    <h2 class="section-heading">
                        {!! sectionHeading($whyUsSectionSection->heading ) !!}
                    </h2>
                </div>
                <p class="section-desc">{{$whyUsSectionSection->description ?? ''}}</p>
            </div>
            <div class="whyus-grid">
                @foreach($whyUsItems as $whyUsItem)
                    <div class="whyus-card" data-aos="fade-up" data-aos-delay="0">
                        <div class="whyus-number">{{ $loop->iteration}}</div>
                        <div class="whyus-icon">
                            <i class="{{$whyUsItem->icon}}"></i>
                        </div>
                        <h3 class="whyus-title">{{$whyUsItem->title}}</h3>
                        <p class="whyus-desc">{{$whyUsItem->description}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label" style="color: var(--gold);">{{$testimonialsSection->label}}</div>
                    <h2 class="section-heading">
                        {!! sectionHeading($testimonialsSection->heading ) !!}
                    </h2>
                </div>
                <p class="section-desc">{{$testimonialsSection->description}}</p>
            </div>
            <!-- Swiper -->
            <div class="swiper testimonials-swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper" style="padding-bottom: 35px">
                    @forelse($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-quote-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                                <p class="testimonial-text">
                                    {{ $testimonial->getTranslation('content', app()->getLocale()) }}
                                </p>
                                <div class="testimonial-author">
                                    <div class="author-info">
                                        <h3 class="author-name">
                                            {{ $testimonial->getTranslation('name', app()->getLocale()) }}
                                        </h3>
                                        <span class="author-role">
                                            {{ $testimonial->getTranslation('role', app()->getLocale()) }}
                                        </span>
                                    </div>
                                    <div class="author-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'active' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="testimonial-card text-center">
                                <p class="testimonial-text">
                                    {{ app()->getLocale() === 'ar'
                                        ? 'لا توجد آراء مضافة حالياً.'
                                        : 'No testimonials available at the moment.'
                                    }}
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="partners-section" data-aos="fade-up">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label" style="color: var(--gold);">{{$partnersSection->label}}</div>
                    <h2 class="section-heading">
                        {!! sectionHeading($partnersSection->heading) !!}
                    </h2>
                </div>
                <p class="section-desc">{{$partnersSection->description}}</p>
            </div>
            <!-- Swiper -->
            <div class="swiper brands-swiper">
                <div class="swiper-wrapper">
                    @foreach($partners as $partner)
                        <div class="swiper-slide">
                            <div class="brand-logo-box">
                                <img src="{{ Storage::url($partner->logo) }}" alt="{{$partner->name}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="contact" data-aos="fade-up">
        <div class="cta-image">
            <img src="{{ Storage::url($cta->image) }}" alt="{{$cta->heading}}">
        </div>
        <div class="cta-content">
            @php
                [$firstLine, $secondLine] = array_pad(explode('|', $cta->heading, 2),2,'');
            @endphp
            <h2 class="cta-heading">
                {{ $firstLine }}<br>
                <span class="accent">{{ $secondLine }}</span>
            </h2>
            <p class="cta-desc">{{$cta->description}}</p>
            <div class="cta-buttons">
                <a href="https://wa.me/{{$cta->mobile}}" class="btn-hero-outline" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    {{$cta->button_text}}
                </a>
            </div>
        </div>
    </section>

    @if($contact || $cta)
        <section class="premium-cta-section" id="contact">
            <div class="section-container">
                <div class="premium-cta-grid">
                    <div class="premium-cta-content" data-aos="fade-right">
                        <div class="section-header-new" style="text-align: right; margin-bottom: 2rem;">
                            @if(isset($contact))
                                <div class="section-label" style="color: var(--gold);">
                                    {{ $contact->label }}
                                </div>
                                <h2 class="section-heading">
                                    {!! sectionHeading($contact->heading) !!}
                                </h2>
                                <p class="section-desc" style="margin: 0; max-width: 100%;">
                                    {{ $contact->description }}
                                </p>
                            @elseif(isset($cta))
                                @php
                                    [$firstLine, $secondLine] = array_pad(explode('|', $cta->heading, 2), 2, '');
                                @endphp
                                <h2 class="section-heading cta-split-heading">
                                    {{ $firstLine }}<br>
                                    <span class="accent">{{ $secondLine }}</span>
                                </h2>
                                <p class="section-desc" style="margin: 0; max-width: 100%;">
                                    {{ $cta->description }}
                                </p>
                            @endif
                        </div>
                        <div class="quick-contact-info">
                            @if(isset($contact) && !empty($contact->phones))
                                <div class="qc-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span dir="ltr">{{ $contact->phones[0] }}</span>
                                </div>
                            @endif
                            @if(isset($contact) && !empty($contact->emails))
                                <div class="qc-item">
                                    <i class="fas fa-envelope"></i>
                                    <span dir="ltr">{{ $contact->emails[0] }}</span>
                                </div>
                            @endif
                        </div>
                        @if(isset($cta) && $cta->mobile)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cta->mobile) }}"
                               class="btn-hero-outline"
                               target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                {{ $cta->button_text ?? __('messages.contact_via_whatsapp') }}
                            </a>
                        @endif
                    </div>
                    <div class="premium-form-wrapper" data-aos="fade-left" data-aos-delay="100">
                        <form id="contactForm" action="{{ route('frontend.contact.submit') }}" method="POST">
                            @csrf

                            <div class="form-title-bar">
                                <h3>{{ __('messages.contact_form_title') }}</h3>
                                <div class="title-bar-accent"></div>
                            </div>

                            <div class="form-row-new">
                                <div class="form-group-new">
                                    <input
                                        type="text"
                                        id="contact-name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        required
                                        placeholder=" "
                                    >
                                    <label for="contact-name">
                                        {{ __('messages.full_name') }} <span class="req">*</span>
                                    </label>
                                    <span class="error-msg"></span>
                                </div>

                                <div class="form-group-new">
                                    <input
                                        type="tel"
                                        id="contact-phone"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        required
                                        dir="ltr"
                                        placeholder=" "
                                    >
                                    <label for="contact-phone">
                                        {{ __('messages.phone_number') }} <span class="req">*</span>
                                    </label>
                                    <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="form-row-new">
                                <div class="form-group-new">
                                    <input
                                        type="email"
                                        id="contact-email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        dir="ltr"
                                        placeholder=" "
                                    >
                                    <label for="contact-email">
                                        {{ __('messages.email') }}
                                    </label>
                                    <span class="error-msg"></span>
                                </div>

                                <div class="form-group-new">
                                    <div class="select-wrapper-new">
                                        <select id="contact-subject" name="subject" required>
                                            <option value="" disabled selected></option>

                                            <option value="quote_request"
                                                {{ old('subject') === 'quote_request' ? 'selected' : '' }}>
                                                {{ __('messages.quote_request') }}
                                            </option>

                                            <option value="technical_support"
                                                {{ old('subject') === 'technical_support' ? 'selected' : '' }}>
                                                {{ __('messages.technical_support') }}
                                            </option>

                                            <option value="business_partnership"
                                                {{ old('subject') === 'business_partnership' ? 'selected' : '' }}>
                                                {{ __('messages.business_partnership') }}
                                            </option>

                                            <option value="general_inquiry"
                                                {{ old('subject') === 'general_inquiry' ? 'selected' : '' }}>
                                                {{ __('messages.general_inquiry') }}
                                            </option>
                                        </select>

                                        <label for="contact-subject">
                                            {{ __('messages.subject') }} <span class="req">*</span>
                                        </label>
                                    </div>

                                    <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="form-group-new full-width-new">
            <textarea
                id="contact-message"
                name="message"
                rows="4"
                required
                placeholder=" "
            ></textarea>

                                <label for="contact-message">
                                    {{ __('messages.message_details') }} <span class="req">*</span>
                                </label>

                                <span class="error-msg"></span>
                            </div>

                            <button type="submit" id="submitBtn" class="btn-premium-submit">
                                <span class="btn-text">{{ __('messages.send_request') }}</span>
                                <i class="fas fa-paper-plane btn-icon"></i>
                                <i class="fas fa-spinner fa-spin btn-loader"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showcase = document.getElementById('productsShowcase');
            const filterTabs = document.querySelectorAll('.filter-tab-new');
            if (!showcase) return;
            const PRODUCTS_URL = @json(route('frontend.products.ajax'));
            let currentCategory = 'all';
            let currentPage = 1;
            let nextPageUrl = null;
            let isLoading = false;
            const sentinel = document.createElement('div');
            sentinel.className = 'scroll-sentinel';
            sentinel.style.height = '20px';
            showcase.appendChild(sentinel);
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && nextPageUrl && !isLoading) {
                    fetchProducts(currentCategory, currentPage + 1, true);
                }
            }, { rootMargin: '300px' });
            observer.observe(sentinel);
            async function fetchProducts(category = 'all', page = 1, append = false) {
                if (isLoading) return;
                isLoading = true;
                if (!append) {
                    showcase.innerHTML = `
                <div class="text-center py-5" style="grid-column: 1/-1;">
                    <div class="spinner"></div>
                    <p>{{ __('messages.loading_products') }}</p>
                </div>`;
                    currentPage = 1;
                    nextPageUrl = null;
                } else {
                    const loader = document.createElement('div');
                    loader.className = 'text-center py-3 infinite-loader';
                    loader.innerHTML = '<div class="spinner"></div>';
                    showcase.appendChild(loader);
                }
                try {
                    const url = new URL(PRODUCTS_URL, window.location.origin);
                    url.searchParams.set('category', category);
                    url.searchParams.set('page', page);
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    if (!response.ok) throw new Error('Failed to load products');
                    const result = await response.json();
                    if (!result.success) throw new Error(result.message);
                    if (!append) showcase.innerHTML = ''; // مسح التحميل الأولي
                    const existingLoader = showcase.querySelector('.infinite-loader');
                    if (existingLoader) existingLoader.remove();
                    displayProducts(result.data, append);
                    nextPageUrl = result.next_page_url;
                    currentPage = result.current_page;
                } catch (error) {
                    console.error('Products Error:', error);
                    if (!append) {
                        showcase.innerHTML = `
                    <div class="text-center py-5" style="grid-column: 1/-1;">
                        <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: #dc3545; margin-bottom: 15px;"></i>
                        <h4 style="color: var(--brown);">{{ __('messages.products_load_error') }}</h4>
                    </div>`;
                    }
                } finally {
                    isLoading = false;
                }
            }

            function displayProducts(products, append) {
                if (!products || products.length === 0) {
                    if (!append) {
                        showcase.innerHTML = `
                    <div class="text-center py-5" style="grid-column: 1/-1;">
                        <i class="fas fa-box-open" style="font-size: 3rem; color: var(--gold); margin-bottom: 15px;"></i>
                        <p style="color: var(--gray-500);">{{ __('messages.no_products') }}</p>
                    </div>`;
                    } else {
                        sentinel.style.display = 'none';
                    }
                    return;
                }

                const fragment = document.createDocumentFragment();
                const whatsappBase = "https://wa.me/";
                products.forEach(function (product, index) {
                    const div = document.createElement('div');
                    div.className = 'product-showcase-card fade-in-up';
                    div.style.animationDelay = `${index * 0.08}s`;
                    const whatsappMessage = encodeURIComponent(`{{ __('messages.whatsapp_product_message') }}: ${product.name}`);

                    div.innerHTML = `
                <a href="${product.url}" class="product-card-link">
                    <div class="product-showcase-image">
                        <img src="${product.image}" alt="${escapeHtml(product.name)}" loading="lazy"
                             onerror="this.src='{{ asset('frontend/img/product-placeholder.png') }}'">
                        <div class="product-overlay">
                </div>
            </div>
            <div class="product-showcase-info">
                <h3 class="product-name">${escapeHtml(product.name)}</h3>
                        ${product.price ? `<span class="product-price">${product.price}</span>` : ''}
                    </div>
                </a>
            `;
                    fragment.appendChild(div);
                });
                showcase.appendChild(fragment);
                if (typeof AOS !== 'undefined') {
                    setTimeout(() => AOS.refresh(), 100);
                }
            }
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
            filterTabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    filterTabs.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.getAttribute('data-filter');
                    sentinel.style.display = 'block';
                    fetchProducts(currentCategory, 1, false);
                });
            });

            fetchProducts('all', 1, false);
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            if (!form || !submitBtn) return;
            if (typeof toastr === 'undefined') {
                console.error('Toastr لم يتم تحميله');
                return;
            }
            const translations = {
                success: @json(__('messages.success')),
                validationError: @json(__('messages.validation_error')),
                error: @json(__('messages.error')),
                defaultSuccess: @json(__('messages.contact_success')),
                defaultError: @json(__('messages.unexpected_error'))
            };
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                clearErrors();
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                const formData = new FormData(form);
                const csrfToken = form.querySelector('input[name="_token"]')?.value;
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(async response => {
                        const data = await response.json();
                        if (response.status === 422) {
                            throw {
                                status: 422,
                                errors: data.errors || {}
                            };
                        }
                        if (!response.ok) {
                            throw {
                                status: response.status,
                                message: data.message || translations.defaultError
                            };
                        }
                        return data;
                    })
                    .then(data => {
                        toastr.success(
                            data.message || translations.defaultSuccess,
                            translations.success,
                            {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 5000,
                                extendedTimeOut: 1000,
                                positionClass: 'toast-top-left'
                            }
                        );
                        form.reset();
                    })
                    .catch(error => {
                        if (error.status === 422) {
                            displayErrors(error.errors);
                            Object.values(error.errors).forEach(messages => {
                                messages.forEach(message => {
                                    toastr.error(message,
                                        translations.validationError,
                                        {
                                            closeButton: true,
                                            progressBar: true,
                                            timeOut: 5000,
                                            extendedTimeOut: 1000,
                                            positionClass: 'toast-top-left'
                                        }
                                    );
                                });
                            });
                        } else {
                            toastr.error(
                                error.message || translations.defaultError,
                                translations.error,
                                {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 5000,
                                    extendedTimeOut: 1000,
                                    positionClass: 'toast-top-left'
                                }
                            );
                        }
                    })
                    .finally(() => {
                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;
                    });
            });
            function displayErrors(errors) {
                for (const field in errors) {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (!input) continue;
                    const formGroup = input.closest('.form-group-new');
                    if (!formGroup) continue;
                    formGroup.classList.add('has-error');
                    const errorSpan = formGroup.querySelector('.error-msg');
                    if (errorSpan) {
                        errorSpan.textContent = errors[field][0];
                    }
                }
            }
            function clearErrors() {
                document.querySelectorAll('.form-group-new.has-error')
                    .forEach(el => el.classList.remove('has-error'));
                document.querySelectorAll('.error-msg')
                    .forEach(el => el.textContent = '');
                toastr.clear();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function initSmartSwiper(selector, config) {
                const slides = document.querySelectorAll(`${selector} .swiper-slide`);
                const totalSlides = slides.length;
                let maxPerView = config.slidesPerView || 1;
                if (config.breakpoints) {
                    Object.values(config.breakpoints).forEach(bp => {
                        if (bp.slidesPerView > maxPerView) {
                            maxPerView = bp.slidesPerView;
                        }
                    });
                }
                const shouldLoop = totalSlides > maxPerView;
                new Swiper(selector, {
                    ...config,
                    loop: shouldLoop,
                    autoplay: (shouldLoop && config.autoplay) ? config.autoplay : false,
                });
            }
            initSmartSwiper('.testimonials-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.testimonials-swiper .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 25 },
                },
            });
            initSmartSwiper('.brands-swiper', {
                slidesPerView: 2,
                spaceBetween: 30,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    768: { slidesPerView: 3, spaceBetween: 40 },
                    1024: { slidesPerView: 5, spaceBetween: 50 },
                },
            });
        });
    </script>
@endsection
