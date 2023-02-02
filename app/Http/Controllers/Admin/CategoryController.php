<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Enums\Status;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Helpers\FileHelpers;
use App\Http\Controllers\InertiaApplicationController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends InertiaApplicationController
{
    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheServices::getCategoryCacheKey($currentPage);

        if (! empty($request->search)) {
            $q = $request->search;
            $categories = Category::where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/Category/Index', ['categories' => $categories]);
        }

        $categories = Cache::remember($key, 10, function () {
            return Category::orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_category_url', $request->fullUrl());

        return Inertia::render('Dashboard/Category/Index')->with(['categories' => $categories]);
    }

    /**
     * Summary of create
     * @param Request $request
     * @return \Inertia\Response
     */
    public function create()
    {
        $statusArr = Status::values();
        return Inertia::render('Dashboard/Category/Create', ['statusArr' => $statusArr]);
    }

    /**
     * Summary of store
     * @param Request $request
     * @param StoreCategoryRequest $storeProductRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only('title', 'description', 'is_featured', 'status');
        $data['user_id'] = auth()->user()->id ;

        if ($request->image) {
            $data['image'] = FileHelpers::upload($request, 'image', 'categories');
        }

        try {
            Category::create($data);
            return Redirect::route('admin.category.index')->with(['success' => true, 'message', 'Created successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

      /**
       * Summary of show
       * @param Request $request
       * @param Category $category
       * @return \Inertia\Response
       */
      public function show(Request $request, Category $category)
      {
          return Inertia::render('Dashboard/Category/Show')->with(['category' => $category]);
      }

    /**
     * Summary of edit
     * @param Category $category
     * @return \Inertia\Response
     */
    public function edit(Category $category)
    {
        $statusArr = Status::values();

        return Inertia::render('Dashboard/Category/Edit', ['category' => $category, 'statusArr' => $statusArr]);
    }

    /**
     * Summary of update
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->only('title', 'description', 'is_featured', 'status'));

            if (session('last_visited_category_url')) {
                return Redirect::to(session('last_visited_category_url'))->with(['success' => true, 'message', 'Updated successfull']);
            }

            return Redirect::route('admin.category.index')->with(['success' => true, 'message', 'Updated successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

    /**
     * Summary of destroy
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            FileHelpers::deleteFile($category->image);
        }

        $category->delete();

        if (session('last_visited_category_url')) {
            return Redirect::to(session('last_visited_category_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }

    public function imageUpdate(Request $request, Category $category)
    {
        if ($request->image) {
            $path = FileHelpers::upload($request, 'image', 'categories');
            if (! $path) {
                return $this->failedWithMessage('Update Failed');
            } else {
                FileHelpers::deleteFile($category->image);
                $category->update(['image' => $path]);
            }
        }

        return $this->successWithMessage('Successfully Updated');
    }

    public function imageDelete(Category $category)
    {
        FileHelpers::deleteFile($category->image);

        $category->update([$category->image = null]);

        return $this->successWithMessage('Deleted successfull');
    }
}
