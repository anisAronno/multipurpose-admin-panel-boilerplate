<?php

namespace App\Observers\Product;

use App\Models\Product;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class ProductObserver
{
    use ClearCache;

    public $key = '';
    public $fetureProductKey = '';
    public function __construct()
    {
        $this->key = CacheServices::getProductCacheKey();
        $this->fetureProductKey = CacheServices::getFeatureProductCacheKey();
    }
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->fetureProductKey);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->fetureProductKey);
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->fetureProductKey);
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->fetureProductKey);
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $this->clearCache($this->key);
        $this->clearCache($this->fetureProductKey);
    }
}
