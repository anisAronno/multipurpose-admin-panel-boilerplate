<?php

namespace App\Observers\Product;

use App\Models\Category;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class CategoryObserver
{
    use ClearCache;

    protected $key = '';
    protected $featureCategory = '';
    public function __construct()
    {
        $this->key = CacheServices::getCategoryCacheKey();
        $this->featureCategory = CacheServices::getFeatureCategoryCacheKey();
    }
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->featureCategory);
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->featureCategory);
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->featureCategory);
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->featureCategory);
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->featureCategory);
    }
}
