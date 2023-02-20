<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResources;
use App\Models\Category;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
    * Summary of index
    * @return \Inertia\Response
    */
    public function index(Request $request)
    {
        $categoryCacheKey = CacheHelper::getCategoryCacheKey();

        $page       = $request->get('page', 1);

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);

        $orderBy    = in_array($request->get('orderBy'), ['created_at']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';

        $isFeatured = $request->get('is_featured') ? $request->is_featured : '';


        $key =  $categoryCacheKey.md5(serialize([$orderBy, $order,  $isFeatured, $page, $search, $startDate, $endDate]));

        $categories = Cache::tags([$categoryCacheKey ])->remember($key, 10, function () use (
            $orderBy,
            $order,
            $isFeatured,
            $search,
            $startDate,
            $endDate,
        ) {
            $categories = Category::whereHas('blogs')->orWhereHas('products')->with('image')->isActive();

            if (! empty($isFeatured)) {
                $categories->where('is_featured', $isFeatured);
            }

            if (! empty($search)) {
                $categories->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $categories->where('created_at', '>=', new \DateTime($startDate));
                $categories->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $categories->orderBy($orderBy, $order);
            }

            return $categories->paginate(12);
        });

        return Inertia::render('Frontend/Category/Index')->with(['categories' => CategoryResources::collection($categories)]);
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


        $category->load(['blogs' => function ($query) {
            $query->isActive();
        }, 'products' => function ($query) {
            $query->isActive();
        }])->isActive();

        $category->load([ 'image', 'blogs.image', 'products.image']);

        return Inertia::render('Frontend/Category/Show')->with(['category' => new CategoryResources($category)]);
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
