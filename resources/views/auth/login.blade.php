<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login') }} - {{ __('messages.site_name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @if(app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Cairo', sans-serif; }</style>
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Inter', sans-serif; }</style>
    @endif
</head>
<body
    style="background: linear-gradient(135deg, #321010 0%, #6A2423 50%, #7B2D2B 100%);"
    class="min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                {{ __('messages.login') }}
            </h1>
            <p class="text-gray-600">
                {{ __('messages.welcome_to_dashboard') }}
            </p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('messages.email') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full ps-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6A2423] focus:border-[#6A2423]">
                </div>
                @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('messages.password') }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password"
                           name="password"
                           required
                           class="w-full ps-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6A2423] focus:border-[#6A2423]">
                </div>
                @error('password')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <button type="submit"
                    class="w-full bg-[#6A2423] hover:bg-[#521B1A] text-white font-bold py-3 px-4 rounded-lg transition-colors">
                {{ __('messages.login') }}
            </button>
        </form>
    </div>
</div>
</body>
</html>
