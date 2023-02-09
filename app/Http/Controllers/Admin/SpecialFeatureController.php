<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSpecialFeatureRequest;
use App\Http\Requests\UpdateSpecialFeatureRequest;
use App\Models\SpecialFeature;
use App\Enums\Status;
use App\Services\Cache\CacheServices;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Helpers\FileHelpers;
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

        $key = CacheServices::getSpecialFeatureCacheKey($currentPage);

        if (! empty($request->search)) {
            $q = $request->search;
            $specialFeatures = SpecialFeature::where('title', 'LIKE', '%'.$q.'%')->orWhere('description', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/SpecialFeature/Index', ['specialFeatures' => $specialFeatures]);
        }

        $specialFeatures = Cache::remember($key, 10, function () {
            return SpecialFeature::orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_special_feature_url', $request->fullUrl());

        return Inertia::render('Dashboard/SpecialFeature/Index')->with(['specialFeatures' => $specialFeatures]);
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

        if ($request->image) {
            $data['image'] = FileHelpers::upload($request, 'image', 'specialFeatures');
        }

        try {
            SpecialFeature::create($data);
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
          return Inertia::render('Dashboard/SpecialFeature/Show')->with(['specialFeature' => $specialFeature]);
      }

    /**
     * Summary of edit
     * @param SpecialFeature $specialFeature
     * @return \Inertia\Response
     */
    public function edit(SpecialFeature $specialFeature)
    {
        $statusArr = Status::values();

        return Inertia::render('Dashboard/SpecialFeature/Edit', ['specialFeature' => $specialFeature, 'statusArr' => $statusArr]);
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
        if ($specialFeature->image) {
            FileHelpers::deleteFile($specialFeature->image);
        }

        $specialFeature->delete();

        if (session('last_visited_special_feature_url')) {
            return Redirect::to(session('last_visited_special_feature_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }

    public function imageUpdate(Request $request, SpecialFeature $specialFeature)
    {
        if ($request->image) {
            $path = FileHelpers::upload($request, 'image', 'specialFeatures');
            if (! $path) {
                return $this->failedWithMessage('Update Failed');
            } else {
                FileHelpers::deleteFile($specialFeature->image);
                $specialFeature->update(['image' => $path]);
            }
        }

        return $this->successWithMessage('Successfully Updated');
    }

    public function imageDelete(SpecialFeature $specialFeature)
    {
        FileHelpers::deleteFile($specialFeature->image);

        $specialFeature->update([$specialFeature->image = null]);

        return $this->successWithMessage('Deleted successfull');
    }
}