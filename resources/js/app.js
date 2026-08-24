import './bootstrap';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

import $ from 'jquery';
window.$ = window.jQuery = $;

// select2's UMD build exports a factory that must be invoked explicitly with
// (window, jQuery) — a bare side-effect import never calls it, so $.fn.select2
// silently stays undefined. See feedback_select2_umd_vite_import memory.
import select2 from 'select2';
select2(window, $);

document.addEventListener('DOMContentLoaded', function () {
    const isRtl = document.documentElement.getAttribute('dir') === 'rtl';

    $('select:not(.no-select2)').each(function () {
        $(this).select2({
            theme: 'bootstrap-5',
            dir: isRtl ? 'rtl' : 'ltr',
            width: '100%',
            placeholder: $(this).data('placeholder') || null,
            allowClear: $(this).data('allow-clear') === true,
        });
    });
});

/* Branded page loader: shown by default (see components/page-loader.blade.php),
 * hidden once the page has fully loaded, and re-shown for full-page navigations
 * (this app is server-rendered/multi-page, not an SPA). */
(function () {
    const MIN_VISIBLE_MS = 350;
    const shownAt = Date.now();

    function hideLoader() {
        const loader = document.getElementById('page-loader');
        if (!loader) return;
        const elapsed = Date.now() - shownAt;
        const wait = Math.max(MIN_VISIBLE_MS - elapsed, 0);
        setTimeout(() => loader.classList.add('page-loader-hidden'), wait);
    }

    window.addEventListener('load', hideLoader);

    document.addEventListener('click', function (e) {
        const link = e.target.closest('a[href]');
        if (!link || link.target === '_blank' || link.hasAttribute('download')) return;

        const url = new URL(link.href, window.location.href);
        const isSamePageAnchor = url.pathname === window.location.pathname && url.hash;
        if (url.origin !== window.location.origin || isSamePageAnchor || e.ctrlKey || e.metaKey) return;

        document.getElementById('page-loader')?.classList.remove('page-loader-hidden');
    });

    document.addEventListener('submit', function () {
        document.getElementById('page-loader')?.classList.remove('page-loader-hidden');
    });
})();
