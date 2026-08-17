@extends('frontend.layouts.app')


@section('content')
    <!-- NEW HERO SECTION WITH BACKGROUND IMAGE -->
    <section class="hero-new" id="home">
        <div class="hero-bg">
            <img src="./img/hero.webp"
                 alt="مواد البناء والسباكة" class="hero-bg-image">
        </div>
        <div class="hero-content">
            <div class="hero-badge-new">
                <i class="fas fa-award"></i>
                <span>أكثر من 20 عاماً من الثقة في قطاع مواد البناء</span>
            </div>

            <h1 class="hero-title-new">
                شريكك الموثوق في<br>
                <span class="highlight">مواد البناء</span> والسباكة<br>
                والأدوات الصحية
            </h1>

            <p class="hero-desc-new">نوفر تشكيلة متكاملة من مواد البناء، والأنابيب البلاستيكية، والأدوات الصحية، والمحابس،
                ومضخات المياه، وإكسسوارات المطابخ والحمامات، بجودة عالية وأسعار تنافسية تلبي احتياجات الأفراد والمقاولين
                والمشاريع.</p>
        </div>

        <div class="hero-stats-floating">
            <div class="hero-stat-float">
                <span class="number" data-target="20">0</span>
                <span class="label">عاماً من الخبرة</span>
            </div>
            <div class="hero-stat-float">
                <span class="number" data-target="5000">0</span>
                <span class="label">منتج متنوع</span>
            </div>
            <div class="hero-stat-float">
                <span class="number" data-target="15">0</span>
                <span class="label">ألف عميل</span>
            </div>
            <div class="hero-stat-float">
                <span class="number" data-target="8">0</span>
                <span class="label">أقسام رئيسية</span>
            </div>
        </div>

        <div class="hero-scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Marquee Strip -->
    <div class="marquee-strip">
        <div class="marquee-track">
            <div class="marquee-item">منتجات أصلية 100% <span class="star">✦</span></div>
            <div class="marquee-item">أسعار تنافسية للجملة والتجزئة <span class="star"></span></div>
            <div class="marquee-item">توريد للمشاريع والمقاولين <span class="star">✦</span></div>
            <div class="marquee-item">استشارات فنية متخصصة <span class="star">✦</span></div>
            <div class="marquee-item">خدمة عملاء احترافية <span class="star">✦</span></div>
            <div class="marquee-item">منتجات أصلية 100% <span class="star">✦</span></div>
            <div class="marquee-item">أسعار تنافسية للجملة والتجزئة <span class="star">✦</span></div>
            <div class="marquee-item">توريد للمشاريع والمقاولين <span class="star">✦</span></div>
            <div class="marquee-item">استشارات فنية متخصصة <span class="star">✦</span></div>
            <div class="marquee-item">خدمة عملاء احترافية <span class="star">✦</span></div>
        </div>
    </div>

    <!-- BENTO GRID SECTION (Moved from Hero) -->
    <section class="bento-grid-section" id="categories">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label">تصنيفاتنا</div>
                    <h2 class="section-heading">
                        استكشف <span class="accent">أقسام منتجاتنا</span>
                    </h2>
                </div>
                <p class="section-desc">
                    نوفر جميع مستلزمات البناء والتشطيب والسباكة في أقسام منظمة لتسهيل الوصول إلى المنتجات التي تحتاجها
                </p>
            </div>

            <div class="bento-grid">
                <div class="bento-item large" data-aos="fade-up" data-aos-delay="300"
                     onclick="window.location.href='products.html?category=building'">
                    <img src="./img/car3.webp"
                         alt="مواد البناء">
                    <div class="bento-arrow">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <div class="bento-content">
                        <div class="bento-icon">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <h3 class="bento-title">مواد البناء</h3>
                    </div>
                </div>

                <div class="bento-item" data-aos="fade-up" data-aos-delay="100"
                     onclick="window.location.href='products.html?category=sanitary'">
                    <img src="./img/cat1.webp"
                         alt="الأدوات الصحية">
                    <div class="bento-arrow">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <div class="bento-content">
                        <div class="bento-icon">
                            <i class="fas fa-bath"></i>
                        </div>
                        <h3 class="bento-title">الأدوات الصحية</h3>
                    </div>
                </div>

                <div class="bento-item" data-aos="fade-up" data-aos-delay="200"
                     onclick="window.location.href='products.html?category=plumbing'">
                    <img src="./img/cat2.webp"
                         alt="السباكة والأنابيب">
                    <div class="bento-arrow">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <div class="bento-content">
                        <div class="bento-icon">
                            <i class="fas fa-faucet"></i>
                        </div>
                        <h3 class="bento-title">السباكة والأنابيب</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="section-container">
            <div class="about-grid">
                <div class="about-visual" data-aos="fade-left">
                    <div class="about-img-main">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="محل مواد البناء">
                    </div>
                    <div class="about-img-secondary">
                        <img src="./img/about.webp"
                             alt="ديار البلعسي">
                    </div>
                    <div class="about-experience-badge">
                        <div class="number">20+</div>
                        <div class="text">عاماً من التميز</div>
                    </div>
                </div>

                <div class="about-content" data-aos="fade-right">
                    <div class="section-label">من نحن</div>
                    <h2 class="section-heading">
                        شريكك الموثوق في <span class="accent">عالم البناء</span>
                    </h2>
                    <p style="color: var(--gray-500); margin-top: 25px; line-height: 1.9; font-size: 1.05rem;">
                        ديار البلعسي مؤسسة متخصصة في توفير مواد البناء، والأنابيب البلاستيكية، والأدوات الصحية، ومستلزمات
                        السباكة، والمحابس، ومضخات المياه، وإكسسوارات المطابخ والحمامات. نحرص على توفير منتجات أصلية بجودة
                        عالية تلبي احتياجات الأفراد والمقاولين والشركات، مع الالتزام بالأسعار المناسبة وخدمة العملاء
                        المتميزة.
                    </p>

                    <div class="about-features">
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">منتجات أصلية</div>
                                <div class="about-feature-desc">نوفر منتجات من علامات تجارية موثوقة</div>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">أسعار منافسة</div>
                                <div class="about-feature-desc">أفضل الأسعار للجملة والتجزئة</div>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <i class="fas fa-truck-loading"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">توريد للمشاريع</div>
                                <div class="about-feature-desc">حلول متكاملة للمقاولين والشركات</div>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <div class="about-feature-title">استشارات فنية</div>
                                <div class="about-feature-desc">مساعدتك في اختيار المنتجات المناسبة</div>
                            </div>
                        </div>
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
                    <div class="section-label" style="color: var(--gold);">لماذا نحن</div>
                    <h2 class="section-heading">
                        لماذا <span class="accent">يختارنا عملاؤنا؟</span>
                    </h2>
                </div>
                <p class="section-desc">
                    نلتزم بتقديم تجربة استثنائية لعملائنا في كل جوانب الخدمة
                </p>
            </div>

            <div class="whyus-grid">
                <div class="whyus-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="whyus-number">01</div>
                    <div class="whyus-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="whyus-title">أكثر من 20 عاماً من الخبرة</h3>
                    <p class="whyus-desc">خبرة طويلة في قطاع مواد البناء والسباكة نضمن لك من خلالها الجودة والاحترافية</p>
                </div>

                <div class="whyus-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="whyus-number">02</div>
                    <div class="whyus-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="whyus-title">منتجات أصلية</h3>
                    <p class="whyus-desc">نوفر منتجات من علامات تجارية موثوقة مع ضمان الجودة والشهادات المعتمدة</p>
                </div>

                <div class="whyus-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="whyus-number">03</div>
                    <div class="whyus-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3 class="whyus-title">أسعار منافسة</h3>
                    <p class="whyus-desc">أفضل الأسعار في السوق مع عروض وخصومات مستمرة للجملة والتجزئة</p>
                </div>

                <div class="whyus-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="whyus-number">04</div>
                    <div class="whyus-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3 class="whyus-title">تشكيلة واسعة</h3>
                    <p class="whyus-desc">آلاف المنتجات تحت سقف واحد من مواد البناء، السباكة، الأدوات الصحية، والكهرباء</p>
                </div>

                <div class="whyus-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="whyus-number">05</div>
                    <div class="whyus-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="whyus-title">توريد للمشاريع</h3>
                    <p class="whyus-desc">حلول متكاملة للمقاولين والشركات مع خدمة التوصيل والتركيب عند الحاجة</p>
                </div>

                <div class="whyus-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="whyus-number">06</div>
                    <div class="whyus-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="whyus-title">خدمة عملاء احترافية</h3>
                    <p class="whyus-desc">فريق متخصص لمساعدتك في اختيار المنتجات المناسبة ومتابعة ما بعد البيع</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label" style="color: var(--gold);">آراء العملاء</div>
                    <h2 class="section-heading">
                        ماذا يقول <span class="accent">عملاؤنا وشركاؤنا؟</span>
                    </h2>
                </div>
                <p class="section-desc">
                    نفخر بثقة عملائنا وشراكاتنا الناجحة في مختلف المشاريع الإنشائية والتجارية
                </p>
            </div>

            <!-- Swiper -->
            <div class="swiper testimonials-swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">
                    @php
                        $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('order')->get();
                    @endphp

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
                                        <h4 class="author-name">{{ $testimonial->getTranslation('name', app()->getLocale()) }}</h4>
                                        <span class="author-role">{{ $testimonial->getTranslation('role', app()->getLocale()) }}</span>
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
                            <div class="text-center py-10 text-gray-500">
                                <p>لا توجد آراء مضافة حالياً.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .testimonials-section { padding: 80px 0; background-color: #f8f9fa; }
            .testimonial-card {
                background: #ffffff;
                border-radius: 16px;
                padding: 30px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                height: 100%;
                display: flex;
                flex-direction: column;
                border: 1px solid rgba(0,0,0,0.03);
            }
            .testimonial-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            }
            .testimonial-quote-icon {
                font-size: 2rem;
                color: var(--gold, #d4af37);
                margin-bottom: 15px;
                opacity: 0.8;
            }
            .testimonial-text {
                font-size: 1.05rem;
                line-height: 1.8;
                color: var(--gray-600, #4b5563);
                flex-grow: 1;
                margin-bottom: 25px;
                font-style: italic;
            }
            .testimonial-author {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-top: 1px solid #eee;
                padding-top: 20px;
            }
            .author-info { display: flex; flex-direction: column; }
            .author-name {
                font-size: 1.1rem;
                font-weight: 700;
                color: #1f2937;
                margin: 0 0 4px 0;
            }
            .author-role {
                font-size: 0.85rem;
                color: var(--gold, #d4af37);
                font-weight: 600;
            }
            .author-rating { display: flex; gap: 3px; }
            .author-rating .fa-star { color: #e5e7eb; font-size: 0.9rem; }
            .author-rating .fa-star.active { color: #fbbf24; }

            .testimonials-swiper { padding-bottom: 50px !important; }
            .swiper-pagination-bullet-active { background-color: var(--gold, #d4af37) !important; }
        </style>
    @endpush

    @push('scripts')
        <script>
            // تهيئة سلايدر آراء العملاء
            document.addEventListener('DOMContentLoaded', function() {
                if (document.querySelector('.testimonials-swiper')) {
                    new Swiper('.testimonials-swiper', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        autoplay: { delay: 4000, disableOnInteraction: false },
                        pagination: { el: '.swiper-pagination', clickable: true },
                        breakpoints: {
                            768: { slidesPerView: 2 },
                            1024: { slidesPerView: 3 }
                        }
                    });
                }
            });
        </script>
    @endpush

    <section class="partners-section" data-aos="fade-up">
        <div class="section-container">
            <div class="section-header-new" data-aos="fade-up">
                <div>
                    <div class="section-label" style="color: var(--gold);">علاماتنا التجارية</div>
                    <h2 class="section-heading">
                        علاماتنا <span class="accent">التجارية</span>
                    </h2>
                </div>
                <p class="section-desc">
                    نتعامل مع أفضل العلامات التجارية العالمية في مجال مواد البناء والسباكة
                </p>
            </div>

            <!-- Swiper -->
            <div class="swiper brands-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/altaj.webp" alt="التاج">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/arkime.webp" alt="أركيم">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/bls.webp" alt="BLS">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/bt.webp" alt="BT">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/grmn.webp" alt="جرمان">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/sky.webp" alt="سكاي">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/pipe.webp" alt="بايب">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/dbt.webp" alt="DBT">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/rgm.webp" alt="RGM">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-logo-box">
                            <img src="./img/brands/jeddah-plast.webp" alt="جدة بلاست">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="contact" data-aos="fade-up">
        <div class="cta-image">
            <img src="./img/hero.webp"
                 alt="تواصل معنا">
        </div>
        <div class="cta-content">
            <h2 class="cta-heading">
                هل تحتاج إلى<br>
                <span class="accent">استشارة أو عرض أسعار؟</span>
            </h2>

            <p class="cta-desc">
                فريقنا جاهز للإجابة على استفساراتك ومساعدتك في اختيار المنتجات المناسبة لمشروعك.
                نوفر مواد البناء، الأنابيب البلاستيكية PVC و UPVC و CPVC و PPR، الأدوات الصحية،
                المحابس، مضخات المياه، وإكسسوارات المطابخ والحمامات بجودة عالية وأسعار تنافسية.
            </p>

            <div class="cta-buttons">
                <a href="https://wa.me/967777181353" class="btn-hero-outline" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    احصل على أفضل الأسعار
                </a>
            </div>
        </div>

    </section>

    @php
        $contact = \App\Models\ContactSection::first();
    @endphp

    @if($contact)
        <section id="contact" class="py-20 bg-gray-50 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-yellow-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

            <div class="container mx-auto px-4 relative z-10">

                {{-- العنوان الديناميكي --}}
                <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-sm font-bold tracking-wider mb-4">
                {{ $contact->getTranslation('label', app()->getLocale()) }}
            </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {!! $contact->getTranslation('heading', app()->getLocale()) !!}
                    </h2>
                    <p class="text-gray-600 mt-4 max-w-2xl mx-auto leading-relaxed">
                        {{ $contact->getTranslation('description', app()->getLocale()) }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12">

                    {{-- معلومات التواصل --}}
                    <div class="lg:col-span-2 space-y-6" data-aos="fade-left">

                        @if($contact->address && (is_array($contact->address) ? ($contact->getTranslation('address', app()->getLocale()) ?? '') : $contact->address))
                            <div class="flex items-start gap-4 p-5 rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                                <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-map-marker-alt text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">موقعنا</h4>
                                    <p class="text-gray-600 mt-1 text-sm leading-relaxed">{{ $contact->getTranslation('address', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        @endif

                        @if(!empty($contact->phones))
                            <div class="flex items-start gap-4 p-5 rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                                <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
                                    <i class="fas fa-phone-alt text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">اتصل بنا</h4>
                                    @foreach($contact->phones as $phone)
                                        <p class="text-gray-600 mt-1 text-sm" dir="ltr" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">{{ $phone }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(!empty($contact->emails))
                            <div class="flex items-start gap-4 p-5 rounded-2xl bg-white shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                                <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                                    <i class="fas fa-envelope text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">البريد الإلكتروني</h4>
                                    @foreach($contact->emails as $email)
                                        <p class="text-gray-600 mt-1 text-sm" dir="ltr" style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">{{ $email }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- نموذج المراسلة --}}
                    <div class="lg:col-span-3" data-aos="fade-right">
                        @if(session('success'))
                            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4 flex items-center gap-3">
                                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('frontend.contact.submit') }}" method="POST" class="bg-white p-8 md:p-10 rounded-3xl shadow-lg border border-gray-100">
                            @csrf
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">أرسل لنا رسالة</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الاسم الكامل <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none" placeholder="أدخل اسمك">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">رقم الجوال <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required dir="ltr" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-right" placeholder="05xxxxxxxx">
                                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">البريد الإلكتروني</label>
                                    <input type="email" name="email" value="{{ old('email') }}" dir="ltr" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-right" placeholder="example@domain.com">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الموضوع <span class="text-red-500">*</span></label>
                                    <select name="subject" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                                        <option value="" disabled selected>اختر موضوع الرسالة</option>
                                        <option value="طلب عرض أسعار" {{ old('subject') === 'طلب عرض أسعار' ? 'selected' : '' }}>طلب عرض أسعار</option>
                                        <option value="دعم فني" {{ old('subject') === 'دعم فني' ? 'selected' : '' }}>دعم فني</option>
                                        <option value="شراكة تجارية" {{ old('subject') === 'شراكة تجارية' ? 'selected' : '' }}>شراكة تجارية</option>
                                        <option value="استفسار عام" {{ old('subject') === 'استفسار عام' ? 'selected' : '' }}>استفسار عام</option>
                                    </select>
                                    @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="mb-8">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">تفاصيل الرسالة <span class="text-red-500">*</span></label>
                                <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none resize-none" placeholder="اكتب تفاصيل استفسارك...">{{ old('message') }}</textarea>
                                @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="w-full md:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-300 flex items-center justify-center gap-2 group">
                                <span>إرسال الرسالة</span>
                                <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform duration-300"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
