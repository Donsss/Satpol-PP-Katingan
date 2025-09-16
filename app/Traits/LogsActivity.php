<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            static::logActivity($model, 'Menambahkan');
        });

        static::updated(function ($model) {
            if ($model->isDirty('views') && count($model->getDirty()) === 1) {
                return;
            }

            static::logActivity($model, 'Memperbarui');
        });

        static::deleted(function ($model) {
            static::logActivity($model, 'Menghapus');
        });
    }

    protected static function logActivity($model, $action)
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => static::generateLogDescription($model, $action),
            'loggable_id' => $model->id,
            'loggable_type' => get_class($model),
        ]);
    }

    protected static function generateLogDescription($model, $action)
    {
        $modelName = class_basename($model);
        $userName = Auth::user()->name ?? 'Sistem';
        
        $modelIdentifier = $model->judul ?? $model->name ?? '';

        return "{$userName} telah {$action} {$modelName} '{$modelIdentifier}'";
    }
}