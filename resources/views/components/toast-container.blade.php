<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 shadow" role="alert" data-bs-delay="4000" id="toast-success">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-bg-danger border-0 shadow" role="alert" data-bs-delay="5000" id="toast-error">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="toast align-items-center text-bg-info border-0 shadow" role="alert" data-bs-delay="5000" id="toast-info">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast align-items-center text-bg-warning border-0 shadow" role="alert" data-bs-delay="5000" id="toast-warning">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ __('app.messages.please_check_form') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toast').forEach(function (el) {
            new bootstrap.Toast(el).show();
        });
    });
</script>
