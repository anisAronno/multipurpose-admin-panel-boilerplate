<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Format;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResources;
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
        $orderBy    = in_array($request->get('orderBy'), ['date']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
        $status     = in_array($request->get('status'), Status::values()) ? $request->status : '';
        $format     = in_array($request->get('format'), Format::values()) ? $request->format : '';
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
        $blogCacheKey = CacheHelper::getBlogCacheKey();

        $user  = auth()->user();
        $key =  $blogCacheKey.md5(serialize([$orderBy, $order, $status, $isFeatured, $page, $search, $startDate, $endDate, $is_commentable, $is_reactable, $is_shareable, $show_ratings, $show_views, $format]));

        $blogs = Cache::tags([$blogCacheKey, $user->token])->remember($key, now()->addDay(), function () use (
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
            $format,
        ) {
            $blogs = Blog::with(['categories', 'images', 'user']);

            if (! $user->haveAdministrativeRole()) {
                $blogs->where('user_id', $user->id);
            }

            if (! empty($status)) {
                $blogs->where('status', $status);
            }

            if (! empty($isFeatured)) {
                $blogs->where('is_featured', $isFeatured);
            }

            if (! empty($format)) {
                $blogs->where('format', $format);
            }

            if (! empty($is_commentable)) {
                $blogs->where('is_commentable', $is_commentable);
            }

            if (! empty($is_reactable)) {
                $blogs->where('is_reactable', $is_reactable);
            }

            if (! empty($is_shareable)) {
                $blogs->where('is_shareable', $is_shareable);
            }

            if (! empty($show_ratings)) {
                $blogs->where('show_ratings', $show_ratings);
            }

            if (! empty($show_views)) {
                $blogs->where('show_views', $show_views);
            }

            if (! empty($search)) {
                $blogs->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $blogs->where('created_at', '>=', new \DateTime($startDate));
                $blogs->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $blogs->orderBy($orderBy, $order);
            }

            return $blogs->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/Blog/Index')->with(['blogs' => BlogResources::collection($blogs)]);
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
        $formateArr = Format::values();

        return Inertia::render('Dashboard/Blog/Create', ['categories' => $categories, 'statusArr' => $statusArr,'formateArr' => $formateArr,]);
    }

    /**
     * Summary of store
     * @param Request $request
     * @param StoreBlogRequest $StoreBlogRequest
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

        $formateArr = Format::values();

        $categories = Category::select('id as value', 'title as label')->get();

        return Inertia::render('Dashboard/Blog/Edit', ['blog' => $blog, 'statusArr' => $statusArr,  'formateArr' => $formateArr, 'categories' => $categories]);
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

            if (session('last_visited_url')) {
                return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Updated successfull']);
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

        $blog->images()->detach();
        $blog->categories()->detach();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
