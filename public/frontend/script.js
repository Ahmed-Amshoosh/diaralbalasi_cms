
AOS.init({
    duration: 1000,
    once: true,
    offset: 80
});

// Navbar Scroll
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Mobile Menu
function toggleMenu() {
    document.getElementById('navMenu').classList.toggle('active');
}

// Animated Counters
const counters = document.querySelectorAll('.hero-stat-float .number');
const animateCounters = () => {
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const inc = target / 100;

        if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(animateCounters, 30);
        } else {
            counter.innerText = target + '+';
        }
    });
};

const heroObserver = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounters();
            heroObserver.disconnect();
        }
    });
}, {threshold: 0.5});

const heroSection = document.querySelector('.hero-new');
if (heroSection) heroObserver.observe(heroSection);
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href.length > 1) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({behavior: 'smooth', block: 'start'});
                document.getElementById('navMenu').classList.remove('active');
            }
        }
    });
});

// Active Nav on Scroll
const sections = document.querySelectorAll('section[id]');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 150;
        if (scrollY >= sectionTop) {
            current = section.getAttribute('id');
        }
    });

    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

const GOOGLE_SCRIPT_URL = 'https://script.google.com/macros/s/AKfycbxm7VNu_47UBXH1WPzHWYWfk5CRBTGeE3YqXv8pJznY8CDr8uugOQzBYIjh7YPSPMeL/exec';

let allProducts = [];
const MAX_DISPLAY = 8; // عرض 8 صور فقط كحد أقصى

document.addEventListener('DOMContentLoaded', () => {
    fetchProducts();
    setupFilterTabs();
});

async function fetchProducts() {
    const showcaseDiv = document.getElementById('productsShowcase');
    if (showcaseDiv) {
        showcaseDiv.innerHTML = '<div class="text-center py-5"><div class="spinner"></div><p>جاري تحميل المنتجات...</p></div>';
    }

    try {
        const response = await fetch(GOOGLE_SCRIPT_URL);
        if (!response.ok) throw new Error('فشل في الاتصال');

        const result = await response.json();

        if (result.success) {
            // معالجة جميع البيانات وتخزينها
            allProducts = result.data.map(item => {
                let rawUrl = item.thumbnail || item.url || '';
                let cleanUrlString = rawUrl.replace(/&amp;/g, '&');
                const match = cleanUrlString.match(/\/d\/([-\w]{25,})\//) || cleanUrlString.match(/id=([-\w]{25,})/);
                const cleanId = item.id || (match ? match[1] : '');
                const safeThumbnail = cleanId ? `https://drive.google.com/thumbnail?id=${cleanId}&sz=w400` : '';

                return {
                    ...item,
                    id: cleanId,
                    thumbnail: safeThumbnail,
                    category: detectCategory(item.name)
                };
            });

            // عرض 8 صور متنوعة عند التحميل الأول (الكل)
            displayProducts('all');

        } else {
            throw new Error(result.error || 'خطأ في البيانات');
        }
    } catch (error) {
        console.error('Error:', error);
        if (showcaseDiv) {
            showcaseDiv.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: #dc3545; margin-bottom: 15px;"></i>
                        <h4 style="color: var(--brown);">تعذر تحميل المنتجات</h4>
                        <p style="color: var(--gray-500);">يرجى التحقق من اتصال الإنترنت</p>
                    </div>`;
        }
    }
}

// دالة لخلط المصفوفة عشوائياً لعرض صور متنوعة من جميع الأقسام في تاب "الكل"
function shuffleArray(array) {
    const shuffled = [...array];
    for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
    }
    return shuffled;
}

function displayProducts(category) {
    const grid = document.getElementById('productsShowcase');
    if (!grid) return;

    grid.innerHTML = ''; // مسح المحتوى الحالي

    let productsToShow = [];

    if (category === 'all') {
        // خلط جميع المنتجات وأخذ أول 8 لضمان التنوع من كل الأقسام
        productsToShow = shuffleArray(allProducts).slice(0, MAX_DISPLAY);
    } else {
        // تصفية حسب القسم وأخذ أول 8
        productsToShow = allProducts.filter(p => p.category === category).slice(0, MAX_DISPLAY);
    }

    if (productsToShow.length === 0) {
        grid.innerHTML = `
                <div class="text-center py-5" style="grid-column: 1/-1;">
                    <i class="fas fa-box-open" style="font-size: 3rem; color: var(--gold); margin-bottom: 15px;"></i>
                    <p style="color: var(--gray-500);">لا توجد منتجات متاحة في هذا القسم حالياً</p>
                </div>`;
        return;
    }

    // رسم المنتجات
    productsToShow.forEach((product, index) => {
        const div = document.createElement('div');
        div.className = 'product-showcase-card fade-in-up';
        div.style.animationDelay = `${index * 0.1}s`; // تأثير ظهور متتابع

        const cleanId = product.id;
        const productName = formatProductName(product.name);
        const whatsappMessage = encodeURIComponent(`مرحباً، أريد الاستفسار عن المنتج: ${productName}`);
        const whatsappLink = `https://wa.me/967777123456?text=${whatsappMessage}`; // غيّر الرقم هنا

        div.innerHTML = `
    <div class="product-showcase-image">
        <img src="${product.thumbnail}" alt="${productName}" loading="lazy" onerror="this.src='https://via.placeholder.com/400x300/F5EFE6/C9A227?text=ديار+البلعسي'">
        <a href="${whatsappLink}" class="btn-wa-hover" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-whatsapp"></i>
            <span>استفسر الآن</span>
        </a>
    </div>
`;
        grid.appendChild(div);
    });

    // إعادة تفعيل أنيميشن AOS إذا كان موجوداً
    if (typeof AOS !== 'undefined') {
        setTimeout(() => AOS.refresh(), 100);
    }
}

function setupFilterTabs() {
    const filterTabs = document.querySelectorAll('.filter-tab-new');
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // إزالة التنشيط من جميع الأزرار
            filterTabs.forEach(t => t.classList.remove('active'));
            // تنشيط الزر المضغوط
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');
            displayProducts(filterValue);
        });
    });
}

// ==========================================
// دوال مساعدة
// ==========================================
function detectCategory(filename) {
    if (!filename) return 'all';

    const name = filename.toLowerCase().trim();

    if (name.includes('سباكة')) {
        return 'plumbing';
    }

    if (name.includes('صحي')) {
        return 'sanitary';
    }

    if (name.includes('بناء')) {
        return 'building';
    }

    return 'all';
}

function getCategoryName(category) {
    const names = {
        'building': 'مواد البناء',
        'sanitary': 'الأدوات الصحية',
        'plumbing': 'السباكة',
        'all': 'منوع'
    };
    return names[category] || 'عام';
}

function formatProductName(filename) {
    if (!filename) return 'منتج';
    return filename.replace(/\.[^/.]+$/, '').replace(/[-_]/g, ' ').trim();
}

// تحديث تلقائي خفي كل 10 دقائق
setInterval(fetchProducts, 600000);
