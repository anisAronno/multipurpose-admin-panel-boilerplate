<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResources;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SpecialFeatureResources;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\SpecialFeature;
use App\Helpers\CacheHelper;
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
        $featuredProductKey = CacheHelper::getFeaturedProductCacheKey();
        $featuredCatKey = CacheHelper::getFeaturedCategoryCacheKey();
        $featuredBlogKey = CacheHelper::getFeaturedBlogCacheKey();
        $specialFeatureKey = CacheHelper::getSpecialFeatureCacheKey();

        $featuredProducts = Cache::tags([$featuredProductKey])->remember($featuredProductKey, now()->addDay(), function () {
            return Product::isActive()->isFeatured()
            ->with(['image'])
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
        });

        $featuredCategory = Cache::tags([$featuredCatKey])->remember($featuredCatKey, now()->addDay(), function () {
            return Category::whereHas('products', function ($query) {
                $query->where('categoryable_type', Product::class);
            })->isActive()->isFeatured()
            ->with(['image'])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();
        });

        $featuredBlog = Cache::tags([$featuredBlogKey])->remember($featuredBlogKey, now()->addDay(), function () {
            return Blog::isActive()->isFeatured()
            ->with(['categories', 'image', 'user'])
            ->orderBy('id', 'desc')->limit(3)->get();
        });

        $specialFeatures = Cache::tags([$specialFeatureKey])->remember($specialFeatureKey, now()->addDay(), function () {
            return SpecialFeature::isActive()
            ->with(['image'])
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        });

        return Inertia::render('Frontend/Home/Index')->with(['featuredProducts' => ProductResource::collection($featuredProducts), 'featuredCategory'=> ProductResource::collection($featuredCategory), 'featuredBlog'=> BlogResources::collection($featuredBlog), 'specialFeatures' => SpecialFeatureResources::collection($specialFeatures)]);
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
