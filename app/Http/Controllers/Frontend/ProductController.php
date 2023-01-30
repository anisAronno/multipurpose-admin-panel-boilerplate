<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Summary of index
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheServices::getProductCacheKey($currentPage);

        $products = Cache::remember($key, 10, function () {
            return Product::isActive()->paginate(16);
        });

        return Inertia::render('Frontend/Products/Index')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Summary of show
     * @param Product $product
     * @return \Inertia\Response
     */
    public function show(Request $request, Product $product)
    {
        $request->validate([
                'slug' => 'string|max:255'
        ]);

        if (! $product->isActive()) {
            abort(403);
        }

        $featuredProductKey = CacheServices::getFeaturedProductCacheKey();

        $featuredProducts = Cache::remember($featuredProductKey, 10, function () {
            return Product::isActive()->isFeatured()->orderBy('id', 'desc')->limit(8)->get();
        });

        return Inertia::render('Frontend/Products/Show')->with(['product' => $product, 'featuredProducts'=> $featuredProducts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
