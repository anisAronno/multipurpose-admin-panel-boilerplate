<?php

namespace App\Observers;

use App\Models\Category;
use App\Helpers\CacheHelper; 

class CategoryObserver
{ 
    protected $key = '';
    protected $featuredCategory = '';
    public function __construct()
    {
        $this->key = CacheHelper::getCategoryCacheKey();
        $this->featuredCategory = CacheHelper::getFeaturedCategoryCacheKey();
    }
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredCategory);
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredCategory);
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredCategory);
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredCategory);
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->featuredCategory);
    }
}
