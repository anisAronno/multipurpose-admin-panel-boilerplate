<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSpecialFeatureRequest;
use App\Http\Requests\UpdateSpecialFeatureRequest;
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
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheHelper::getSpecialFeatureCacheKey($currentPage);

        if (! empty($request->search)) {
            $q = $request->search;
            $specialFeatures = SpecialFeature::where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/SpecialFeature/Index', ['specialFeatures' => $specialFeatures]);
        }

        $specialFeatures = Cache::remember($key, 10, function () {
            return SpecialFeature::orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_special_feature_url', $request->fullUrl());

        return Inertia::render('Dashboard/SpecialFeature/Index')->with(['specialFeatures' => $specialFeatures->load('images')]);
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
          return Inertia::render('Dashboard/SpecialFeature/Show')->with(['specialFeature' => $specialFeature->load('images')]);
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

            if (session('last_visited_special_feature_url')) {
                return Redirect::to(session('last_visited_special_feature_url'))->with(['success' => true, 'message', 'Updated successfull']);
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

        if (session('last_visited_special_feature_url')) {
            return Redirect::to(session('last_visited_special_feature_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }
}
