<?php

namespace App\Observers;

use App\Models\Activity;
use Laragear\CacheQuery\Facades\CacheQuery;

class ActivityObserver
{
    /**
     * Handle the Activity "created" event.
     */
    public function created(Activity $activity): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Activity "updated" event.
     */
    public function updated(Activity $activity): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Activity "deleted" event.
     */
    public function deleted(Activity $activity): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Activity "restored" event.
     */
    public function restored(Activity $activity): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Activity "force deleted" event.
     */
    public function forceDeleted(Activity $activity): void
    {
        $this->clearsResponseCache();
    }

    public function clearsResponseCache()
    {
        CacheQuery::forget('activity');
    }
}
