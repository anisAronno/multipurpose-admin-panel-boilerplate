<?php

namespace App\Observers;

use App\Models\Contact;
use App\Helpers\CacheHelper;
use App\Traits\ClearCache;

class ContactObserver
{
    use ClearCache;

    protected $contactCacheKey = '';

    public function __construct()
    {
        $this->contactCacheKey = CacheHelper::getContactCacheKey();
    }
    /**
     * Handle the Contact "created" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function created(Contact $contact)
    {
        $this->clearCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "updated" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function updated(Contact $contact)
    {
        $this->clearCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "deleted" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        $this->clearCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "restored" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function restored(Contact $contact)
    {
        $this->clearCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "force deleted" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function forceDeleted(Contact $contact)
    {
        $this->clearCache($this->contactCacheKey);
    }
}
