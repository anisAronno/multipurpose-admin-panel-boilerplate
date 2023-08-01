<?php

namespace App\Observers;

use App\Helpers\CacheHelper;
use App\Models\Contact;

class ContactObserver
{
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
        CacheHelper::forgetCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "updated" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function updated(Contact $contact)
    {
        CacheHelper::forgetCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "deleted" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        CacheHelper::forgetCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "restored" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function restored(Contact $contact)
    {
        CacheHelper::forgetCache($this->contactCacheKey);
    }

    /**
     * Handle the Contact "force deleted" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function forceDeleted(Contact $contact)
    {
        CacheHelper::forgetCache($this->contactCacheKey);
    }
}
