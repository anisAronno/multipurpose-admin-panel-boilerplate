<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Status;
use App\Enums\Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Helpers\CacheHelper;
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
        $orderBy    = in_array($request->get('orderBy'), ['date']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
        $status     = in_array($request->get('status'), Status::values()) ? $request->status : '';
        $type     = in_array($request->get('type'), Type::values()) ? $request->type : '';

        $isFeatured = $request->get('is_featured') ? $request->is_featured : '';
        $is_commentable = $request->get('is_commentable') ? $request->is_commentable : '';
        $is_reactable = $request->get('is_reactable') ? $request->is_reactable : '';
        $is_shareable = $request->get('is_shareable') ? $request->is_shareable : '';
        $show_ratings = $request->get('show_ratings') ? $request->show_ratings : '';
        $show_views = $request->get('show_views') ? $request->show_views : '';

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $productCacheKey = CacheHelper::getProductCacheKey();

        $key =  $productCacheKey.md5(serialize([$orderBy, $order, $status, $isFeatured, $page, $search, $startDate, $endDate, $is_commentable, $is_reactable, $is_shareable, $show_ratings, $show_views, $type]));

        $products = Cache::tags([$productCacheKey ])->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $status,
            $isFeatured,
            $search,
            $startDate,
            $endDate,
            $is_commentable,
            $is_reactable,
            $is_shareable,
            $show_ratings,
            $show_views,
            $type,
        ) {
            $products = Product::with(['categories', 'image'])->isActive();

            if (! empty($status)) {
                $products->where('status', $status);
            }

            if (! empty($isFeatured)) {
                $products->where('is_featured', $isFeatured);
            }

            if (! empty($type)) {
                $products->where('type', $type);
            }

            if (! empty($is_commentable)) {
                $products->where('is_commentable', $is_commentable);
            }

            if (! empty($is_reactable)) {
                $products->where('is_reactable', $is_reactable);
            }

            if (! empty($is_shareable)) {
                $products->where('is_shareable', $is_shareable);
            }

            if (! empty($show_ratings)) {
                $products->where('show_ratings', $show_ratings);
            }

            if (! empty($show_views)) {
                $products->where('show_views', $show_views);
            }

            if (! empty($search)) {
                $products->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $products->where('created_at', '>=', new \DateTime($startDate));
                $products->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $products->orderBy($orderBy, $order);
            }

            return $products->paginate(12);
        });


        return Inertia::render('Frontend/Products/Index')->with(['products' => ProductResource::collection($products)]);
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

        $featuredProducts = Cache::tags([$featuredProductKey])->remember($featuredProductKey, 10, function () {
            return Product::isActive()->isFeatured()
            ->with(['image'])
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
        });


        return Inertia::render('Frontend/Products/Show')->with(['product' => new ProductResource($product->load('image')), 'featuredProducts'=> ProductResource::collection($featuredProducts)]);
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
