<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\CaseModel;
use App\Models\CaseSession;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\Court;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PracticeArea;
use App\Models\SiteSetting;
use App\Models\SuccessStory;
use App\Models\Task;
use App\Models\Testimonial;
use App\Models\User;
use App\Repositories\Contracts\ActivityLogRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Activitylog\Models\Activity;

class ActivityLogService
{
    private const SUBJECT_KEYS = [
        Client::class => 'client',
        CaseModel::class => 'case',
        CaseSession::class => 'case_session',
        Invoice::class => 'invoice',
        Payment::class => 'payment',
        Expense::class => 'expense',
        Task::class => 'task',
        User::class => 'user',
        Branch::class => 'branch',
        Court::class => 'court',
        CaseType::class => 'case_type',
        SiteSetting::class => 'site_setting',
        PracticeArea::class => 'practice_area',
        Testimonial::class => 'testimonial',
        SuccessStory::class => 'success_story',
    ];

    public function __construct(protected ActivityLogRepositoryInterface $logs)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        $user = auth()->user();

        if (! $user->can('view-all-branches')) {
            $filters['branch_id'] = $user->branch_id;
        }

        $paginator = $this->logs->paginate($filters);

        $paginator->getCollection()->transform(function (Activity $activity) {
            $activity->formatted_changes = $this->formatChanges($activity);
            $activity->subject_label = __('app.activity_log.subjects.'.$this->subjectKey($activity->subject_type));

            return $activity;
        });

        return $paginator;
    }

    public function subjectKey(?string $class): string
    {
        return self::SUBJECT_KEYS[$class] ?? 'unknown';
    }

    public function subjectOptions(): array
    {
        return collect(self::SUBJECT_KEYS)
            ->mapWithKeys(fn ($key, $class) => [$class => __('app.activity_log.subjects.'.$key)])
            ->all();
    }

    private function formatChanges(Activity $activity): array
    {
        $changes = $activity->attribute_changes ?? collect();
        $attributes = collect($changes->get('attributes', []));
        $old = collect($changes->get('old', []));

        if ($attributes->isEmpty() && $old->isNotEmpty()) {
            // Deleted events only carry the final ("old") values, no new attributes.
            return $old
                ->map(fn ($oldValue, $field) => [
                    'field' => $field,
                    'old' => $this->formatValue($oldValue),
                    'new' => '-',
                ])
                ->values()
                ->all();
        }

        if ($attributes->isEmpty()) {
            return [];
        }

        return $attributes
            ->map(fn ($newValue, $field) => [
                'field' => $field,
                'old' => $this->formatValue($old->get($field)),
                'new' => $this->formatValue($newValue),
            ])
            ->values()
            ->all();
    }

    private function formatValue(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '-';
        }

        if (is_bool($value)) {
            return $value ? '✓' : '-';
        }

        if (is_array($value)) {
            return collect($value)
                ->map(fn ($v, $k) => strtoupper((string) $k).': '.($v === null || $v === '' ? '-' : $v))
                ->implode(' | ');
        }

        if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}[T ]\d{2}:\d{2}:\d{2}/', $value)) {
            $date = \Illuminate\Support\Carbon::parse($value);

            return $date->format($date->isMidnight() ? 'Y-m-d' : 'Y-m-d H:i');
        }

        return (string) $value;
    }
}
