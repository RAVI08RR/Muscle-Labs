/**
 * Muscle Labs — Storefront JavaScript
 * Handles: disclaimer gate, qty selectors, tiered pricing, cart AJAX,
 *           mobile nav, tabs, and micro-interactions.
 */

// ─── Disclaimer Gate ────────────────────────────────────────────────────────
(function () {
    'use strict';

    const COOKIE_KEY  = 'ml_research_accepted';
    const COOKIE_DAYS = 365;

    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = `${name}=${value}; expires=${expires}; path=/; SameSite=Lax`;
    }

    function initDisclaimerGate() {
        const gate   = document.getElementById('disclaimer-gate');
        const accept = document.getElementById('disclaimer-accept');
        const leave  = document.getElementById('disclaimer-leave');

        if (!gate) return;

        if (getCookie(COOKIE_KEY) === '1') {
            gate.remove();
            return;
        }

        gate.style.display = 'flex';

        accept && accept.addEventListener('click', () => {
            setCookie(COOKIE_KEY, '1', COOKIE_DAYS);
            gate.classList.add('animate-fade-out');
            setTimeout(() => gate.remove(), 400);
        });

        leave && leave.addEventListener('click', () => {
            window.location.href = 'https://www.google.co.uk';
        });
    }

    // ─── Qty Selector + Tiered Pricing ───────────────────────────────────
    function initQtySelectors() {
        document.querySelectorAll('[data-qty-selector]').forEach(selector => {
            const minus   = selector.querySelector('[data-qty-minus]');
            const plus    = selector.querySelector('[data-qty-plus]');
            const input   = selector.querySelector('[data-qty-input]');
            const product = selector.closest('[data-product]');

            if (!input) return;

            const min = parseInt(input.getAttribute('min') || '1', 10);
            const max = parseInt(input.getAttribute('max') || '999', 10);

            function clamp(val) { return Math.max(min, Math.min(max, val)); }

            function updatePrice(qty) {
                if (!product) return;
                const tiers = JSON.parse(product.getAttribute('data-price-tiers') || '[]');
                const priceEl = product.querySelector('[data-current-price]');
                const saveEl  = product.querySelector('[data-save-badge]');
                const baseEl  = product.querySelector('[data-base-price]');

                // Find best tier
                let bestTier = null;
                for (const tier of tiers) {
                    if (qty >= tier.min_quantity) bestTier = tier;
                    else break;
                }

                if (priceEl && bestTier) {
                    const unitPrice  = (bestTier.price / 100).toFixed(2);
                    const totalPrice = ((bestTier.price * qty) / 100).toFixed(2);
                    priceEl.textContent = `£${unitPrice}`;

                    const savePercent = Math.round((1 - bestTier.price / tiers[0].price) * 100);
                    if (saveEl) {
                        if (savePercent > 0) {
                            saveEl.textContent = `Save ${savePercent}%`;
                            saveEl.style.display = '';
                        } else {
                            saveEl.style.display = 'none';
                        }
                    }

                    // Highlight active tier row
                    product.querySelectorAll('[data-tier-row]').forEach(row => {
                        row.classList.toggle('active', parseInt(row.dataset.tierMin, 10) === bestTier.min_quantity);
                    });
                }
            }

            function setValue(val) {
                input.value = clamp(val);
                updatePrice(parseInt(input.value, 10));
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }

            minus && minus.addEventListener('click', () => setValue(parseInt(input.value, 10) - 1));
            plus  && plus.addEventListener('click',  () => setValue(parseInt(input.value, 10) + 1));
            input.addEventListener('change', () => {
                setValue(parseInt(input.value, 10) || min);
            });

            // Initial price update
            updatePrice(parseInt(input.value, 10) || min);
        });
    }

    // ─── Mobile Nav Toggle ──────────────────────────────────────────────
    function initMobileNav() {
        const toggle  = document.getElementById('mobile-nav-toggle');
        const nav     = document.getElementById('mobile-nav');
        const overlay = document.getElementById('mobile-nav-overlay');

        if (!toggle || !nav) return;

        function openNav() {
            nav.classList.add('open');
            overlay && (overlay.style.display = 'block');
            document.body.style.overflow = 'hidden';
            toggle.setAttribute('aria-expanded', 'true');
        }
        function closeNav() {
            nav.classList.remove('open');
            overlay && (overlay.style.display = 'none');
            document.body.style.overflow = '';
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', () => nav.classList.contains('open') ? closeNav() : openNav());
        overlay && overlay.addEventListener('click', closeNav);
        document.addEventListener('keydown', e => e.key === 'Escape' && closeNav());
    }

    // ─── Tab switcher ───────────────────────────────────────────────────
    function initTabs() {
        document.querySelectorAll('[data-tabs]').forEach(container => {
            const buttons = container.querySelectorAll('[data-tab-btn]');
            const panels  = container.querySelectorAll('[data-tab-panel]');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const target = btn.getAttribute('data-tab-btn');
                    buttons.forEach(b => b.classList.toggle('active', b === btn));
                    panels.forEach(p => p.classList.toggle('hidden', p.getAttribute('data-tab-panel') !== target));
                });
            });
        });
    }

    // ─── Cart line item update (AJAX) ───────────────────────────────────
    function initCartUpdates() {
        document.querySelectorAll('[data-cart-qty]').forEach(input => {
            let debounceTimer;
            input.addEventListener('change', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    const lineId = input.getAttribute('data-line-id');
                    const qty    = parseInt(input.value, 10);

                    fetch('/cart/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        },
                        body: JSON.stringify({ line_id: lineId, quantity: qty }),
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.redirect) {
                            window.location.reload();
                        }
                        // Update sub-total display
                        const subtotalEl = document.getElementById('cart-subtotal');
                        if (subtotalEl && data.subtotal) subtotalEl.textContent = data.subtotal;
                        const countEl = document.getElementById('cart-count');
                        if (countEl && data.count !== undefined) countEl.textContent = data.count;
                    })
                    .catch(() => window.location.reload());
                }, 500);
            });
        });

        // Remove line items
        document.querySelectorAll('[data-remove-line]').forEach(btn => {
            btn.addEventListener('click', () => {
                const lineId = btn.getAttribute('data-line-id');
                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify({ line_id: lineId }),
                })
                .then(() => window.location.reload())
                .catch(() => window.location.reload());
            });
        });
    }

    // ─── Smooth scroll for anchor links ────────────────────────────────
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', e => {
                const target = document.querySelector(link.getAttribute('href'));
                if (!target) return;
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    }

    // ─── Sticky header shadow ───────────────────────────────────────────
    function initStickyHeader() {
        const header = document.getElementById('site-header');
        if (!header) return;
        const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 20);
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // ─── Init all ───────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        initDisclaimerGate();
        initQtySelectors();
        initMobileNav();
        initTabs();
        initCartUpdates();
        initSmoothScroll();
        initStickyHeader();
    });

})();
