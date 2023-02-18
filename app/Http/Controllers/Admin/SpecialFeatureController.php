<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSpecialFeatureRequest;
use App\Http\Requests\UpdateSpecialFeatureRequest;
use App\Http\Resources\SpecialFeatureResources;
use App\Models\SpecialFeature;
use App\Enums\Status;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\InertiaApplicationController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SpecialFeatureController extends InertiaApplicationController
{
    /**
    * Filter role and permission
    */
    public function __construct()
    {
        $this->middleware('permission:options.view|options.create|options.edit|options.delete|options.status', ['only' => ['index', 'store']]);
        $this->middleware('permission:options.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:options.edit|permission:options.status|', ['only' => ['edit', 'update']]);
        $this->middleware('permission:options.delete', ['only' => ['destroy']]);
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

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $specialFeatureCacheKey = CacheHelper::getSpecialFeatureCacheKey();

        $user  = auth()->user();
        $key =  $specialFeatureCacheKey.md5(serialize([$orderBy, $order, $status, $page, $search, $startDate, $endDate,  ]));

        $specialFeatures = Cache::tags([$specialFeatureCacheKey, $user->token])->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $status,
            $search,
            $startDate,
            $endDate,
            $user,
        ) {
            $specialFeatures = SpecialFeature::with(['images']);

            if (! $user->haveAdministrativeRole()) {
                $specialFeatures->where('user_id', $user->id);
            }

            if (! empty($status)) {
                $specialFeatures->where('status', $status);
            }

            if (! empty($search)) {
                $specialFeatures->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $specialFeatures->where('created_at', '>=', new \DateTime($startDate));
                $specialFeatures->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $specialFeatures->orderBy($orderBy, $order);
            }

            return $specialFeatures->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/SpecialFeature/Index')->with(['specialFeatures' => SpecialFeatureResources::collection($specialFeatures)]);
    }

    /**
     * Summary of create
     * @param Request $request
     * @return \Inertia\Response
     */
    public function create()
    {
        $statusArr = Status::values();

        return Inertia::render('Dashboard/SpecialFeature/Create', ['statusArr' => $statusArr]);
    }

    /**
     * Summary of store
     * @param Request $request
     * @param StoreSpecialFeatureRequest $storeProductRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSpecialFeatureRequest $request)
    {
        $data = $request->only('title', 'description', 'status');

        try {
            $specialFeature = SpecialFeature::create($data);

            $specialFeature->images()->sync(array_column($request->get('images'), 'id'));

            if ($specialFeature) {
                $specialFeature->images()->attach(array_column($request->get('images'), 'id'));
            }

            return Redirect::route('admin.special-feature.index')->with(['success' => true, 'message', 'Created successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

      /**
       * Summary of show
       * @param Request $request
       * @param SpecialFeature $specialFeature
       * @return \Inertia\Response
       */
      public function show(SpecialFeature $specialFeature)
      {
          return Inertia::render('Dashboard/SpecialFeature/Show')->with(['specialFeature' => new SpecialFeatureResources($specialFeature->load('images'))]);
      }

    /**
     * Summary of edit
     * @param SpecialFeature $specialFeature
     * @return \Inertia\Response
     */
    public function edit(SpecialFeature $specialFeature)
    {
        $statusArr = Status::values();

        return Inertia::render('Dashboard/SpecialFeature/Edit', ['specialFeature' => $specialFeature->load('images'), 'statusArr' => $statusArr]);
    }

    /**
     * Summary of update
     * @param UpdateSpecialFeatureRequest $request
     * @param SpecialFeature $specialFeature
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSpecialFeatureRequest $request, SpecialFeature $specialFeature)
    {
        try {
            $specialFeature->update($request->only('title', 'description', 'status'));

            $specialFeature->images()->sync(array_column($request->get('images'), 'id'));

            if (session('last_visited_url')) {
                return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Updated successfull']);
            }

            return Redirect::route('admin.special-feature.index')->with(['success' => true, 'message', 'Updated successfull']);
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

    /**
     * Summary of destroy
     * @param SpecialFeature $specialFeature
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SpecialFeature $specialFeature)
    {
        $specialFeature->delete();

        $specialFeature->images()->detach();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
