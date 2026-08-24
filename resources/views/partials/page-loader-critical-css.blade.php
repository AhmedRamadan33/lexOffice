<style>
    /* Critical, inlined so the loader is never itself unstyled/FOUC before app.css loads */
    .page-loader {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1.25rem;
        background-color: #ffffff;
        transition: opacity 0.25s ease, visibility 0.25s ease;
        opacity: 1;
        visibility: visible;
    }
    .page-loader-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    .page-loader img {
        width: 88px;
        height: auto;
        animation: page-loader-pulse 1.4s ease-in-out infinite;
    }
    .page-loader-spinner {
        width: 34px;
        height: 34px;
        border: 3px solid #eef2ff;
        border-top-color: #4f6ef7;
        border-radius: 50%;
        animation: page-loader-spin 0.8s linear infinite;
    }
    @keyframes page-loader-spin { to { transform: rotate(360deg); } }
    @keyframes page-loader-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.55; } }
</style>
