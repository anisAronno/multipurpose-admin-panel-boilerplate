<?php

namespace App\Observers\Blog;

use App\Models\Blog;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class BlogObserver
{
    use ClearCache;

    protected $key = '';
    public function __construct()
    {
        $this->key = CacheServices::getBlogCacheKey();
    }
    /**
     * Handle the Blog "created" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the Blog "restored" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        $this->clearCache($this->key);
    }

    /**
     * Handle the Blog "force deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        $this->clearCache($this->key);
    }
}
