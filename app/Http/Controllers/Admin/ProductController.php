<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Type;
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
    * Filter role and permission
    */
    public function __construct()
    {
        $this->middleware('permission:product.view|product.create|product.edit|product.delete|product.status', ['only' => ['index', 'store']]);
        $this->middleware('permission:product.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product.edit|permission:product.status|', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product.delete', ['only' => ['destroy']]);

        $this->authorizeResource(Product::class, 'product');
    }
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

        $user  = auth()->user();
        $key =  $productCacheKey.md5(serialize([$orderBy, $order, $status, $isFeatured, $page, $search, $startDate, $endDate, $is_commentable, $is_reactable, $is_shareable, $show_ratings, $show_views, $type]));

        $products = Cache::tags([$productCacheKey, $user->token])->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $status,
            $isFeatured,
            $search,
            $startDate,
            $endDate,
            $user,
            $is_commentable,
            $is_reactable,
            $is_shareable,
            $show_ratings,
            $show_views,
            $type,
        ) {
            $products = Product::with(['categories', 'images', 'user']);

            if (! $user->haveAdministrativeRole()) {
                $products->where('user_id', $user->id);
            }

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
        $typeArr = Type::values();

        return Inertia::render('Dashboard/Products/Create', ['categories' => $categories, 'statusArr' => $statusArr, '$typeArr' => $typeArr]);
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
        $typeArr = Type::values();

        $categories = Category::select('id as value', 'title as label') ->get();

        return Inertia::render('Dashboard/Products/Edit', ['product' => $product->load(['images']), 'statusArr' => $statusArr, 'categories' => $categories, '$typeArr' => $typeArr]);
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

        $product->images()->detach();
        $product->categories()->detach();


        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
