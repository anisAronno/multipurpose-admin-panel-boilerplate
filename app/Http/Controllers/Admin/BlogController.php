<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Enums\Status; 
use App\Models\Category;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\InertiaApplicationController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BlogController extends InertiaApplicationController
{
    /**
    * Filter role and permission
    */
    public function __construct()
    {
        $this->middleware('permission:blog.view|blog.create|blog.edit|blog.delete|blog.status', ['only' => ['index', 'store']]);
        $this->middleware('permission:blog.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog.edit|permission:blog.status|', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog.delete', ['only' => ['destroy']]);

        $this->authorizeResource(Blog::class, 'blog');
    }

    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheHelper::getBlogCacheKey();

        if (! empty($request->search)) {
            $q = $request->search;
            $blogs = Blog::with(['categories', 'images'])->where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/Blog/Index', ['blogs' => $blogs]);
        }

        $blogs = Cache::remember($key, 10, function () {
            return Blog::with(['categories', 'images'])->orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_blog_url', $request->fullUrl());

        return Inertia::render('Dashboard/Blog/Index')->with(['blogs' => $blogs]);
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

        return Inertia::render('Dashboard/Blog/Create', ['categories' => $categories, 'statusArr' => $statusArr]);
    }

    /**
     * Summary of store
     * @param Request $request
     * @param StoreBlogRequest $storeProductRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->only('title', 'description', 'is_featured', 'status');
        $data['user_id'] = auth()->user()->id ;

        try {
            $blog = Blog::create($data);

            if ($blog) {
                $blog->categories()->attach($request->get('categories'));
                $blog->images()->attach(array_column($request->get('images'), 'id'));
            }

            return Redirect::route('admin.blog.index')->with(['success' => true, 'message', 'Created successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

      /**
       * Summary of show
       * @param Request $request
       * @param Blog $blog
       * @return \Inertia\Response
       */
    public function show(Blog $blog)
    {
        $blog->load(['categories', 'images']);

        return Inertia::render('Dashboard/Blog/Show')->with(['blog' => $blog]);
    }

    /**
     * Summary of edit
     * @param Blog $blog
     * @return \Inertia\Response
     */
    public function edit(Blog $blog)
    {
        $blog->load(['images', 'categories']);

        $blog->categoryArr = $blog->categories->map(function ($item, $key) {
            return $item->id;
        });

        $statusArr = Status::values(); 

        $categories = Category::select('id as value', 'title as label')->get();

        return Inertia::render('Dashboard/Blog/Edit', ['blog' => $blog, 'statusArr' => $statusArr, 'categories' => $categories]);
    }

    /**
     * Summary of update
     * @param UpdateBlogRequest $request
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        try {
            $blog->update($request->only('title', 'description', 'is_featured', 'status'));

            if ($request->categories) {
                $blog->categories()->sync($request->categories);
                $blog->images()->sync(array_column($request->get('images'), 'id'));
            }

            if (session('last_visited_blog_url')) {
                return Redirect::to(session('last_visited_blog_url'))->with(['success' => true, 'message', 'Updated successfull']);
            }

            return Redirect::route('admin.blog.index')->with(['success' => true, 'message', 'Updated successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

    /**
     * Summary of destroy
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        if (session('last_visited_blog_url')) {
            return Redirect::to(session('last_visited_blog_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
