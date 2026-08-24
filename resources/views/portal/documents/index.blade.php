<x-portal-layout :title="__('app.portal.documents.title')">
    <section class="pub-section py-4">
        <div class="container">
            <h4 class="mb-4" style="color:var(--pub-navy);">{{ __('app.portal.documents.title') }}</h4>

            <div class="pub-detail-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('app.labels.documents') }}</th>
                                <th>{{ __('app.portal.documents.source') }}</th>
                                <th class="text-end">{{ __('app.actions.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $row)
                                <tr>
                                    <td>{{ $row['media']->file_name }}</td>
                                    <td class="text-muted">{{ $row['source'] }}</td>
                                    <td class="text-end"><a href="{{ $row['media']->getUrl() }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-download"></i></a></td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center text-muted py-4">{{ __('app.portal.documents.empty') }}</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-portal-layout>
