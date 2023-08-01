<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
    * Summary of index
    * @return \Inertia\Response
    */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheServices::getCategoryCacheKey();
        $cacheKey =  $key.md5(serialize([$currentPage]));

        $categories = Cache::remember($cacheKey, 10, function () {
            return Category::whereHas('blogs')->orWhereHas('products')->isActive()->isFeatured()->orderBy('id', 'desc')->paginate(9);
        });

        return Inertia::render('Frontend/Category/Index')->with(['categories' => $categories]);
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Summary of show
     * @param Category $category
     * @return \Inertia\Response
     */
    public function show(Category $category)
    {
        if (! $category->isActive()) {
            abort(403);
        }

        $category->load(['blogs', 'products']);

        $category->load(['blogs' => function ($query) {
            $query->isActive();
        }, 'products' => function ($query) {
            $query->isActive();
        }])->isActive();


        return Inertia::render('Frontend/Category/Show')->with(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

}
