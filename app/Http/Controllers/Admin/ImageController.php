<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelpers;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ImageController extends InertiaApplicationController
{
    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        $key = CacheHelper::getImageCacheKey($currentPage);

        $images = Cache::remember($key, 10, function () {
            return Image::orderBy('id', 'desc')->paginate(20);
        });

        return response()->json($images);
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
     * Image store
     */
    public function store(StoreImageRequest $request)
    {
        $data = [];
        $data = $request->only('title');
        $data['user_id'] = auth()->user()->id ;

        if ($request->image) {
            $data['url'] = FileHelpers::upload($request, 'image', 'images');
            $data['mimes'] = $request->image->extension();
            $data['type'] = $request->image->getClientMimeType();
            $data['size'] = number_format($request->image->getSize()/(1024*1024), 2, '.', '')."MB";
        }

        try {
            Image::create($data);
            return $this->successWithMessage('Created successfull');
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }


    public function update(UpdateImageRequest $request, Image $image)
    {
        try {
            $image->title = $request->title;
            $image->update($request->only('title'));
            return $this->successWithMessage('Update successfull');
        } catch (\Throwable $th) {
            return $this->failedWithMessage($th->getMessage());
        }
    }

    public function destroy(Image $image)
    {
        try {
            FileHelpers::deleteFile($image->url);

            $image->delete();

            return $this->successWithMessage('Deleted successfull');
        } catch (\Throwable $th) {
            return $this->failedWithMessage('Deleted failed');
        }
    }

    public function groupDelete(Request $request)
    {
        try {
            foreach ($request->data as  $image) {
                isset($image['url']) ? FileHelpers::deleteFile($image['url']) : '';
            }

            $idArr = array_column($request->data, 'id');
            $result = Image::whereIn('id', $idArr)->delete();
            if ($result) {
                return $this->successWithMessage('Deleted successfull');
            }
        } catch (\Throwable $th) {
            return $this->failedWithMessage('Deleted failed');
        }
    }
}
