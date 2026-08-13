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

@endsection
