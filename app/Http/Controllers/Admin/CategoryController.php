<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Helpers\CacheHelper;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResources;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
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
        $orderBy    = in_array($request->get('orderBy'), ['created_at']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
        $status     = in_array($request->get('status'), Status::values()) ? $request->status : '';
        $isFeatured = $request->get('is_featured') ? $request->is_featured : '';

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $categoryCacheKey = CacheHelper::getCategoryCacheKey();

        /** @var User $user */
        $user  = auth()->user();
        $key =  $categoryCacheKey.md5(serialize([$orderBy, $order, $status, $isFeatured, $page, $search, $startDate, $endDate,  ]));

        $categories = CacheHelper::init($categoryCacheKey)->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $status,
            $isFeatured,
            $search,
            $startDate,
            $endDate,
            $user,
        ) {
            $categories = Category::with([ 'media']);

            if (! $user->haveAdministrativeRole()) {
                $categories->where('user_id', $user->id);
            }

            if (! empty($status)) {
                $categories->where('status', $status);
            }

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

            return $categories->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/Category/Index')->with(['categories' => CategoryResources::collection($categories)]);
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

        try {
            $category = Category::create($data);

            if ($category) {
                if ($request->has('featuredMedia')) {
                    $category->media()->attach(array_column($request->get('featuredMedia'), 'id'), ['is_featured' => 1]);
                }

                if ($request->has('media')) {
                    $category->media()->attach(array_column($request->get('media'), 'id'));
                }
            }

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
        $category->load(['media']);

        return Inertia::render('Dashboard/Category/Show')->with(['category' => $category->load(['media'])]);
    }

    /**
     * Summary of edit
     * @param Category $category
     * @return \Inertia\Response
     */
    public function edit(Category $category)
    {
        $category->load(['media']);

        $statusArr = Status::values();

        return Inertia::render('Dashboard/Category/Edit', ['category' => $category->load(['media']), 'statusArr' => $statusArr]);
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

            $category->media()->sync(array_column($request->get('media'), 'id'));

            if (session('last_visited_url')) {
                return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Updated successfull']);
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
        $category->delete();
        $category->media()->detach();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
