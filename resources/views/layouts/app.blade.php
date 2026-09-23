<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>{{ $seoTitle ?? (isset($title) ? $title . ' | Muscle Labs' : 'Muscle Labs — Premium Research Peptides UK') }}</title>
    <meta name="description" content="{{ $seoDescription ?? 'Muscle Labs supplies independently-tested research peptides in the UK. 99%+ purity, COA verified. For research use only.' }}">
    @isset($seoKeywords)
        <meta name="keywords" content="{{ $seoKeywords }}">
    @endisset
    <meta name="robots" content="{{ $robots ?? 'index, follow' }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="Muscle Labs">
    <meta property="og:title"       content="{{ $seoTitle ?? 'Muscle Labs — Premium Research Peptides UK' }}">
    <meta property="og:description" content="{{ $seoDescription ?? 'Independently-tested research peptides with COA. For research use only.' }}">
    <meta property="og:url"         content="{{ url()->current() }}">
    @isset($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @else
        <meta property="og:image" content="{{ asset('images/og-default.jpg') }}">
    @endisset

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $seoTitle ?? 'Muscle Labs — Research Peptides UK' }}">
    <meta name="twitter:description" content="{{ $seoDescription ?? 'Independently-tested research peptides with COA. For research use only.' }}">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    {{-- Structured data slot --}}
    @stack('structured-data')

    {{-- Vite: Storefront CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Page-level head extras --}}
    @stack('head')
</head>
<body class="min-h-full flex flex-col">

    {{-- ══════════════════════════════════════
         18+ RESEARCH DISCLAIMER GATE
         Shown once; cookie-gated via JS.
         ══════════════════════════════════════ --}}
    <div id="disclaimer-gate" class="disclaimer-gate" style="display:none;" role="dialog" aria-modal="true" aria-labelledby="disclaimer-title">
        <div class="disclaimer-gate-panel">
            {{-- Warning icon --}}
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-6 animate-glow"
                 style="background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/>
                    <path d="M12 9v4"/><path d="M12 17h.01"/>
                </svg>
            </div>

            <div class="badge badge-warning mb-5" style="font-size:0.8125rem; letter-spacing:0.06em;">
                18+ — Research Use Only
            </div>

            <h2 id="disclaimer-title" class="text-2xl font-bold mb-4" style="font-family: var(--font-display);">
                Important Disclaimer
            </h2>

            <p class="mb-4" style="color: var(--color-text-secondary); font-size: 0.9375rem; line-height: 1.7;">
                All products sold by <strong style="color:var(--color-text-primary)">Muscle Labs</strong> are intended
                <strong style="color:var(--color-text-primary)">strictly for in-vitro scientific research purposes only</strong>.
                They are <strong>not</strong> for human consumption, not licensed medicines, and not approved by any regulatory authority
                for use in humans or animals.
            </p>

            <p class="mb-8" style="color: var(--color-text-muted); font-size: 0.875rem;">
                By entering this site, you confirm you are <strong style="color:var(--color-text-secondary)">18 years of age or older</strong>
                and that you understand and accept these conditions.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button id="disclaimer-accept" class="btn btn-primary btn-lg">
                    I am 18+ and understand — Enter Site
                </button>
                <button id="disclaimer-leave" class="btn btn-secondary">
                    Leave
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
         TOP ANNOUNCEMENT BAR (Flex Peptides Style)
         ══════════════════════════════════════ --}}
    <div class="relative overflow-hidden py-2 px-4 text-center text-xs font-semibold uppercase tracking-widest text-slate-200"
         style="background: linear-gradient(90deg, #090d16 0%, #1e1b4b 50%, #090d16 100%); border-bottom: 1px solid rgba(124, 111, 255, 0.25);">
        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(rgba(124, 111, 255, 0.4) 1px, transparent 1px); background-size: 16px 16px;"></div>
        <span class="relative z-10 inline-flex items-center justify-center gap-2 flex-wrap">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>RESEARCH PURPOSE ONLY</span>
            <span class="text-slate-500">|</span>
            <span>USE CODE : <strong class="text-cyan-300 font-bold">MUSCLE10</strong> FOR 10% OFF</span>
            <span class="text-slate-500 hidden sm:inline">|</span>
            <span class="hidden sm:inline">FREE UK SHIPPING OVER £100</span>
        </span>
    </div>

    {{-- ══════════════════════════════════════
         NAVIGATION
         ══════════════════════════════════════ --}}
    <header id="site-header" class="glass sticky top-0 z-50 transition-all duration-300" style="border-bottom: 1px solid var(--color-border);">
        <div class="container">
            <nav class="flex items-center justify-between h-18 py-4" style="height:4.5rem;">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Muscle Labs home">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                         style="background: linear-gradient(135deg, var(--color-accent), var(--color-cyan)); shadow: 0 0 20px rgba(124, 111, 255, 0.4);">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5"/>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight" style="font-family: var(--font-display); color: var(--color-text-primary);">
                        Muscle <span class="gradient-text">Labs</span>
                    </span>
                </a>

                {{-- Desktop nav links --}}
                <div class="hidden lg:flex items-center gap-7 text-sm font-medium">
                    <a href="{{ route('catalogue.index') }}" class="nav-link {{ request()->routeIs('catalogue.*') ? 'active' : '' }}">Shop</a>
                    <a href="{{ route('catalogue.index') }}?type=deals" class="nav-link">Deals</a>
                    <a href="{{ route('catalogue.index') }}?type=bulk" class="nav-link">Bulk Order</a>
                    <a href="{{ route('catalogue.index') }}?type=collection" class="nav-link">Lab Peptides</a>
                    <a href="{{ route('page.show', 'quality-coa') }}" class="nav-link">Quality & COA</a>
                    <a href="{{ route('news.index') }}" class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}">Learn</a>
                    <a href="{{ route('page.show', 'about-us') }}" class="nav-link">About</a>
                    <a href="{{ route('page.show', 'contact') }}" class="nav-link">Contact</a>
                </div>

                {{-- Desktop actions --}}
                <div class="hidden md:flex items-center gap-4">
                    {{-- Search --}}
                    <a href="{{ route('catalogue.index') }}?search=1" class="p-2 rounded-lg transition-colors hover:bg-white/5" style="color: var(--color-text-secondary);" aria-label="Search">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </a>

                    {{-- Account --}}
                    @auth
                        <a href="{{ route('account.index') }}" class="p-2 rounded-lg transition-colors hover:bg-white/5" style="color: var(--color-text-secondary);" aria-label="My account">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link text-sm">Sign in</a>
                    @endauth

                    {{-- Cart --}}
                    <a href="{{ route('cart.index') }}" class="relative btn btn-primary btn-sm" aria-label="Shopping cart">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                        <span>Cart</span>
                        @php $cartCount = \Lunar\Facades\CartSession::current()?->lines?->count() ?? 0; @endphp
                        @if($cartCount > 0)
                            <span id="cart-count" class="absolute -top-1.5 -right-1.5 min-w-[1.25rem] h-5 flex items-center justify-center rounded-full text-xs font-bold text-white"
                                  style="background: var(--color-cyan); padding: 0 0.25rem;">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>

                {{-- Mobile hamburger --}}
                <button id="mobile-nav-toggle" class="md:hidden p-2 rounded-lg" style="color: var(--color-text-secondary);"
                        aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobile-nav">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
            </nav>
        </div>

        {{-- Mobile nav drawer --}}
        <div id="mobile-nav" class="md:hidden" style="border-top: 1px solid var(--color-border); display:none;">
            <div class="container py-4 flex flex-col gap-3">
                <a href="{{ route('catalogue.index') }}"          class="nav-link py-2">Products</a>
                <a href="{{ route('news.index') }}"               class="nav-link py-2">News</a>
                <a href="{{ route('page.show', 'quality-coa') }}" class="nav-link py-2">Quality & COA</a>
                <a href="{{ route('page.show', 'about-us') }}"    class="nav-link py-2">About</a>
                <hr class="divider my-1">
                @auth
                    <a href="{{ route('account.index') }}" class="nav-link py-2">My Account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link py-2 w-full text-left">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"    class="nav-link py-2">Sign in</a>
                    <a href="{{ route('register') }}" class="nav-link py-2">Create account</a>
                @endauth
                <a href="{{ route('cart.index') }}" class="btn btn-primary mt-2">View cart</a>
            </div>
        </div>
    </header>

    {{-- ══════════════════════════════════════
         FLASH MESSAGES
         ══════════════════════════════════════ --}}
    @if(session()->hasAny(['success', 'error', 'warning', 'info']))
        <div class="container mt-4">
            @foreach(['success','error','warning','info'] as $type)
                @if(session($type))
                    <div class="alert alert-{{ $type }} animate-fade-up" role="alert">
                        {{ session($type) }}
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    {{-- ══════════════════════════════════════
         MAIN CONTENT
         ══════════════════════════════════════ --}}
    <main class="flex-1" id="main-content">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- ══════════════════════════════════════
         FOOTER
         ══════════════════════════════════════ --}}
    <footer style="background: var(--color-bg-surface); border-top: 1px solid var(--color-border);">
        <div class="container py-16">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-4">
                {{-- Brand --}}
                <div class="md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                             style="background: linear-gradient(135deg, var(--color-accent), var(--color-cyan));">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5"/>
                            </svg>
                        </div>
                        <span class="font-bold" style="font-family: var(--font-display);">Muscle <span class="gradient-text">Labs</span></span>
                    </a>
                    <p class="text-sm mb-4" style="color: var(--color-text-muted); line-height: 1.7;">
                        UK supplier of independently-tested research peptides. 99%+ purity, COA verified.
                    </p>
                    <div class="research-notice text-xs">
                        <svg class="icon w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                        </svg>
                        <span>For research use only. Not for human consumption. 18+.</span>
                    </div>
                </div>

                {{-- Products --}}
                <div>
                    <h3 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color: var(--color-text-secondary);">Products</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('catalogue.index') }}"      class="footer-link text-sm" style="color: var(--color-text-muted);">All Products</a></li>
                        <li><a href="{{ route('catalogue.index') }}"      class="footer-link text-sm" style="color: var(--color-text-muted);">Growth Peptides</a></li>
                        <li><a href="{{ route('catalogue.index') }}"      class="footer-link text-sm" style="color: var(--color-text-muted);">Healing Peptides</a></li>
                        <li><a href="{{ route('catalogue.index') }}"      class="footer-link text-sm" style="color: var(--color-text-muted);">Cognitive Peptides</a></li>
                        <li><a href="{{ route('order.track') }}"          class="footer-link text-sm" style="color: var(--color-text-muted);">Track Order</a></li>
                    </ul>
                </div>

                {{-- Information --}}
                <div>
                    <h3 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color: var(--color-text-secondary);">Information</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('page.show', 'about-us') }}"         class="footer-link text-sm" style="color: var(--color-text-muted);">About Us</a></li>
                        <li><a href="{{ route('page.show', 'quality-coa') }}"       class="footer-link text-sm" style="color: var(--color-text-muted);">Quality & COA</a></li>
                        <li><a href="{{ route('page.show', 'research-learn') }}"    class="footer-link text-sm" style="color: var(--color-text-muted);">Research & Learn</a></li>
                        <li><a href="{{ route('news.index') }}"                     class="footer-link text-sm" style="color: var(--color-text-muted);">News</a></li>
                        <li><a href="{{ route('page.show', 'faq') }}"               class="footer-link text-sm" style="color: var(--color-text-muted);">FAQ</a></li>
                        <li><a href="{{ route('page.show', 'contact') }}"           class="footer-link text-sm" style="color: var(--color-text-muted);">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div>
                    <h3 class="text-sm font-semibold mb-4 uppercase tracking-wider" style="color: var(--color-text-secondary);">Legal</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('page.show', 'terms-conditions') }}"  class="footer-link text-sm" style="color: var(--color-text-muted);">Terms & Conditions</a></li>
                        <li><a href="{{ route('page.show', 'privacy-policy') }}"    class="footer-link text-sm" style="color: var(--color-text-muted);">Privacy Policy</a></li>
                        <li><a href="{{ route('page.show', 'cookie-policy') }}"     class="footer-link text-sm" style="color: var(--color-text-muted);">Cookie Policy</a></li>
                        <li><a href="{{ route('page.show', 'shipping-policy') }}"   class="footer-link text-sm" style="color: var(--color-text-muted);">Shipping Policy</a></li>
                        <li><a href="{{ route('page.show', 'returns-policy') }}"    class="footer-link text-sm" style="color: var(--color-text-muted);">Returns Policy</a></li>
                        <li><a href="{{ route('page.show', 'research-disclaimer') }}" class="footer-link text-sm" style="color: var(--color-text-muted);">Research Disclaimer</a></li>
                    </ul>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4" style="border-top: 1px solid var(--color-border);">
                <p class="text-xs" style="color: var(--color-text-muted);">
                    &copy; {{ date('Y') }} Muscle Labs. All rights reserved.
                    Registered in England & Wales.
                </p>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/stripe-badge.svg') }}" alt="Secured by Stripe" class="h-6 opacity-50" onerror="this.style.display='none'">
                    <span class="text-xs px-3 py-1 rounded-full" style="background: rgba(34,197,94,0.1); color: #4ade80; border: 1px solid rgba(34,197,94,0.2);">
                        🔒 Secure Checkout
                    </span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Mobile nav overlay --}}
    <div id="mobile-nav-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:40;"></div>

    @stack('scripts')
</body>
</html>
