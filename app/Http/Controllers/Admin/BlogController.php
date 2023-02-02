<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Enums\Status;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Helpers\FileHelpers;
use App\Http\Controllers\InertiaApplicationController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BlogController extends InertiaApplicationController
{
    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheServices::getBlogCacheKey($currentPage);

        if (! empty($request->search)) {
            $q = $request->search;
            $blogs = Blog::where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/Blog/Index', ['blogs' => $blogs]);
        }

        $blogs = Cache::remember($key, 10, function () {
            return Blog::orderBy('id', 'desc')->paginate(10);
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
        $statusArr = Status::values();
        return Inertia::render('Dashboard/Blog/Create', ['statusArr' => $statusArr]);
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

        if ($request->image) {
            $data['image'] = FileHelpers::upload($request, 'image', 'blogs');
        }

        try {
            Blog::create($data);
            return Redirect::route('admin.category.index')->with(['success' => true, 'message', 'Created successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

      /**
       * Summary of show
       * @param Request $request
       * @param Blog $category
       * @return \Inertia\Response
       */
      public function show(Request $request, Blog $category)
      {
          return Inertia::render('Dashboard/Blog/Show')->with(['category' => $category]);
      }

    /**
     * Summary of edit
     * @param Blog $category
     * @return \Inertia\Response
     */
    public function edit(Blog $category)
    {
        $statusArr = Status::values();

        return Inertia::render('Dashboard/Blog/Edit', ['category' => $category, 'statusArr' => $statusArr]);
    }

    /**
     * Summary of update
     * @param UpdateBlogRequest $request
     * @param Blog $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBlogRequest $request, Blog $category)
    {
        try {
            $category->update($request->only('title', 'description', 'is_featured', 'status'));

            if (session('last_visited_blog_url')) {
                return Redirect::to(session('last_visited_blog_url'))->with(['success' => true, 'message', 'Updated successfull']);
            }

            return Redirect::route('admin.category.index')->with(['success' => true, 'message', 'Updated successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

    /**
     * Summary of destroy
     * @param Blog $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $category)
    {
        if ($category->image) {
            FileHelpers::deleteFile($category->image);
        }

        $category->delete();

        if (session('last_visited_blog_url')) {
            return Redirect::to(session('last_visited_blog_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }

    public function imageUpdate(Request $request, Blog $category)
    {
        if ($request->image) {
            $path = FileHelpers::upload($request, 'image', 'blogs');
            if (! $path) {
                return $this->failedWithMessage('Update Failed');
            } else {
                FileHelpers::deleteFile($category->image);
                $category->update(['image' => $path]);
            }
        }

        return $this->successWithMessage('Successfully Updated');
    }

    public function imageDelete(Blog $category)
    {
        FileHelpers::deleteFile($category->image);

        $category->update([$category->image = null]);

        return $this->successWithMessage('Deleted successfull');
    }
}
