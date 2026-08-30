<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        // 1. دالة آمنة لاستخراج النصوص المترجمة (مثل العناوين، الوصف، والكلمات المفتاحية)
        $getTranslatable = function($key, $default = '') {
            $value = \App\Models\Setting::get($key, $default);
            if (is_array($value)) {
                return $value[app()->getLocale()] ?? $value['ar'] ?? $default;
            }
            return $value ?: $default;
        };

        // 2. دالة آمنة لاستخراج النصوص العادية والروابط (مثل الأكواد، الروبوتات، ومسار الصورة)
        $getSimpleString = function($key, $default = '') {
            $value = \App\Models\Setting::get($key, $default);
            if (is_array($value)) {
                $values = array_values($value);
                return $values[0] ?? $default;
            }
            return $value ?: $default;
        };

        // 3. جلب البيانات مع قيم افتراضية احتياطية (Fallback) لضمان عدم ظهور أخطاء
        $seoTitle = $getTranslatable('seo_title', 'ديار البلعسي | مواد البناء والسباكة في عدن، اليمن');
        $seoDesc = $getTranslatable('seo_description', 'ديار البلعسي مورد مواد البناء والسباكة في عدن، اليمن. نوفر أنابيب PVC وUPVC وCPVC وPPR، الأدوات الصحية، المحابس، مضخات المياه وإكسسوارات المطابخ والحمامات بجودة عالية.');
        $seoKeywords = $getTranslatable('seo_keywords', 'ديار البلعسي, مواد البناء عدن, سباكة عدن, أنابيب PVC, UPVC, CPVC, PPR, مضخات مياه, أدوات صحية, اليمن');

        $seoAuthor = $getSimpleString('seo_author', 'ديار البلعسي');
        $seoRobots = $getSimpleString('seo_robots', 'index, follow');
        $seoTwitterCard = $getSimpleString('seo_twitter_card', 'summary_large_image');
        $seoTwitterSite = $getSimpleString('seo_twitter_site', '');
        $seoCanonical = $getSimpleString('seo_canonical_url', url()->current());
        $seoAnalytics = $getSimpleString('seo_google_analytics', '');
        $seoGTM = $getSimpleString('seo_google_tag_manager', '');

        // 4. معالجة رابط صورة المشاركة ليكون مطلقاً (Absolute URL) كما تتطلب فيسبوك وتويتر
        $ogImagePath = $getSimpleString('seo_og_image', 'img/logo.png');
        $logoPath = $getSimpleString('logo', 'img/logo.png');
        $mobile = $getSimpleString('mobile', '');
        $email = $getSimpleString('email', '');
        $address = $getSimpleString('address', '');
        $phone = $getSimpleString('phone', '');
        $fullOgImageUrl = filter_var($ogImagePath, FILTER_VALIDATE_URL) ? $ogImagePath : asset('storage/' . $ogImagePath);

        $currentUrl = url()->current();
        $locale = app()->getLocale();
        $ogLocale = $locale === 'ar' ? 'ar_YE' : 'en_US';
        $categories = \App\Models\Category::query()->get();
    @endphp

        <!-- ═══════════════════════════════════════════ -->
    <!-- Basic SEO Meta Tags -->
    <!-- ═══════════════════════════════════════════ -->
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="author" content="{{ $seoAuthor }}">
    <meta name="robots" content="{{ $seoRobots }}">

    <link rel="canonical" href="{{ $seoCanonical }}">

    <!-- ═══════════════════════════════════════════ -->
    <!-- Open Graph / Facebook -->
    <!-- ═══════════════════════════════════════════ -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $seoTitle }}">
    <meta property="og:locale" content="{{ $ogLocale }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:image" content="{{ $fullOgImageUrl }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="ديار البلعسي مواد البناء والسباكة">

    <!-- ═══════════════════════════════════════════ -->
    <!-- Twitter / X -->
    <!-- ═══════════════════════════════════════════ -->
    <meta name="twitter:card" content="{{ $seoTwitterCard }}">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ $fullOgImageUrl }}">
    @if($seoTwitterSite)
        <meta name="twitter:site" content="{{ $seoTwitterSite }}">
    @endif

    <!-- ═══════════════════════════════════════════ -->
    <!-- Google Analytics -->
    <!-- ═══════════════════════════════════════════ -->
    @if($seoAnalytics)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoAnalytics }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', '{{ $seoAnalytics }}');
        </script>
    @endif

    <!-- ═══════════════════════════════════════════ -->
    <!-- Google Tag Manager -->
    <!-- ═══════════════════════════════════════════ -->
    @if($seoGTM)
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $seoGTM }}');</script>
    @endif

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;900&family=Playfair+Display:wght@400;700;900&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="preload" href="{{asset('frontend/css/bootstrap.rtl.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
              href="{{asset('frontend/css/bootstrap.rtl.min.css')}}">
    </noscript>

    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">

    <link rel="preload" href="{{asset('frontend/css/swiper.css')}}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">

    <link rel="preload" href="{{asset('frontend/css/aos.css')}}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">

    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <style>
        body{
            font-family: 'Tajawal', sans-serif !important;
        }
    @if(app()->getLocale() === 'en')

            @media (max-width: 991px) {
                .nav-menu {
                    transform: translateX(-100%);
                }
            }

    @endif
    </style>
</head>
<body>
<nav class="navbar-premium" id="navbar">
    <div class="nav-container">
        <a href="/#" class="brand-logo">
            <img src="{{ Storage::url($logoPath) }}"
                 alt="{{ $seoTitle }}"
                 width="150"
                 height="59">
        </a>
        <ul class="nav-menu" id="navMenu">
            <li><a href="/#home" class="active">{{ __('messages.nav_home') }}</a></li>
            <li><a href="/#categories">{{ __('messages.nav_categories') }}</a></li>
            <li><a href="/#about">{{ __('messages.nav_about') }}</a></li>
            <li><a href="/#products">{{ __('messages.nav_products') }}</a></li>
            <li><a href="/#whyus">{{ __('messages.nav_why_us') }}</a></li>
            <li><a href="/#contact">{{ __('messages.nav_contact') }}</a></li>
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
            <a href="https://wa.me/{{$mobile}}"
               class="btn-hero-outline"
               target="_blank">
                <i class="fab fa-whatsapp"></i>
                {{ __('messages.nav_contact_sales') }}
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
                <a href="/#" class="brand-logo">
                    <img src="{{ Storage::url($logoPath) }}" alt="{{  $seoTitle  }}">
                </a>
                <p class="footer-brand-desc">{{$seoDesc}}</p>
            </div>

            <div>
                <h3 class="footer-heading">{{ __('messages.quick_links') }}</h3>
                <ul class="footer-links">
                    <li><a href="/#home" >{{ __('messages.nav_home') }}</a></li>
                    <li><a href="/#categories">{{ __('messages.nav_categories') }}</a></li>
                    <li><a href="/#about">{{ __('messages.nav_about') }}</a></li>
                    <li><a href="/#products">{{ __('messages.nav_products') }}</a></li>
                    <li><a href="/#whyus">{{ __('messages.nav_why_us') }}</a></li>
                </ul>
            </div>

            <div>
                <h3 class="footer-heading">{{ __('messages.categories') }}</h3>
                <ul class="footer-links">
                    @foreach($categories as $category)
                        <li><a href="{{ route('frontend.products.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
                    @endforeach

                </ul>
            </div>

            <div>
                <h3 class="footer-heading">{{ __('messages.contact_us') }}</h3>
                <a href="#" class="footer-contact-item" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-location-dot"></i>
                    <div>{{$address}}</div>
                </a>
                <a href="tel:{{$phone}}" class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <div dir="ltr"> {{$phone}}</div>
                </a>
                <a href="https://wa.me/{{$mobile}}" class="footer-contact-item" target="_blank"
                   rel="noopener noreferrer">
                    <i class="fab fa-whatsapp"></i>
                    <div dir="ltr">+{{$mobile}}</div>
                </a>
                <a href="mailto:{{$email}}" class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>{{$email}}</div>
                </a>
            </div>

        </div>

        <div class="footer-bottom">
            <div>{{ __('messages.copyright') }}</div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp -->
<a href="https://wa.me/{{$mobile}}" class="floating-wa" target="_blank" rel="noopener noreferrer"
   aria-label="{{ __('messages.whatsapp') }}">
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
