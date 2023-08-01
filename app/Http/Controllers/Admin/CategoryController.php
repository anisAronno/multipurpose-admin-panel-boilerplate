<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Featured;
use App\Enums\Status;
use App\Helpers\FileHelpers;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CategoryController extends InertiaApplicationController
{
    /**
    * Filter role and permission
    */
    public function __construct()
    {
        $this->middleware('permission:category.view|category.create|category.edit|category.delete|category.status', ['only' => ['index', 'store']]);
        $this->middleware('permission:category.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category.edit|permission:category.status|', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category.delete', ['only' => ['destroy']]);
    }
    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        if (! empty($request->search)) {
            $q = $request->search;
            $categories = Category::where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/Category/Index', ['categories' => $categories]);
        }

        $key = CacheHelper::getCategoryCacheKey();
        $cacheKey =  $key.md5(serialize([$currentPage]));

        $categories = CacheHelper::init($key)->remember($cacheKey, 10, function () {
            return Category::with('parent')->orderBy('id', 'desc')->paginate(10);
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
        $featuredArr = Featured::values();
        $categories = Category::tree(false);

        return Inertia::render('Dashboard/Category/Create', ['statusArr' => $statusArr, 'featuredArr'=>$featuredArr, 'categories' => $categories]);
    }

    /**
     * Summary of store
     * @param Request $request
     * @param StoreCategoryRequest $storeProductRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only('title', 'description', 'is_featured', 'status', 'parent_id');
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
    public function show(Category $category)
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
        $featuredArr = Featured::values();
        $categories = Category::tree(false);

        return Inertia::render('Dashboard/Category/Edit', ['category' => $category, 'statusArr' => $statusArr, 'featuredArr'=>$featuredArr, 'categories' => $categories]);
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
            $category->update($request->only('title', 'description', 'is_featured', 'status', 'parent_id'));

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
