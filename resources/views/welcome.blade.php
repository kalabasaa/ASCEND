<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ascend') }} — {{ __('Keep the streak') }}</title>
    <link rel="icon" href="{{ asset('assets/logo/ascend.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>
<body>

    {{-- HEADER --}}
    <header class="site-header">
        <div class="container">
            <div class="site-header__row">
                <a href="{{ url('/') }}" class="brand">
                    <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend">
                </a>

                <nav class="nav">
                    <a href="#features">{{ __('Features') }}</a>
                    <a href="#how">{{ __('How it works') }}</a>
                    <a href="#about">{{ __('About') }}</a>
                    <a href="#contact">{{ __('Contact') }}</a>
                </nav>

                <div class="header-actions">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="link-login">{{ __('Log in') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn--primary">{{ __('Get started') }}</a>
                    @endif
                    <button class="nav-toggle" data-nav-toggle aria-label="{{ __('Menu') }}" aria-expanded="false">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round">
                            <path d="M3 6h18M3 12h18M3 18h18"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    {{-- MOBILE MENU (outside header so backdrop-filter doesn't trap position: fixed) --}}
    <div class="mobile-overlay" data-nav-overlay></div>

    <aside class="mobile-panel" data-mobile-menu aria-hidden="true">
        <button class="mobile-panel__close" data-nav-close aria-label="{{ __('Close menu') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round">
                <path d="M6 6l12 12M18 6L6 18"/>
            </svg>
        </button>

        <a href="#features">{{ __('Features') }}</a>
        <a href="#how">{{ __('How it works') }}</a>
        <a href="#about">{{ __('About') }}</a>
        <a href="#contact">{{ __('Contact') }}</a>

        @if (Route::has('login'))
            <a href="{{ route('login') }}">{{ __('Log in') }}</a>
        @endif
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn--primary">{{ __('Get started') }}</a>
        @endif
    </aside>

    {{-- HERO --}}
    <section class="hero section--cream">
        <div class="container hero__grid">
            <div>
                <span class="eyebrow">{{ __('For people who show up') }}</span>
                <h1>{{ __('Keep the streak. Keep showing up.') }}</h1>
                <p>{{ __('Ascend logs your training so the work you put in never goes unnoticed. Check in, tag the session, and watch your streak build day by day.') }}</p>
                <div class="hero__actions">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn--primary">{{ __('Create your account') }}</a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-link">{{ __('I already have one') }}</a>
                    @endif
                </div>
            </div>

            <div class="hero__visual">
                <div class="hero__photo">
                    <img src="{{ asset('assets/image/gym-bro.jpg') }}" alt="{{ __('Training with Ascend') }}">
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section id="features" class="features section--gray">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('Three things, done well') }}</h2>
                <p>{{ __('No dashboards to manage. Just what keeps you consistent.') }}</p>
            </div>

            <div class="feature-list">
                <div class="feature-row" data-reveal>
                    <div class="feature-row__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2c1 3-1 4.5-2.3 6C8 10 7 11.6 7 13.5a5 5 0 0 0 10 0c0-2-1.2-3-1.2-3 .4 2-1 3-1.8 3-1.1 0-1.5-1-1-2 .6-1.2.5-2.7-1-3.5 .3 1-.5 2-2 1.5-1-.3-1-1.5 0-2.5Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3>{{ __('Streak tracking') }}</h3>
                        <p>{{ __("Your current streak updates with every check-in, and your longest streak is saved on its own, so there's always a personal record worth chasing instead of a number that just resets.") }}</p>
                    </div>
                </div>

                <div class="feature-row" data-reveal>
                    <div class="feature-row__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 11.5 11.5 3H19a2 2 0 0 1 2 2v7.5L12.5 21 3 11.5Z"/>
                            <circle cx="15.5" cy="8.5" r="1.4"/>
                        </svg>
                    </div>
                    <div>
                        <h3>{{ __('Tag your training') }}</h3>
                        <p>{{ __('Push day, leg day, cardio, mobility. Use your own words for it. Your history ends up looking like your training, not a generic log.') }}</p>
                    </div>
                </div>

                <div class="feature-row" data-reveal>
                    <div class="feature-row__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3.5" y="4.5" width="17" height="16" rx="2.5"/>
                            <path d="M3.5 9.5h17M8 3v3M16 3v3"/>
                            <path d="m8.5 14 2 2 4.5-4.5"/>
                        </svg>
                    </div>
                    <div>
                        <h3>{{ __('One check-in a day') }}</h3>
                        <p>{{ __('Ascend asks for one thing each day and nothing more. No streak freezes to manage and no settings to tune, just open it, log it, and move on.') }}</p>
                    </div>
                </div>

                <div class="feature-row" data-reveal>
                    <div class="feature-row__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8.5" r="3.5"/>
                            <path d="M5 20c0-3.6 3.1-6.5 7-6.5s7 2.9 7 6.5"/>
                        </svg>
                    </div>
                    <div>
                        <h3>{{ __('Make it yours') }}</h3>
                        <p>{{ __("Set a profile photo and a name that's actually yours. Small touch, but it's the difference between using an app and having an account that feels like your own.") }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section id="how" class="how section--dark">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('How it works') }}</h2>
                <p>{{ __('Three steps. That covers the whole app.') }}</p>
            </div>

            <ol class="steps">
                <li class="steps__item">
                    <span class="steps__num">01</span>
                    <div>
                        <h3>{{ __('Create your account') }}</h3>
                        <p>{{ __('Sign up with your name and a username. Takes under a minute.') }}</p>
                    </div>
                </li>
                <li class="steps__item">
                    <span class="steps__num">02</span>
                    <div>
                        <h3>{{ __('Check in when you train') }}</h3>
                        <p>{{ __('Log a session any day you show up. Tag it however you like.') }}</p>
                    </div>
                </li>
                <li class="steps__item">
                    <span class="steps__num">03</span>
                    <div>
                        <h3>{{ __('Watch your streak build') }}</h3>
                        <p>{{ __('Current and longest streaks update automatically, no extra taps required.') }}</p>
                    </div>
                </li>
            </ol>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="about section--gray">
        <div class="container about__grid">
            <div>
                <h2>{{ __('Why Ascend exists') }}</h2>
                <p>{{ __('Most fitness apps focus on the workout itself. Ascend focuses on what happens after, whether you came back the next day, and the day after that. It is a small tool with one job: make it obvious when you have shown up, and worth showing up again tomorrow.') }}</p>
            </div>

            <ul class="values-list">
                <li>
                    <strong>{{ __('Simple') }}</strong>
                    <span>{{ __('One check-in, one streak. No dashboards to get lost in.') }}</span>
                </li>
                <li>
                    <strong>{{ __('Honest') }}</strong>
                    <span>{{ __('Your streak reflects what you actually did, not a vanity metric.') }}</span>
                </li>
                <li>
                    <strong>{{ __('Yours') }}</strong>
                    <span>{{ __('Tag training your own way. Ascend adapts to how you train.') }}</span>
                </li>
            </ul>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="cta-band">
        <h2>{{ __('Your streak starts with one check-in.') }}</h2>
        <p>{{ __("You can't build what you don't start.") }}</p>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn--light">{{ __('Get started free') }}</a>
        @endif
    </section>

    {{-- FOOTER --}}
    <footer id="contact" class="site-footer">
        <div class="container footer__grid">
            <div>
                <div class="footer-brand">
                    <img src="{{ asset('assets/logo/ascend.png') }}" alt="">
                    <img src="{{ asset('assets/logo/ascend-t.png') }}" alt="Ascend">
                </div>
                <p>{{ __('Consistency, tracked. One check-in at a time.') }}</p>
            </div>

            <div>
                <div class="footer-heading">{{ __('Contact') }}</div>
                <ul class="footer-list">
                    <li>{{ __('MacArthur Highway, Nancayasan, Urdaneta City, Pangasinan') }}<br>{{ __('(near SM Urdaneta)') }}</li>
                    <li><a href="mailto:ascend.gym@gmail.com">ascend.gym@gmail.com</a></li>
                    <li><a href="tel:+639123456789">+63 912 345 6789</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-heading">{{ __('Follow') }}</div>
                <ul class="footer-list">
                    <li><a href="https://facebook.com/AscendGym" target="_blank">Ascend Gym on Facebook</a></li>
                    <li><a href="https://instagram.com/ascendgym" target="_blank">Ascend Gym on Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Ascend. {{ __('All rights reserved.') }}
        </div>
    </footer>

</body>
</html>