<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger" style="width:64px;height:64px;">
                        <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                    </span>
                </div>
                <h5 class="mb-2">{{ __('app.messages.delete_title') }}</h5>
                <p class="text-secondary mb-4" id="confirmDeleteMessage">{{ __('app.messages.confirm_delete') }}</p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">{{ __('app.actions.cancel') }}</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteButton">{{ __('app.actions.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('confirmDeleteModal');
        var modal = new bootstrap.Modal(modalEl);
        var pendingForm = null;

        document.addEventListener('click', function (e) {
            var trigger = e.target.closest('[data-confirm-delete]');
            if (!trigger) return;
            e.preventDefault();
            pendingForm = trigger.closest('form');
            var message = trigger.getAttribute('data-confirm-message');
            document.getElementById('confirmDeleteMessage').textContent = message || '{{ __('app.messages.confirm_delete') }}';
            modal.show();
        });

        document.getElementById('confirmDeleteButton').addEventListener('click', function () {
            if (pendingForm) {
                pendingForm.submit();
            }
        });
    });
</script>
