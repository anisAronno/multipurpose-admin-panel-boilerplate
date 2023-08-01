<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
    * Summary of index
    * @return \Inertia\Response
    */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheServices::getBlogCacheKey();
        $cacheKey =  $key.md5(serialize([$currentPage]));

        $blogs = Cache::remember($cacheKey, 10, function () {
            return Blog::isActive()->isFeatured()->orderBy('id', 'desc')->with('user')->paginate(9);
        });

        return Inertia::render('Frontend/Blog/Index')->with(['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        //
    }

    /**
     * Summary of show
     * @param Blog $blog
     * @return \Inertia\Response
     */
    public function show(Blog $blog)
    {
        if (! $blog->isActive()) {
            abort(403);
        }
        return Inertia::render('Frontend/Blog/Show')->with(['blog' => $blog->load('user')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
