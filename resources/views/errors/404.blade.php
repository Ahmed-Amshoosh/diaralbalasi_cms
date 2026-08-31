@php
    $locale = session('locale', config('app.locale', 'ar'));

    if (!in_array($locale, config('app.available_locales', ['ar', 'en']))) {
        $locale = 'ar';
    }

    app()->setLocale($locale);
@endphp

@extends('frontend.layouts.app')

@section('title', __('messages.page_not_found') . ' - 404')

@section('content')
    <section class="error-page" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background: var(--cream); padding: 4rem 1rem;">
        <div class="section-container text-center" style="max-width: 600px;">

            <div class="error-icon" data-aos="zoom-in">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <h1 class="error-code" data-aos="fade-up" data-aos-delay="100">
                404
            </h1>

            <h2 class="error-title" data-aos="fade-up" data-aos-delay="200">
                {{ __('messages.page_not_found') }}
            </h2>

            <div class="error-actions" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-home"></i>

                    {{ __('messages.back_to_home') }}
                </a>
            </div>

        </div>
    </section>

    <style>
        .navbar-premium {
            background: var(--brown);
        }

        .error-icon {
            font-size: 5rem;
            color: var(--gold);
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            color: var(--brown);
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 4px 4px 0px var(--gold);
        }

        .error-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: 0.9rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-family: 'Tajawal', sans-serif;
            background: var(--gradient-gold);
            color: var(--white);
            box-shadow: var(--shadow-gold);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(238, 182, 23, 0.4);
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 1.4rem;
            }

            .error-actions {
                flex-direction: column;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection
