<?php

namespace App\Services;

use App\Models\CaseModel;
use App\Models\Client;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DocumentService
{
    public function upload(string $type, int $id, Request $request): Media
    {
        $model = $this->resolveModel($type, $id);

        return $model->addMediaFromRequest('file')->toMediaCollection('documents');
    }

    public function delete(Media $media): bool
    {
        return (bool) $media->delete();
    }

    private function resolveModel(string $type, int $id): HasMedia
    {
        return match ($type) {
            'client' => Client::findOrFail($id),
            'case' => CaseModel::findOrFail($id),
        };
    }
}
