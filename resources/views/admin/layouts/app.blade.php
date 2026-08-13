<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ __('messages.site_name') }}</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Fonts --}}
    @if(app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Cairo', sans-serif; }</style>
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Inter', sans-serif; }</style>
    @endif

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }

        /* Sidebar Transitions */
        .sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">

    {{-- Sidebar Overlay (للشاشات الصغيرة) --}}
    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"
         onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Top Navbar --}}
        @include('admin.layouts.navbar')

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-6">
            @yield('content')
        </main>
    </div>
</div>

<script>
    function confirmDelete(url, itemName = '') {

        const isRTL = document.documentElement.dir === 'rtl';

        Swal.fire({
            title: '{{ __('messages.confirm_delete') }}',
            text: itemName
                ? itemName
                : '{{ __('messages.delete_warning') }}',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',

            confirmButtonText: '{{ __('messages.yes_delete') }}',
            cancelButtonText: '{{ __('messages.cancel') }}',

            reverseButtons: isRTL

        }).then((result) => {

            if (result.isConfirmed) {

                const form = document.createElement('form');

                form.method = 'POST';
                form.action = url;

                form.innerHTML = `
                    @csrf
                @method('DELETE')
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const isRTL = document.documentElement.dir === 'rtl';

        if (sidebar.classList.contains('-translate-x-full') || sidebar.classList.contains('translate-x-full')) {
            // Open sidebar
            sidebar.classList.remove('-translate-x-full', 'translate-x-full');
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            // Close sidebar
            if (isRTL) {
                sidebar.classList.add('translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }
    // Initialize sidebar state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const isRTL = document.documentElement.dir === 'rtl';

        if (window.innerWidth < 1024) {
            if (isRTL) {
                sidebar.classList.add('translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
</script>

@stack('scripts')

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Toastr --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const isRTL = document.documentElement.dir === 'rtl';

        // إعداد Toastr
        toastr.options = {
            closeButton: true,
            progressBar: true,
            newestOnTop: true,
            preventDuplicates: true,
            timeOut: 3000,
            extendedTimeOut: 1000,
            showDuration: 300,
            hideDuration: 300,
            showMethod: 'slideDown',
            hideMethod: 'fadeOut',
            positionClass: isRTL
                ? 'toast-top-left'
                : 'toast-top-right'
        };
        // رسالة نجاح
        @if(session('success'))
        toastr.success(@json(session('success')));
        @endif
        // رسالة خطأ
        @if(session('error'))
        toastr.error(@json(session('error')));
        @endif
        // رسالة تحذير
        @if(session('warning'))
        toastr.warning(@json(session('warning')));
        @endif

        // رسالة معلومات
        @if(session('info'))
        toastr.info(@json(session('info')));
        @endif

    });
</script>
</body>
</html>
