<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Enums\Status; 
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\InertiaApplicationController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends InertiaApplicationController
{
    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $orderBy    = in_array($request->get('orderBy'), ['date']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
        $status     = in_array($request->get('status'), Status::values()) ? $request->status : '';
        $isFeatured = $request->get('is_featured') ? $request->is_featured : '';

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $productCacheKey = CacheHelper::getProductCacheKey();

        $key =  $productCacheKey.md5(serialize([$orderBy, $order, $status, $isFeatured, $page, $search, $startDate, $endDate]));

        $products = Cache::tags([$productCacheKey])->remember($key, now()->addDay(), function () use ($orderBy, $order, $status, $isFeatured, $search, $startDate, $endDate) {
            $products = Product::with(['categories', 'images', 'user']);

            if (! empty($status)) {
                $products->where('status', $status);
            }

            if (! empty($isFeatured)) {
                $products->where('is_featured', $isFeatured);
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

            return $products->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/Products/Index')->with(['products' => ProductResource::collection($products)]);
    }

    /**
     * Summary of create
     * @param Request $request
     * @return \Inertia\Response
     */
    public function create()
    {
        $categories = Category::select('id as value', 'title as label')->get();

        $statusArr = Status::values();

        return Inertia::render('Dashboard/Products/Create', ['categories' => $categories, 'statusArr' => $statusArr]);
    }

    /**
     * Summary of store
     * @param Request $request
     * @param StoreProductRequest $storeProductRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, StoreProductRequest $storeProductRequest)
    {
        $data = $request->only('title', 'description', 'is_featured', 'status');
        $data['user_id'] = auth()->user()->id ;

        try {
            $product = Product::create($data);

            if ($request->has('categories')) {
                $product->categories()->attach($request->get('categories'));
            }

            if ($request->has('images')) {
                $product->categories()->attach($request->get('categories'));
                $product->images()->attach(array_column($request->get('images'), 'id'));
            }
            return Redirect::route('admin.product.index')->with(['success' => true, 'message', 'Created successfully']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

      /**
       * Summary of show
       * @param Request $request
       * @param Product $product
       * @return \Inertia\Response
       */
      public function show(Product $product)
      {
          $product->load(['categories', 'images']);

          return Inertia::render('Dashboard/Products/Show')->with(['product' => new ProductResource($product)]);
      }

    /**
     * Summary of edit
     * @param Product $product
     * @return \Inertia\Response
     */
    public function edit(Product $product)
    {
        $product->categoryArr = $product->categories->map(function ($item, $key) {
            return $item->id;
        });

        $statusArr = Status::values();

        $categories = Category::select('id as value', 'title as label') ->get();

        return Inertia::render('Dashboard/Products/Edit', ['product' => $product->load(['images']), 'statusArr' => $statusArr, 'categories' => $categories]);
    }

    /**
     * Summary of update
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->only('title', 'description', 'is_featured', 'status'));

        if ($request->categories) {
            $product->categories()->sync($request->categories);
            $product->images()->sync(array_column($request->get('images'), 'id'));
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Updated successfull']);
        }

        return Redirect::route('admin.product.index')->with(['success' => true, 'message', 'Updated successfull']);
    }

    /**
     * Summary of destroy
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
