<?php

namespace App\Base;

use Illuminate\Support\Facades\Auth;

abstract class BaseObserver
{
    /**
     * Nama log untuk model ini.
     * Harus di-set di observer khusus.
     */
    protected string $logName;

    /**
     * Method utama untuk mencatat log.
     */
    protected function logActivity($model, string $event, array $extraProperties = [])
    {
        $request = request();

        activity()
            ->performedOn($model)
            ->causedBy(Auth::user())
            ->useLog($this->logName) // gunakan logName dari observer khusus
            ->withProperties(array_merge([
                'event' => $event,
                'attributes' => $model->getAttributes(),
                'old' => $event === 'updated' ? $model->getOriginal() : null,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
            ], $extraProperties))
            ->log(ucfirst($event) . ' ' . class_basename($model));
    }

    /**
     * Default event handler untuk model
     */
    public function created($model)
    {
        $this->logActivity($model, 'created');
    }

    public function updated($model)
    {
        $this->logActivity($model, 'updated');
    }

    public function deleted($model)
    {
        $this->logActivity($model, 'deleted');
    }

    /**
     * Abstract method opsional untuk mengubah logName per observer
     */
    abstract protected function setLogName(): void;
}
