<?php

namespace App\Observers\Product;

use App\Models\Product;
use App\Services\Cache\CacheServices;
use App\Traits\ClearCache;

class ProductObserver
{
    use ClearCache;

    protected $key = '';
    protected $feturedProductKey = '';
    public function __construct()
    {
        $this->key = CacheServices::getProductCacheKey();
        $this->feturedProductKey = CacheServices::getFeaturedProductCacheKey();
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
        $this->clearCache($this->feturedProductKey);
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
        $this->clearCache($this->feturedProductKey);
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
        $this->clearCache($this->feturedProductKey);
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
        $this->clearCache($this->feturedProductKey);
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
        $this->clearCache($this->feturedProductKey);
    }
}