@extends('frontend.layouts.app')

@section('title', __('messages.all_products') . ' - ' . config('app.name'))

@section('content')
    <style>
        .products-layout {
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            gap: 2.5rem;
            align-items: start;
            margin-top: 3rem;
        }
        .products-sidebar {
            position: sticky;
            top: 100px;
            background: var(--white);
            border: 1px solid var(--cream-dark);
            border-radius: 18px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            z-index: 20;
        }
        .sidebar-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .sidebar-label {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: var(--gold-dark);
            font-size: .8rem;
            font-weight: 700;
            margin-bottom: .4rem;
        }
        .sidebar-label i {
            color: var(--gold);
        }
        .sidebar-header h3 {
            margin: 0;
            color: var(--brown);
            font-size: 1.25rem;
            font-weight: 800;
        }
        .close-sidebar {
            display: none;
            border: 0;
            background: var(--cream);
            color: var(--brown);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
        }
        .filter-group {
            margin-bottom: 1rem;
        }
        .filter-group-title {
            display: flex;
            align-items: center;
            gap: .7rem;
            color: var(--dark);
            font-weight: 800;
            font-size: .95rem;
            margin-bottom: .8rem;
        }
        .filter-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(191, 154, 73, .12);
            color: var(--gold-dark);
            border-radius: 9px;
        }
        .filter-options {
            display: flex;
            flex-direction: column;
            gap: .35rem;
        }
        .sidebar-filter {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            padding: .75rem .8rem;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: var(--gray-500);
            font-family: 'Cairo', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            text-align: right;
            cursor: pointer;
            transition: all .25s ease;
        }
        .sidebar-filter i {
            font-size: .65rem;
            opacity: 0;
            transform: translateX(5px);
            transition: all .25s ease;
        }
        .sidebar-filter:hover {
            background: var(--cream);
            color: var(--brown);
        }
        .sidebar-filter.active {
            background: linear-gradient(
                135deg,
                var(--gold),
                var(--gold-dark)
            );
            color: var(--white);
            box-shadow: 0 5px 15px rgba(191, 154, 73, .22);
        }
        .sidebar-filter.active i {
            opacity: 1;
            transform: translateX(0);
        }
        .sidebar-divider {
            height: 1px;
            background: var(--cream-dark);
            margin: 1.25rem 0;
        }
        .clear-filters {
            width: 100%;
            margin-top: 1.25rem;
            padding: .8rem 1rem;
            border: 1px solid var(--cream-dark);
            border-radius: 10px;
            background: transparent;
            color: var(--gray-500);
            font-family: 'Cairo', sans-serif;
            font-weight: 700;
            font-size: .85rem;
            cursor: pointer;
            transition: all .25s ease;
        }
        .clear-filters:hover {
            background: var(--cream);
            border-color: var(--gold);
            color: var(--brown);
        }
        .clear-filters i {
            margin-left: .4rem;
            color: var(--gold);
        }
        .products-search {
            margin-bottom: 1.5rem;
        }
        .search-box {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            background: var(--white);
            border: 1px solid var(--cream-dark);
            border-radius: 14px;
            box-shadow: var(--shadow-sm);
            transition: all .25s ease;
        }
        .search-box:focus-within {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(191, 154, 73, .12), var(--shadow-sm);
        }
        .search-icon {
            position: absolute;
            right: 1.1rem;
            color: var(--gold);
            font-size: 1rem;
            pointer-events: none;
        }
        .product-search-input {
            width: 100%;
            height: 52px;
            border: 0;
            outline: 0;
            background: transparent;
            padding: 0 3rem 0 3rem;
            color: var(--dark);
            font-family: 'Cairo', sans-serif;
            font-size: .95rem;
            font-weight: 600;
        }
        .product-search-input::placeholder {
            color: var(--gray-500);
            font-weight: 500;
        }
        .clear-search {
            position: absolute;
            left: .8rem;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 50%;
            background: var(--cream);
            color: var(--gray-500);
            cursor: pointer;
            transition: all .2s ease;
        }
        .clear-search:hover {
            background: var(--gold);
            color: var(--white);
        }
        .products-content {
            min-width: 0;
        }
        .products-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .products-result-label {
            display: block;
            color: var(--gold-dark);
            font-size: .8rem;
            font-weight: 700;
            margin-bottom: .25rem;
        }
        .products-topbar h2 {
            margin: 0;
            color: var(--brown);
            font-size: 1.5rem;
            font-weight: 800;
        }
        .selected-filter-info {
            background: var(--cream);
            color: var(--brown);
            border: 1px solid var(--cream-dark);
            padding: .55rem 1rem;
            border-radius: 50px;
            font-size: .8rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .products-grid-showcase {
            display: grid;
            grid-template-columns:repeat(auto-fill, minmax(260px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .product-card-new {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all .3s ease;
            border: 1px solid var(--cream-dark);
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }
        .product-card-new:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--gold);
        }
        .product-card-image {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: var(--cream);
        }
        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }
        .product-card-new:hover
        .product-card-image img {
            transform: scale(1.08);
        }
        .product-card-info {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .product-card-category {
            font-size: .8rem;
            color: var(--gold-dark);
            font-weight: 600;
            margin-bottom: .5rem;
        }
        .product-card-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: .75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-card-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .5rem;
        }
        .product-card-price {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--brown);
        }
        .btn-inquire-small {
            padding: .5rem 1rem;
            background: var(--cream);
            color: var(--brown);
            border-radius: 8px;
            font-size: .85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .5rem;
            transition: all .3s;
        }
        .product-card-new:hover .btn-inquire-small {
            background: var(--gold);
            color: var(--white);
        }
        .mobile-filter-bar {
            display: none;
        }
        .mobile-filter-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            padding: .9rem 1rem;
            border: 1px solid var(--cream-dark);
            border-radius: 12px;
            background: var(--white);
            color: var(--brown);
            font-family: 'Cairo', sans-serif;
            font-weight: 800;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }
        .mobile-filter-btn i {
            color: var(--gold);
        }
        .filter-count {
            display: none;
            min-width: 20px;
            height: 20px;
            align-items: center;
            justify-content: center;
            background: var(--gold);
            color: white;
            border-radius: 50%;
            font-size: .7rem;
            font-weight: 800;
        }
        .filters-overlay {
            display: none;
        }
        .scroll-sentinel {
            min-height: 70px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
        }
        .scroll-sentinel p {
            margin: .5rem 0 0;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--cream-dark);
            border-top: 4px solid var(--gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        @media (max-width: 991px) {
            .products-layout {
                grid-template-columns: 230px minmax(0, 1fr);
                gap: 1.5rem;
            }
            .products-sidebar {
                padding: 1.25rem;
            }
            .products-grid-showcase {
                grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }
        }
        @media (max-width: 767px) {
            .products-layout {
                display: block;
                margin-top: 2rem;
            }
            .mobile-filter-bar {
                display: block;
                margin-bottom: 1rem;
            }
            .products-sidebar {
                position: fixed;
                top: 0;
                right: -100%;
                width: min(340px, 90%);
                height: 100vh;
                overflow-y: auto;
                border-radius: 0;
                padding: 1.5rem;
                z-index: 1001;
                transition: right .35s ease;
                box-shadow: -10px 0 35px rgba(0,0,0,.12);
            }
            .products-sidebar.open {
                right: 0;
            }
            .close-sidebar {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .filters-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all .3s ease;
            }
            .filters-overlay.active {
                display: block;
                opacity: 1;
                visibility: visible;
            }
            body.filters-open {
                overflow: hidden;
            }
            .products-topbar {
                align-items: flex-start;
                flex-direction: column;
            }
            .selected-filter-info {
                width: 100%;
                text-align: center;
            }
            .products-grid-showcase {
                grid-template-columns:repeat(2, minmax(0, 1fr));
                gap: 1rem;
            }
            .product-card-info {
                padding: 1rem;
            }
            .product-card-name {
                font-size: .95rem;
            }
            .product-card-price {
                font-size: .95rem;
            }
            .btn-inquire-small {
                padding: .45rem .65rem;
                font-size: .75rem;
            }
        }
        @media (max-width: 420px) {
            .products-grid-showcase {
                grid-template-columns:repeat(2, minmax(0, 1fr));
                gap: .8rem;
            }
            .product-card-info {
                padding: .8rem;
            }
            .product-card-name {
                font-size: .9rem;
            }
            .product-card-price {
                font-size: .9rem;
            }
        }
        .section-heading {
            max-width: unset;
        }
        .navbar-premium {
            background: var(--brown);
        }
    </style>
    <section class="all-products-page"
             style="padding: 4rem 0; background: var(--cream); min-height: 80vh;">
        <div class="section-container">
            <nav class="breadcrumb-new" data-aos="fade-up" style="margin-bottom: 2rem;">
                <a href="{{ route('home') }}">
                    {{ __('messages.home') }}
                </a>
                <i class="fas fa-chevron-left"></i>
                <span class="current">
                    {{ __('messages.all_products') }}
                </span>
            </nav>
            <div class="text-center mb-8" data-aos="fade-up">
                <h1 class="section-heading" style="font-size: 2.5rem; margin-bottom: 1rem;">
                    {{ __('messages.all_products') }}
                </h1>
                <p class="section-desc" style="max-width: 600px; margin: 0 auto;">
                    {{ __('messages.explore_our_products_desc') }}
                </p>
            </div>
            <div class="products-layout">
                <div class="mobile-filter-bar">
                    <button type="button" class="mobile-filter-btn" id="openFilters">
                        <i class="fas fa-sliders-h"></i>
                        <span>
                            {{ __('messages.filters') }}
                        </span>
                        <span class="filter-count" id="filterCount">
                            0
                        </span>
                    </button>
                </div>
                <div class="filters-overlay"
                     id="filtersOverlay">
                </div>
                <aside class="products-sidebar" id="productsSidebar">
                    <div class="sidebar-header">
                        <div>
                            <span class="sidebar-label">
                                <i class="fas fa-sliders-h"></i>
                                {{ __('messages.filters') }}
                            </span>
                            <h3>
                                {{ __('messages.filter_products') }}
                            </h3>
                        </div>
                        <button type="button" class="close-sidebar" id="closeFilters">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="filter-group">
                        <div class="filter-group-title">
                            <span class="filter-icon">
                                <i class="fas fa-folder"></i>
                            </span>
                            <span>
                                {{ __('messages.categories') }}
                            </span>
                        </div>
                        <div class="filter-options">
                            <button type="button" class="sidebar-filter active" data-type="category" data-filter="all">
                                <span>
                                    {{ __('messages.all_products') }}
                                </span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            @foreach($categories as $category)
                                <button type="button" class="sidebar-filter" data-type="category" data-filter="{{ $category->id }}">
                                    <span>
                                        {{ $category->getTranslation('name', app()->getLocale()) }}
                                    </span>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-divider"></div>
                    <div class="filter-group">
                        <div class="filter-group-title">
                            <span class="filter-icon">
                                <i class="fas fa-award"></i>
                            </span>
                            <span>
                                {{ __('messages.partners') }}
                            </span>
                        </div>
                        <div class="filter-options">
                            <button type="button" class="sidebar-filter active" data-type="partner" data-filter="all">
                                <span>
                                    {{ __('messages.all') }}
                                </span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            @foreach($partners as $partner)
                                <button type="button" class="sidebar-filter" data-type="partner" data-filter="{{ $partner->id }}">
                                    <span>
                                        {{ $partner->getTranslation('name', app()->getLocale()) }}
                                    </span>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="clear-filters" id="clearFilters">
                        <i class="fas fa-redo-alt"></i>
                        {{ __('messages.reset_filters') }}
                    </button>
                </aside>
                <main class="products-content">
                    <div class="products-search" data-aos="fade-up">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="search" id="productSearch" class="product-search-input" placeholder="{{ __('messages.search_products') }}" autocomplete="off">
                            <button type="button" id="clearSearch" class="clear-search" style="display:none;" aria-label="{{ __('messages.clear') }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="products-topbar">
                        <div>
                            <span class="products-result-label">
                                {{ __('messages.all_products') }}
                            </span>
                            <h2>
                                {{ __('messages.explore_our_products') }}
                            </h2>
                        </div>
                        <div class="selected-filter-info" id="selectedFilterInfo">
                            {{ __('messages.all_products') }}
                        </div>
                    </div>
                    <div class="products-grid-showcase" id="productsGrid">
                    </div>
                    <div class="scroll-sentinel" id="scrollSentinel">
                        <div class="spinner" style="display:none;">
                        </div>
                        <p class="loading-text" style="display:none;">
                            {{ __('messages.loading_more') }}
                        </p>
                        <p class="end-text" style="display:none;">
                            {{ __('messages.no_more_products') }}
                        </p>
                    </div>
                </main>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productsGrid = document.getElementById('productsGrid');
            const sentinel = document.getElementById('scrollSentinel');
            const spinner = sentinel.querySelector('.spinner');
            const loadingText = sentinel.querySelector('.loading-text');
            const endText = sentinel.querySelector('.end-text');
            const filterTabs = document.querySelectorAll('.sidebar-filter');
            const sidebar = document.getElementById('productsSidebar');
            const openFilters = document.getElementById('openFilters');
            const closeFilters = document.getElementById('closeFilters');
            const filtersOverlay = document.getElementById('filtersOverlay');
            const clearFilters = document.getElementById('clearFilters');
            const filterCount = document.getElementById('filterCount');
            const selectedFilterInfo = document.getElementById('selectedFilterInfo');
            const productSearch = document.getElementById('productSearch');
            const clearSearch = document.getElementById('clearSearch');

            const AJAX_URL =@json(route('frontend.products.ajax'));

            let currentPage = 1;
            let nextPageUrl = null;
            const urlParams = new URLSearchParams(window.location.search);
            let currentCategory = urlParams.get('category') || 'all';
            let currentPartner = urlParams.get('partner') || 'all';
            let isLoading = false;

            function activateUrlFilters() {
                if (currentCategory !== 'all') {
                    const categoryButton = document.querySelector(
                        `.sidebar-filter[data-type="category"][data-filter="${currentCategory}"]`
                    );
                    if (categoryButton) {
                        document
                            .querySelectorAll('.sidebar-filter[data-type="category"]')
                            .forEach(button => {
                                button.classList.remove('active');
                            });
                        categoryButton.classList.add('active');
                    }
                }
                if (currentPartner !== 'all') {
                    const partnerButton = document.querySelector(
                        `.sidebar-filter[data-type="partner"][data-filter="${currentPartner}"]`
                    );
                    if (partnerButton) {
                        document.querySelectorAll('.sidebar-filter[data-type="partner"]')
                            .forEach(button => {
                                button.classList.remove('active');
                            });
                        partnerButton.classList.add('active');
                    }
                }
            }
            let observer = null;
            function openSidebar() {
                sidebar.classList.add('open');
                filtersOverlay.classList.add('active');
                document.body.classList.add('filters-open');
            }
            function closeSidebar() {
                sidebar.classList.remove('open');
                filtersOverlay.classList.remove('active');
                document.body.classList.remove('filters-open');
            }
            if (openFilters) {
                openFilters.addEventListener(
                    'click',
                    openSidebar
                );
            }
            if (closeFilters) {
                closeFilters.addEventListener(
                    'click',
                    closeSidebar
                );
            }
            if (filtersOverlay) {
                filtersOverlay.addEventListener(
                    'click',
                    closeSidebar
                );
            }
            function updateFilterInfo() {
                let count = 0;
                let names = [];
                if (currentCategory !== 'all') {
                    const categoryButton =
                        document.querySelector(
                            `.sidebar-filter[data-type="category"][data-filter="${currentCategory}"]`
                        );
                    if (categoryButton) {
                        const span = categoryButton.querySelector('span');
                        if (span) {
                            names.push(
                                span.textContent.trim()
                            );
                        }
                    }
                    count++;
                }
                if (currentPartner !== 'all') {
                    const partnerButton =
                        document.querySelector(
                            `.sidebar-filter[data-type="partner"][data-filter="${currentPartner}"]`
                        );
                    if (partnerButton) {
                        const span = partnerButton.querySelector('span');
                        if (span) {
                            names.push(
                                span.textContent.trim()
                            );
                        }
                    }
                    count++;
                }
                filterCount.textContent = count;
                filterCount.style.display =
                    count > 0
                        ? 'inline-flex'
                        : 'none';

                if (names.length > 0) {
                    selectedFilterInfo.textContent = names.join(' • ');
                } else {
                    selectedFilterInfo.textContent =
                    @json(__('messages.all_products'));
                }
            }

            async function fetchProducts(
                page = 1,
                append = false
            ) {
                if (isLoading) {
                    return;
                }
                isLoading = true;

                if (!append) {
                    productsGrid.innerHTML = '';
                    currentPage = 1;
                    nextPageUrl = null;
                    endText.style.display = 'none';
                }
                spinner.style.display = 'block';
                loadingText.style.display = 'block';
                try {
                    const url =
                        new URL(
                            AJAX_URL,
                            window.location.origin
                        );
                    url.searchParams.set('page', page);

                    url.searchParams.set('category', currentCategory);

                    url.searchParams.set('partner', currentPartner);

                    url.searchParams.set('search', productSearch ? productSearch.value.trim() : '');
                    const response =
                        await fetch(
                            url,
                            {
                                method: 'GET',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With':
                                        'XMLHttpRequest'
                                }
                            }
                        );
                    if (!response.ok) {
                        throw new Error(
                            'Network response was not ok'
                        );
                    }

                    const result = await response.json();
                    if (
                        result.success &&
                        Array.isArray(result.data) &&
                        result.data.length > 0
                    ) {
                        renderProducts(result.data, append);
                        nextPageUrl = result.next_page_url;
                        currentPage = result.current_page;
                    } else {
                        nextPageUrl = null;
                        if (!append) {
                            showEmptyState();
                        }
                    }
                } catch (error) {
                    console.error('Error fetching products:', error);
                    if (!append) {
                        showErrorState();
                    }
                } finally {
                    isLoading = false;
                    spinner.style.display = 'none';
                    loadingText.style.display = 'none';
                    if (!nextPageUrl) {
                        endText.style.display =
                            productsGrid.children.length > 0
                                ? 'block'
                                : 'none';
                        if (observer) {
                            observer.disconnect();
                        }
                    } else {
                        setupObserver();
                    }
                }
            }
            function showEmptyState() {
                productsGrid.innerHTML = `
            <div style="
                grid-column:1/-1;
                text-align:center;
                padding:4rem 1rem;
            ">
                <i
                    class="fas fa-box-open"
                    style="
                        font-size:3rem;
                        color:var(--gold);
                        margin-bottom:1rem;
                    "
                ></i>

                <p style="
                    color:var(--gray-500);
                    font-weight:600;
                ">

                    @json(__('messages.no_products'))

                </p>
            </div>
        `;
            }
            function showErrorState() {
                productsGrid.innerHTML = `
            <div style="
                grid-column:1/-1;
                text-align:center;
                padding:3rem 1rem;
            ">
                <i
                    class="fas fa-exclamation-circle"
                    style="
                        font-size:3rem;
                        color:var(--brown);
                        margin-bottom:1rem;
                    "
                ></i>
                <p style="
                    color:var(--gray-500);
                ">
                    @json(__('messages.check_internet_connection'))

                </p>
            </div>
        `;
            }
            function renderProducts(products, append = false) {
                const fragment = document.createDocumentFragment();
                products.forEach((product, index) => {
                    const card = document.createElement('a');
                    card.href = product.url;
                    card.className = 'product-card-new fade-in-up';
                    card.style.animationDelay = `${index * 0.05}s`;

                    const badgeName = product.partner ? product.partner.name
                                : (product.category ? product.category.name : '');

                        const priceHtml = product.price ? `
                            <span class="product-card-price">
                                ${escapeHtml(product.price)}
                            </span>
                        `
                                : '<span></span>';
                        const badgeHtml =
                            badgeName
                                ? `
                            <span class="product-card-category">
                                ${escapeHtml(badgeName)}
                            </span>
                        `
                                : '';
                        card.innerHTML = `
                    <div class="product-card-image">
                        <img
                            src="${escapeAttribute(product.image)}"
                            alt="${escapeAttribute(product.name)}"
                            loading="lazy"
                            onerror="
                                this.onerror=null;
                                this.src='{{ asset('frontend/img/product-placeholder.png') }}';
                            "
                        >
                    </div>
                    <div class="product-card-info">
                        ${badgeHtml}
                        <h3 class="product-card-name">
                            ${escapeHtml(product.name)}
                        </h3>
                        <div class="product-card-footer">
                            ${priceHtml}
                            <span class="btn-inquire-small">
                                <i class="fab fa-whatsapp"></i>
                                {{ __('messages.inquire_now') }}
                        </span>
                    </div>
                </div>
`;
                        fragment.appendChild(card);
                    }
                );
                productsGrid.appendChild(fragment);
                if (typeof AOS !== 'undefined') {
                    setTimeout(() => AOS.refresh(), 100);
                }
            }
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text ?? '';
                return div.innerHTML;
            }
            function escapeAttribute(text) {
                return escapeHtml(text).replace(/"/g, '&quot;').replace(/'/g, '&#039;');
            }
            function setupObserver() {
                if (observer) {
                    observer.disconnect();
                }
                observer = new IntersectionObserver(
                        function (entries) {
                            if (entries[0].isIntersecting && nextPageUrl && !isLoading) {
                                fetchProducts(
                                    currentPage + 1,
                                    true
                                );
                            }
                        },
                        {
                            rootMargin: '300px'
                        }
                    );
                observer.observe(
                    sentinel
                );
            }
            filterTabs.forEach(
                function (tab) {
                    tab.addEventListener('click', function () {
                            const type = this.dataset.type;
                            const value = this.dataset.filter;
                            document.querySelectorAll(`.sidebar-filter[data-type="${type}"]`)
                                .forEach(
                                    button => {
                                        button.classList.remove(
                                            'active'
                                        );
                                    }
                                );
                            this.classList.add(
                                'active'
                            );
                            if (type === 'category') {
                                currentCategory =
                                    value;
                            }
                            if (type === 'partner') {
                                currentPartner = value;
                            }
                            updateFilterInfo();
                            endText.style.display = 'none';
                            fetchProducts(1, false);
                            if (window.innerWidth <= 767) {
                                closeSidebar();
                            }
                        }
                    );
                }
            );
            if (clearFilters) {
                clearFilters.addEventListener('click', function () {
                        currentCategory = 'all';
                        currentPartner = 'all';
                        filterTabs.forEach(
                            function (button) {
                                button.classList.remove('active');
                                if (button.dataset.filter === 'all') {
                                    button.classList.add('active');
                                }
                            }
                        );
                        updateFilterInfo();
                        fetchProducts(1, false);
                        if (window.innerWidth <= 767) {
                            closeSidebar();
                        }
                    }
                );
            }
            let searchTimer = null;
            if (productSearch) {
                productSearch.addEventListener('input', function () {
                        const value = this.value.trim();
                        if (clearSearch) {
                            clearSearch.style.display = value !== '' ? 'flex' : 'none';
                        }
                        clearTimeout(searchTimer);
                        searchTimer = setTimeout(
                            function () {endText.style.display = 'none';
                                fetchProducts(
                                    1, false
                                );
                            },
                            400
                        );
                    }
                );
            }
            if (clearSearch) {
                clearSearch.addEventListener('click',
                    function () {
                        if (productSearch) {
                            productSearch.value = '';
                        }
                        clearSearch.style.display = 'none';
                        endText.style.display = 'none';
                        fetchProducts(1, false);
                        if (productSearch) {
                            productSearch.focus();
                        }
                    }
                );
            }
            activateUrlFilters();
            updateFilterInfo();
            fetchProducts(1, false);
        });
    </script>
@endsection
