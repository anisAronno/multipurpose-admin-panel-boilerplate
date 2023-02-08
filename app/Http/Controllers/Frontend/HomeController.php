<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\SpecialFeature;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
    /**
     * Summary of index
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $key = CacheServices::getFeaturedProductCacheKey();
        $featuredCatKey = CacheServices::getFeaturedCategoryCacheKey();
        $featuredBlogKey = CacheServices::getFeaturedBlogCacheKey();
        $specialFeatureKey = CacheServices::getSpecialFeatureCacheKey();

        $featuredProducts = Cache::remember($key, 10, function () {
            return Product::isActive()->isFeatured()->orderBy('id', 'desc')->limit(8)->get();
        });

        $featuredCategory = Cache::remember($featuredCatKey, 10, function () {
            return Category::whereHas('products', function ($query) {
                $query->where('categoryable_type', Product::class);
            })->isActive()->isFeatured()->orderBy('id', 'desc')->limit(3)->get();
        });

        $featuredBlog = Cache::remember($featuredBlogKey, 10, function () {
            return Blog::isActive()->isFeatured()->with(['categories'])->orderBy('id', 'desc')->with('user')->limit(3)->get();
        });

        $specialFeatures = Cache::remember($specialFeatureKey, 10, function () {
            return SpecialFeature::isActive()->orderBy('id', 'desc')->limit(4)->get();
        });

        return Inertia::render('Frontend/Home/Index')->with(['featuredProducts' => $featuredProducts, 'featuredCategory'=>$featuredCategory, 'featuredBlog'=>$featuredBlog, 'specialFeatures' => $specialFeatures]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
