<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
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

        $featuredArr = Featured::values();

        return Inertia::render('Dashboard/Blog/Create', ['statusArr' => $statusArr, 'featuredArr'=>$featuredArr]);
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
      public function show( Blog $blog)
      {
          return Inertia::render('Dashboard/Blog/Show')->with(['blog' => $blog]);
      }

    /**
     * Summary of edit
     * @param Blog $blog
     * @return \Inertia\Response
     */
    public function edit(Blog $blog)
    {
        $statusArr = Status::values();
        $featuredArr = Featured::values();

        return Inertia::render('Dashboard/Blog/Edit', ['blog' => $blog, 'statusArr' => $statusArr, 'featuredArr'=>$featuredArr]);
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
        if ($blog->image) {
            FileHelpers::deleteFile($blog->image);
        }

        $blog->delete();

        if (session('last_visited_blog_url')) {
            return Redirect::to(session('last_visited_blog_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }

    public function imageUpdate(Request $request, Blog $blog)
    {
        if ($request->image) {
            $path = FileHelpers::upload($request, 'image', 'blogs');
            if (! $path) {
                return $this->failedWithMessage('Update Failed');
            } else {
                FileHelpers::deleteFile($blog->image);
                $blog->update(['image' => $path]);
            }
        }

        return $this->successWithMessage('Successfully Updated');
    }

    public function imageDelete(Blog $blog)
    {
        FileHelpers::deleteFile($blog->image);

        $blog->update([$blog->image = null]);

        return $this->successWithMessage('Deleted successfull');
    }
}
