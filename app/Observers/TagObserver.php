<?php

namespace App\Observers;

use App\Models\Tag;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class TagObserver
{
    use ClearCache;

    protected $tagCacheKey = '';
    public function __construct()
    {
        $this->tagCacheKey = CacheServices::getTagCacheKey();
    }
    /**
     * Handle the Tag "created" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {
        $this->clearCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "updated" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updated(Tag $tag)
    {
        $this->clearCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleted(Tag $tag)
    {
        $this->clearCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "restored" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function restored(Tag $tag)
    {
        $this->clearCache($this->tagCacheKey);
    }

    /**
     * Handle the Tag "force deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function forceDeleted(Tag $tag)
    {
        $this->clearCache($this->tagCacheKey);
    }
}
