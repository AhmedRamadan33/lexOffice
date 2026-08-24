<div class="modal fade" id="activityDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('app.activity_log.changes') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="activityDetailsBody"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('activityDetailsModal');
        var modal = new bootstrap.Modal(modalEl);
        var body = document.getElementById('activityDetailsBody');

        function escapeHtml(value) {
            var div = document.createElement('div');
            div.textContent = value === null || value === undefined ? '-' : String(value);
            return div.innerHTML;
        }

        document.addEventListener('click', function (e) {
            var trigger = e.target.closest('[data-activity-details]');
            if (!trigger) return;

            var changes = [];
            try {
                changes = JSON.parse(trigger.getAttribute('data-activity-details'));
            } catch (err) {
                changes = [];
            }

            if (!changes.length) {
                body.innerHTML = '<p class="text-secondary mb-0">{{ __('app.activity_log.no_changes_recorded') }}</p>';
            } else {
                var html = '<table class="table table-sm mb-0"><thead><tr>'
                    + '<th>{{ __('app.activity_log.field') }}</th>'
                    + '<th>{{ __('app.activity_log.old_value') }}</th>'
                    + '<th>{{ __('app.activity_log.new_value') }}</th>'
                    + '</tr></thead><tbody>';
                changes.forEach(function (c) {
                    html += '<tr><td class="fw-semibold">' + escapeHtml(c.field) + '</td>'
                        + '<td class="cell-muted">' + escapeHtml(c.old) + '</td>'
                        + '<td>' + escapeHtml(c.new) + '</td></tr>';
                });
                html += '</tbody></table>';
                body.innerHTML = html;
            }

            modal.show();
        });
    });
</script>
