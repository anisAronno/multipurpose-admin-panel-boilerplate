<?php

namespace App\Observers;

use App\Models\Tag;
use App\Helpers\CacheHelper;

class TagObserver
{
    protected $tagCacheKey = '';
    public function __construct()
    {
        $this->tagCacheKey = CacheHelper::getTagCacheKey();
    }
    /**
     * Handle the Tag "created" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {
        CacheHelper::forgetCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "updated" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updated(Tag $tag)
    {
        CacheHelper::forgetCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleted(Tag $tag)
    {
        CacheHelper::forgetCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "restored" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function restored(Tag $tag)
    {
        CacheHelper::forgetCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "force deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function forceDeleted(Tag $tag)
    {
        CacheHelper::forgetCache($this->tagCacheKey);
    }
}
