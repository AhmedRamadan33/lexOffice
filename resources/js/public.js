import './bootstrap';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

/* Branded page loader (mirrors app.js's loader logic) */
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
