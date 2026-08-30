<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <?php
    $faviconPath = \App\Models\Setting::get('favicon', '');
        ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ Storage::url($faviconPath) }}">
    <title>@yield('title') - {{ __('messages.site_name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @if(app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Cairo', sans-serif; }</style>
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Inter', sans-serif; }</style>
    @endif
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .tab-animate {
            animation: fadeInUp 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">
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
            sidebar.classList.remove('-translate-x-full', 'translate-x-full');
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            if (isRTL) {
                sidebar.classList.add('translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isRTL = document.documentElement.dir === 'rtl';
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
        @if(session('success'))
        toastr.success(@json(session('success')));
        @endif
        @if(session('error'))
        toastr.error(@json(session('error')));
        @endif

    });
</script>
</body>
</html>
