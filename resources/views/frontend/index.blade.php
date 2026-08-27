@extends('frontend.layouts.app')


@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Bootstrap 5 RTL (نسخة مضمونة عبر CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <!-- NEW HERO SECTION WITH BACKGROUND IMAGE -->
    <section class="hero-new" id="home">
        <div class="hero-bg">
            <img src="{{ asset('storage/' . $hero->bg_image) }}"
                 alt="{{ $hero->getTranslation('title', app()->getLocale()) }}"
                 class="hero-bg-image">
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
                        data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}">
                        <img
                            src="{{ $category->image_url }}"
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
                        <img
                            src="{{$about->main_image}}"
                            alt="{{$about->heading}}">
                    </div>
                    <div class="about-img-secondary">
                        <img src="{{$about->secondary_image}}"
                             alt="{{$about->heading}}">
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
                    <div class="section-label">منتجاتنا</div>
                    <h2 class="section-heading">
                        منتجات <span class="accent">مختارة بعناية</span>
                    </h2>
                </div>
                <p class="section-desc">
                    تصفح مجموعة متنوعة من المنتجات عالية الجودة المناسبة للمنازل والمشاريع التجارية والإنشائية
                </p>
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4" data-aos="fade-up">
                <div class="filter-tabs-new">
                    <button class="filter-tab-new active" data-filter="all">الكل</button>
                    <button class="filter-tab-new" data-filter="sanitary">الصحية</button>
                    <button class="filter-tab-new" data-filter="plumbing">السباكة</button>
                    <button class="filter-tab-new" data-filter="building">البناء</button>
                </div>
            </div>

            <div class="products-showcase" id="productsShowcase">
                <!-- Products will be loaded here -->
            </div>

            <div class="text-center mt-60" data-aos="fade-up">
                <a href="products.html" class="btn-hero-outline">
                    عرض جميع المنتجات
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
                <div class="swiper-wrapper">

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
                                        <h4 class="author-name">
                                            {{ $testimonial->getTranslation('name', app()->getLocale()) }}
                                        </h4>

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
                                <img src="{{$partner->logo}}" alt="{{$partner->name}}">
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
            <img src="{{$cta->image}}"
                 alt="{{$cta->heading}}">
        </div>
        <div class="cta-content">
            @php
                [$firstLine, $secondLine] = array_pad(
                    explode('|', $cta->heading, 2),
                    2,
                    ''
                );
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
<style>
    /* --- متغيرات الألوان والخطوط --- */
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --accent-color: #f59e0b;
        --text-dark: #1e293b;
        --text-gray: #64748b;
        --bg-light: #f8fafc;
        --white: #ffffff;
        --error: #ef4444;
        --success: #10b981;
        --radius: 16px;
        --shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 20px 50px -12px rgba(37, 99, 235, 0.15);
    }

    /* --- الإعدادات العامة للقسم --- */
    .contact-section {
        position: relative;
        padding: 5rem 1rem;
        background: var(--bg-light);
        font-family: 'Cairo', sans-serif;
        overflow: hidden;
        direction: rtl;
    }

    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* --- الخلفية الزخرفية --- */
    .contact-bg-shapes .shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.15;
        z-index: 1;
        animation: floatBlob 8s ease-in-out infinite;
    }
    .shape-1 { width: 400px; height: 400px; background: var(--primary-color); top: -100px; left: -100px; }
    .shape-2 { width: 350px; height: 350px; background: var(--accent-color); bottom: -50px; right: -50px; animation-delay: 2s; }

    @keyframes floatBlob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -30px) scale(1.05); }
    }

    /* --- عنوان القسم --- */
    .section-header { text-align: center; margin-bottom: 3.5rem; }
    .section-badge {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: linear-gradient(135deg, var(--accent-color), #d97706);
        color: var(--white);
        font-size: 0.9rem;
        font-weight: 700;
        border-radius: 50px;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    .section-desc {
        font-size: 1.1rem;
        color: var(--text-gray);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* --- شبكة العرض (Grid) --- */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.5rem;
    }
    @media (min-width: 1024px) {
        .contact-grid { grid-template-columns: 5fr 7fr; align-items: start; }
    }

    /* --- بطاقات المعلومات --- */
    .contact-info-col { display: flex; flex-direction: column; gap: 1.5rem; }
    .info-card, .social-card {
        background: var(--white);
        padding: 1.5rem;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .info-card:hover, .social-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
        border-color: rgba(37, 99, 235, 0.1);
    }
    .info-icon {
        width: 55px; height: 55px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: var(--white);
        flex-shrink: 0;
    }
    .info-icon.bg-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .info-icon.bg-green { background: linear-gradient(135deg, #10b981, #059669); }
    .info-icon.bg-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

    .info-content h4 { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem; }
    .info-content p, .info-link { font-size: 0.95rem; color: var(--text-gray); text-decoration: none; display: block; transition: color 0.2s; }
    .info-link:hover { color: var(--primary-color); }

    /* --- بطاقات التواصل الاجتماعي --- */
    .social-card { flex-direction: column; align-items: flex-start; }
    .social-card h4 { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem; }
    .social-links { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .social-btn {
        width: 45px; height: 45px;
        border-radius: 12px;
        background: var(--bg-light);
        color: var(--text-gray);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .social-btn:hover {
        background: var(--social-color);
        color: var(--white);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px -5px var(--social-color);
    }

    /* --- نموذج المراسلة --- */
    .contact-form-col {
        background: var(--white);
        padding: 2.5rem;
        border-radius: 24px;
        box-shadow: var(--shadow);
        border: 1px solid rgba(0,0,0,0.03);
    }
    .form-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
    .form-icon-wrapper {
        width: 50px; height: 50px;
        background: linear-gradient(135deg, var(--accent-color), #d97706);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        color: var(--white); font-size: 1.2rem;
    }
    .form-header h3 { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin: 0; }

    .form-row { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
    @media (min-width: 768px) { .form-row { grid-template-columns: 1fr 1fr; } }

    .form-group { position: relative; }
    .form-group label {
        display: block; font-size: 0.9rem; font-weight: 600; color: var(--text-dark); margin-bottom: 0.5rem;
    }
    .required { color: var(--error); }

    .form-group input, .form-group textarea, .form-group select {
        width: 100%;
        padding: 0.9rem 1.2rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-family: 'Cairo', sans-serif;
        font-size: 0.95rem;
        color: var(--text-dark);
        background: var(--bg-light);
        transition: all 0.3s ease;
        outline: none;
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
        border-color: var(--primary-color);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    /* تنسيق خاص للقائمة المنسدلة */
    .select-wrapper { position: relative; }
    .select-wrapper select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: left 1rem center; /* لليسار في RTL */
        background-size: 1.2rem;
        padding-left: 2.5rem;
    }

    /* رسائل الخطأ */
    .error-msg {
        display: block;
        font-size: 0.8rem;
        color: var(--error);
        margin-top: 0.4rem;
        min-height: 1.2rem;
        opacity: 0;
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }
    .form-group.has-error input, .form-group.has-error textarea, .form-group.has-error select {
        border-color: var(--error);
        background: #fef2f2;
        animation: shake 0.4s ease-in-out;
    }
    .form-group.has-error .error-msg { opacity: 1; transform: translateY(0); }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* زر الإرسال */
    .submit-btn {
        width: 100%;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: var(--white);
        border: none;
        border-radius: 12px;
        font-family: 'Cairo', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        margin-top: 1rem;
    }
    .submit-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.5);
    }
    .submit-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    .btn-loader { display: none; }
    .submit-btn.loading .btn-text, .submit-btn.loading .btn-icon { display: none; }
    .submit-btn.loading .btn-loader { display: inline-block; }

    /* --- التجاوب مع الشاشات الصغيرة --- */
    @media (max-width: 768px) {
        .contact-section { padding: 3rem 1rem; }
        .section-title { font-size: 1.8rem; }
        .contact-form-col { padding: 1.5rem; }
    }
</style>
    @if($contact)
        <section id="contact" class="contact-section">
            <!-- خلفية زخرفية متحركة -->
            <div class="contact-bg-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
            </div>

            <div class="container-custom">
                <!-- عنوان القسم -->
                <div class="section-header" data-aos="fade-up">
                    <span class="section-badge">{{ $contact->getTranslation('label', app()->getLocale()) }}</span>
                    <h2 class="section-title">{!! $contact->getTranslation('heading', app()->getLocale()) !!}</h2>
                    <p class="section-desc">{{ $contact->getTranslation('description', app()->getLocale()) }}</p>
                </div>

                <div class="contact-grid">
                    <div class="contact-form-col" data-aos="fade-right" data-aos-delay="200">
                        <form id="contactForm" action="{{ route('frontend.contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-header">
                                <div class="form-icon-wrapper">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <h3>أرسل لنا رسالة</h3>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>الاسم الكامل <span class="required">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="أدخل اسمك الثلاثي">
                                    <span class="error-msg"></span>
                                </div>
                                <div class="form-group">
                                    <label>رقم الجوال <span class="required">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required dir="ltr" placeholder="05xxxxxxxx">
                                    <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>البريد الإلكتروني</label>
                                    <input type="email" name="email" value="{{ old('email') }}" dir="ltr" placeholder="example@domain.com">
                                    <span class="error-msg"></span>
                                </div>
                                <div class="form-group">
                                    <label>الموضوع <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select name="subject" required>
                                            <option value="" disabled selected>اختر موضوع الرسالة</option>
                                            <option value="طلب عرض أسعار" {{ old('subject') === 'طلب عرض أسعار' ? 'selected' : '' }}>طلب عرض أسعار</option>
                                            <option value="دعم فني" {{ old('subject') === 'دعم فني' ? 'selected' : '' }}>دعم فني</option>
                                            <option value="شراكة تجارية" {{ old('subject') === 'شراكة تجارية' ? 'selected' : '' }}>شراكة تجارية</option>
                                            <option value="استفسار عام" {{ old('subject') === 'استفسار عام' ? 'selected' : '' }}>استفسار عام</option>
                                        </select>
                                    </div>
                                    <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label>تفاصيل الرسالة <span class="required">*</span></label>
                                <textarea name="message" rows="5" required placeholder="اكتب تفاصيل استفسارك أو طلبك هنا...">{{ old('message') }}</textarea>
                                <span class="error-msg"></span>
                            </div>

                            <button type="submit" id="submitBtn" class="submit-btn">
                                <span class="btn-text">إرسال الرسالة</span>
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
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');

            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    clearErrors();

                    // تفعيل حالة التحميل
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;

                    const formData = new FormData(form);
                    const csrfToken = form.querySelector('input[name="_token"]').value;

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (response.status === 422) {
                                return response.json().then(errors => { throw { status: 422, errors: errors }; });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // نجاح الإرسال
                                if (typeof toastr !== 'undefined') {
                                    toastr.success(data.message || 'تم إرسال رسالتك بنجاح، سنتواصل معك قريباً.', 'نجاح', {
                                        positionClass: document.documentElement.dir === 'rtl' ? 'toast-top-left' : 'toast-top-right',
                                        timeOut: 4000, progressBar: true
                                    });
                                } else {
                                    alert(data.message || 'تم الإرسال بنجاح!');
                                }
                                form.reset(); // إفراغ الحقول
                            } else {
                                throw new Error(data.message || 'حدث خطأ أثناء الإرسال');
                            }
                        })
                        .catch(error => {
                            if (error.status === 422) {
                                displayErrors(error.errors);
                                if (typeof toastr !== 'undefined') {
                                    toastr.error('يرجى تصحيح الأخطاء المميزة في النموذج', 'خطأ في التحقق', {
                                        positionClass: document.documentElement.dir === 'rtl' ? 'toast-top-left' : 'toast-top-right',
                                        timeOut: 4000
                                    });
                                }
                            } else {
                                if (typeof toastr !== 'undefined') {
                                    toastr.error(error.message || 'حدث خطأ غير متوقع في الخادم', 'خطأ', {
                                        positionClass: document.documentElement.dir === 'rtl' ? 'toast-top-left' : 'toast-top-right',
                                        timeOut: 4000
                                    });
                                }
                            }
                        })
                        .finally(() => {
                            // إعادة الزر لحالته الطبيعية
                            submitBtn.classList.remove('loading');
                            submitBtn.disabled = false;
                        });
                });
            }

            // دالة عرض الأخطاء تحت الحقول
            function displayErrors(errors) {
                for (const field in errors) {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        const formGroup = input.closest('.form-group');
                        formGroup.classList.add('has-error');
                        const errorSpan = formGroup.querySelector('.error-msg');
                        if (errorSpan) {
                            errorSpan.textContent = errors[field][0];
                        }
                    }
                }
            }

            // دالة مسح الأخطاء
            function clearErrors() {
                document.querySelectorAll('.form-group.has-error').forEach(el => el.classList.remove('has-error'));
                document.querySelectorAll('.error-msg').forEach(el => el.textContent = '');
            }

            // إزالة الخطأ فوراً عند بدء الكتابة
            document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(input => {
                input.addEventListener('input', function() {
                    this.closest('.form-group').classList.remove('has-error');
                });
            });
        });
        </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // دالة ذكية تمنع تحذيرات الـ Loop في Swiper v11
            function initSmartSwiper(selector, config) {
                const slides = document.querySelectorAll(`${selector} .swiper-slide`);
                const totalSlides = slides.length;

                // حساب أقصى عدد للشرائح المعروضة (من الإعدادات الأساسية أو نقاط التوقف breakpoints)
                let maxPerView = config.slidesPerView || 1;
                if (config.breakpoints) {
                    Object.values(config.breakpoints).forEach(bp => {
                        if (bp.slidesPerView > maxPerView) {
                            maxPerView = bp.slidesPerView;
                        }
                    });
                }

                // تفعيل الـ Loop فقط إذا كان العدد الكلي أكبر من العدد المعروض + 1 (لضمان سلاسة الحركة)
                const shouldLoop = totalSlides > maxPerView;

                new Swiper(selector, {
                    ...config,
                    loop: shouldLoop,
                    // تعطيل التشغيل التلقائي إذا لم يكن هناك حلقة لمنع أخطاء الانزلاق
                    autoplay: (shouldLoop && config.autoplay) ? config.autoplay : false,
                });
            }

            // 1. إعدادات سلايدر الآراء (Testimonials)
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

            // 2. إعدادات سلايدر الشركاء/الماركات (Brands/Partners)
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
