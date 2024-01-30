<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Format;
use App\Helpers\CacheHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResources;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
    * Summary of index
    * @return \Inertia\Response
    */
    public function index(Request $request)
    {
        $orderBy    = in_array($request->get('orderBy'), ['created_at']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
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

        $key =  $blogCacheKey.md5(serialize([$orderBy, $order,  $isFeatured, $page, $search, $startDate, $endDate, $is_commentable, $is_reactable, $is_shareable, $show_ratings, $show_views, $format]));

        $blogs = CacheHelper::init($blogCacheKey)->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $isFeatured,
            $search,
            $startDate,
            $endDate,
            $is_commentable,
            $is_reactable,
            $is_shareable,
            $show_ratings,
            $show_views,
            $format,
        ) {
            $blogs = Blog::with(['user', 'featuredMedia'])->isActive();

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

            return $blogs->paginate(12);
        });


        return Inertia::render('Frontend/Blog/Index')->with(['blogs' => BlogResources::collection($blogs)]);
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
        return Inertia::render('Frontend/Blog/Show')->with(['blog' => new BlogResources($blog->load('user', 'featuredMedia'))]);
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
