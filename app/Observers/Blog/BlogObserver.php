<?php

namespace App\Observers\Blog;

use App\Helpers\CacheHelper;
use App\Models\Blog;

class BlogObserver
{
    protected $key = '';
    protected $featuredBlogKey = '';
    public function __construct()
    {
        $this->key = CacheHelper::getBlogCacheKey();
        $this->featuredBlogKey = CacheHelper::getFeaturedBlogCacheKey();
    }
    /**
     * Handle the Blog "created" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredBlogKey);
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredBlogKey);
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredBlogKey);
    }

    /**
     * Handle the Blog "restored" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredBlogKey);
    }

    /**
     * Handle the Blog "force deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredBlogKey);
    }
}
