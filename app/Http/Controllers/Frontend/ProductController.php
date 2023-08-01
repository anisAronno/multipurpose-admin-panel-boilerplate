<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\CacheHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Summary of index
     * @return \Inertia\Response
     */

    public function index(Request $request)
    {
        $orderBy   = in_array($request->get('orderBy'), ['created_at']) ? $request->orderBy : 'created_at';
        $order     = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
        $search    = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $category  = $request->get('category', '');
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheHelper::getProductCacheKey();

        $cacheKey =  $key.md5(serialize([$orderBy, $order, $search, $startDate, $endDate, $currentPage, $category]));

        $products = CacheHelper::init($key)->remember($cacheKey, now()->addDay(), function () use (
            $orderBy,
            $order,
            $search,
            $startDate,
            $endDate,
            $category
        ) {
            $product = Product::with(['categories']);
            $categoryModel = new Category();


            if (!empty($search)) {
                $product->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%');
            }

            if (!empty($category)) {
                $catArr = $categoryModel->where('slug', $category)->pluck('id');
                if (count($catArr) > 0) {
                    $product->whereHas('categories', function ($query) use ($catArr) {
                        $query->whereIn('category_id', $catArr)->isActive();
                    });
                }
            }

            if (!empty($startDate) && !empty($endDate)) {
                $product->where('created_at', '>=', new \DateTime($startDate))
                        ->where('created_at', '<=', new \DateTime($endDate));
            }

            if (!empty($orderBy)) {
                $product->orderBy($orderBy, $order);
            }

            $products = $product->paginate(12)->withQueryString();

            $categories = $categoryModel->productTree()->take(20);

            return [
                'products' => $products,
                'categories' => $categories,
            ];
        });

        return Inertia::render('Frontend/Products/Index')->with($products);
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

        $featuredProductKey = CacheHelper::getFeaturedProductCacheKey();

        $featuredProducts = CacheHelper::init($featuredProductKey)->remember($featuredProductKey, 10, function () {
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
