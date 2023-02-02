<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Enums\Status;
use App\Enums\Featured;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Helpers\FileHelpers;
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
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheServices::getProductCacheKey($currentPage);


        if (! empty($request->search)) {
            $q = $request->search;
            $products = Product::with(['categories'])->where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/Products/Index', ['products' => $products]);
        }


        $products = Cache::remember($key, 10, function () {
            return Product::with('categories')->orderBy('id', 'desc')->paginate(10);
        });


        Session::put('last_visited_product_url', $request->fullUrl());


        return Inertia::render('Dashboard/Products/Index')->with(['products' => $products]);
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
        $featuredArr = Featured::values();

        return Inertia::render('Dashboard/Products/Create', ['categories' => $categories, 'statusArr' => $statusArr, 'featuredArr'=>$featuredArr]);
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

        if ($request->image) {
            $data['image'] = FileHelpers::upload($request, 'image', 'products');
        }

        $product = Product::create($data);

        if ($product) {
            $product->categories()->attach($request->get('categories'));
        }

        return Redirect::route('admin.product.index')->with(['success' => true, 'message', 'Created successfull']);
    }

      /**
       * Summary of show
       * @param Request $request
       * @param Product $product
       * @return \Inertia\Response
       */
      public function show( Product $product)
      {
          $product->load(['categories']);

          return Inertia::render('Dashboard/Products/Show')->with(['product' => $product]);
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
        $featuredArr = Featured::values();

        $categories = Category::select('id as value', 'title as label')->get();


        return Inertia::render('Dashboard/Products/Edit', ['product' => $product, 'statusArr' => $statusArr, 'categories' => $categories, 'featuredArr'=>$featuredArr]);
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
        }

        if (session('last_visited_product_url')) {
            return Redirect::to(session('last_visited_product_url'))->with(['success' => true, 'message', 'Updated successfull']);
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
        if ($product->image) {
            FileHelpers::deleteFile($product->image);
        }

        $product->delete();

        if (session('last_visited_product_url')) {
            return Redirect::to(session('last_visited_product_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }

       public function imageUpdate(Request $request, Product $product)
       {
           if ($request->image) {
               $path = FileHelpers::upload($request, 'image', 'products');
               if (! $path) {
                   return $this->failedWithMessage('Update Failed');
               } else {
                   FileHelpers::deleteFile($product->image);
                   $product->update(['image' => $path]);
               }
           }

           return $this->successWithMessage('Successfully Updated');
       }

         public function imageDelete(Product $product)
         {
             FileHelpers::deleteFile($product->image);

             $product->update([$product->image = null]);

             return $this->successWithMessage('Deleted successfull');
         }
}
