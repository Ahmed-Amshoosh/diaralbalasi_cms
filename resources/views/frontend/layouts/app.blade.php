<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        ديار البلعسي | مواد البناء والسباكة والأنابيب البلاستيكية في عدن، اليمن
    </title>
    <meta name="description"
          content="ديار البلعسي مورد مواد البناء والسباكة في عدن، اليمن. نوفر أنابيب PVC وUPVC وCPVC وPPR، الأدوات الصحية، المحابس، مضخات المياه وإكسسوارات المطابخ والحمامات بجودة عالية.">

    <meta name="keywords"
          content="ديار البلعسي, مواد البناء عدن, سباكة عدن, أنابيب PVC عدن, مواسير PVC اليمن, UPVC اليمن, CPVC اليمن, PPR اليمن, مضخات مياه عدن, أدوات صحية عدن, مواد البناء اليمن, عدن, اليمن">

    <meta name="author" content="ديار البلعسي">

    <meta name="robots" content="index, follow">

    <!-- Canonical -->
    <link rel="canonical" href="https://diaralbalasi.com/">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://diaralbalasi.com/img/favicon.png">

    <link rel="apple-touch-icon" href="https://diaralbalasi.com/img/favicon.png">

    <!-- Open Graph -->
    <meta property="og:type" content="website">

    <meta property="og:site_name" content="ديار البلعسي">

    <meta property="og:locale" content="ar_YE">

    <meta property="og:title"
          content="ديار البلاسي | مواد البناء والسباكة في عدن، اليمن">

    <meta property="og:description"
          content="ديار البلاسي مورد مواد البناء والسباكة في عدن، اليمن. نوفر أنابيب PVC وUPVC وCPVC وPPR والأدوات الصحية والمحابس ومضخات المياه.">

    <meta property="og:url" content="https://diaralbalasi.com/">

    <meta property="og:image" content="https://diaralbalasi.com/img/logo.png">

    <meta property="og:image:width" content="1200">

    <meta property="og:image:height" content="630">

    <meta property="og:image:alt" content="ديار البلعسي مواد البناء والسباكة">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:title" content="ديار البلعسي | Building Materials Yemen">

    <meta name="twitter:description"
          content="
        ديار البلعسي - مورد لمواد البناء في اليمن.
        أنابيب PVC وUPVC وCPVC وPPR، مستلزمات السباكة،
        الأدوات الصحية، الصمامات، ومضخات المياه.">

    <meta name="twitter:image" content="https://diaralbalasi.com/img/logo.png">

    <!-- Hashtags -->
    <meta name="hashtags"
          content=" #ديار_البلعسي  #مواد_البناء #السباكة  #الأنابيب_البلاستيكية #PVC #UPVC  #CPVC  #PPR #BuildingMaterials #Yemen ">

    <meta name="theme-color" content="#4B1F12">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;900&family=Playfair+Display:wght@400;700;900&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="preload" href="css/bootstrap.rtl.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet"
              href="css/bootstrap.rtl.min.css">
    </noscript>

    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">

    <link rel="preload" href="{{asset('frontend/css/swiper.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <link rel="preload" href="{{asset('frontend/css/aos.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Hero image preload -->
    <link rel="preload" as="image" href="{{asset('frontend/img/hero.webp')}}">

    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">

</head>
<body>
<nav class="navbar-premium" id="navbar">
    <div class="nav-container">
        <a href="#" class="brand-logo">
            <img
                src="img/logo.png"
                alt="ديار البلعسي"
                width="150"
                height="59">
        </a>

        <ul class="nav-menu" id="navMenu">
            <li><a href="#home" class="active">الرئيسية</a></li>
            <li><a href="#categories">التصنيفات</a></li>
            <li><a href="#about">من نحن</a></li>
            <li><a href="#products">المنتجات</a></li>
            <li><a href="#whyus">لماذا نحن</a></li>
            <li><a href="#contact">تواصل معنا</a></li>
        </ul>

        <div class="nav-cta">

            <!-- Language -->
            <div class="language-switcher">

                <button class="language-btn" id="languageBtn" type="button">
                    <i class="fas fa-globe"></i>

                    <span>
            {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
        </span>

                    <i class="fas fa-chevron-down language-arrow"></i>
                </button>

                <div class="language-menu" id="languageMenu">

                    <form action="{{ route('locale.switch') }}" method="POST">
                        @csrf

                        <input type="hidden" name="locale" value="ar">

                        <button type="submit"
                                class="language-option {{ app()->getLocale() === 'ar' ? 'active' : '' }}">
                            <span class="flag">🇸🇦</span>
                            <span>العربية</span>
                        </button>
                    </form>

                    <form action="{{ route('locale.switch') }}" method="POST">
                        @csrf

                        <input type="hidden" name="locale" value="en">

                        <button type="submit"
                                class="language-option {{ app()->getLocale() === 'en' ? 'active' : '' }}">
                            <span class="flag">🇺🇸</span>
                            <span>English</span>
                        </button>
                    </form>

                </div>
            </div>
            <!-- WhatsApp -->
            <a href="https://wa.me/967777181353"
               class="btn-hero-outline"
               target="_blank">
                <i class="fab fa-whatsapp"></i>
                تواصل مع المبيعات
            </a>

            <!-- Mobile -->
            <button onclick="toggleMenu()"
                    class="mobile-toggle"
                    aria-label="القائمة">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>

        </div>
    </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="footer-premium">
    <div class="section-container">
        <div class="footer-grid">
            <div>
                <a href="#" class="brand-logo">
                    <img src="img/logo.png" alt="ديار البلعسي">
                </a>
                <p class="footer-brand-desc">
                    ديار البلعسي هي إحدى المؤسسات المتخصصة في تجارة مواد البناء والسباكة والأدوات الصحية والأنابيب
                    البلاستيكية، وتخدم الأفراد والمقاولين والشركات في عدن واليمن. نوفر منتجات أصلية بجودة عالية وأسعار
                    منافسة.
                </p>
            </div>

            <div>
                <h3 class="footer-heading">روابط سريعة</h3>
                <ul class="footer-links">
                    <li><a href="#home">الرئيسية</a></li>
                    <li><a href="#about">من نحن</a></li>
                    <li><a href="#categories">التصنيفات</a></li>
                    <li><a href="#products">المنتجات</a></li>
                    <li><a href="#whyus">لماذا نحن</a></li>
                </ul>
            </div>

            <div>
                <h3 class="footer-heading">التصنيفات</h3>
                <ul class="footer-links">
                    <li><a href="products.html?category=building">مواد البناء</a></li>
                    <li><a href="products.html?category=sanitary">الأدوات الصحية</a></li>
                    <li><a href="products.html?category=plumbing">السباكة والأنابيب</a></li>
                </ul>
            </div>

            <div>
                <h3 class="footer-heading">تواصل معنا</h3>

                <a href="#" class="footer-contact-item" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-location-dot"></i>
                    <div>اليمن , عدن , سيلة</div>
                </a>

                <a href="tel:02384223" class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <div dir="ltr"> 02 384 223</div>
                </a>

                <a href="https://wa.me/967777181353" class="footer-contact-item" target="_blank"
                   rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i>
                    <div dir="ltr">+967 777 181 353</div>
                </a>

                <a href="mailto:diaralbalasiest1997@gmail.com" class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>diaralbalasiest1997@gmail.com</div>
                </a>
            </div>

        </div>

        <div class="footer-bottom">
            <div>© 2026 جميع الحقوق محفوظة - ديار البلعسي | مواد البناء والسباكة والأدوات الصحية</div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp -->
<a href="https://wa.me/967777181353" class="floating-wa" target="_blank" rel="noopener noreferrer"
   aria-label="تواصل عبر واتساب">
    <i class="fab fa-whatsapp"></i>
</a>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const languageSwitcher = document.querySelector('.language-switcher');
        const languageBtn = document.getElementById('languageBtn');

        if (!languageSwitcher || !languageBtn) {
            return;
        }

        languageBtn.addEventListener('click', function (event) {
            event.stopPropagation();
            languageSwitcher.classList.toggle('open');
        });

        document.addEventListener('click', function () {
            languageSwitcher.classList.remove('open');
        });
    });
</script>
<script src="{{asset('frontend/script.js')}}"></script>
</body>
</html>
