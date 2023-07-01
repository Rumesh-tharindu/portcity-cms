<?php

namespace App\Observers;

use App\Models\Faq;
use Illuminate\Support\Facades\Cache;
use Laragear\CacheQuery\Facades\CacheQuery;

class FaqObserver
{
    /**
     * Handle the Gallery "created" event.
     */
    public function created(Faq $faq): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Gallery "updated" event.
     */
    public function updated(Faq $faq): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Gallery "deleted" event.
     */
    public function deleted(Faq $faq): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Gallery "restored" event.
     */
    public function restored(Faq $faq): void
    {
        $this->clearsResponseCache();
    }

    /**
     * Handle the Gallery "force deleted" event.
     */
    public function forceDeleted(Faq $faq): void
    {
        $this->clearsResponseCache();
    }

    public function clearsResponseCache()
    {
        CacheQuery::forget('faq');
    }
}
