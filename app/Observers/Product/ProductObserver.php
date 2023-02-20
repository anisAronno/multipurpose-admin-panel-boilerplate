<?php

namespace App\Observers\Product;

use App\Models\Product;
use App\Helpers\CacheHelper; 

class ProductObserver
{ 

    protected $key = '';
    protected $feturedProductKey = '';
    public function __construct()
    {
        $this->key = CacheHelper::getProductCacheKey();
        $this->feturedProductKey = CacheHelper::getFeaturedProductCacheKey();
    }
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->feturedProductKey);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->feturedProductKey);
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->feturedProductKey);
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->feturedProductKey);
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        CacheHelper::forgetCache($this->key);
        CacheHelper::forgetCache($this->feturedProductKey);
    }
}
