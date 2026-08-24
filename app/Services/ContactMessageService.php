<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactMessageService
{
    public function __construct(protected ContactMessageRepositoryInterface $messages)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->messages->paginate($filters);
    }

    public function submit(array $data): ContactMessage
    {
        return $this->messages->create($data);
    }

    public function markRead(ContactMessage $message): ContactMessage
    {
        return $this->messages->update($message, ['is_read' => true]);
    }

    public function delete(ContactMessage $message): bool
    {
        return $this->messages->delete($message);
    }
}
