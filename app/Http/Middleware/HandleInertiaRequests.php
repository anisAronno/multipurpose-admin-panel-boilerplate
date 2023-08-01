<?php

namespace App\Http\Middleware;

use App\Helpers\CacheHelper;
use App\Helpers\LanguageHelper;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? $request->user()->load('unreadNotifications') : $request->user(),
            ],
            'global' => [
                'options' => Option::getSettings(),
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => fn () => $request->session()->get('success'),
            ],
            'language' => session()->get('language') ?? app()->getLocale(),
            'languages' => LanguageHelper::getExistingLanguaseFile(),
             'translations' => $this->transletFromJson(),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }

    protected function transletFromJson()
    {

        $locale = App::getLocale();

        $key = CacheHelper::getOptionsCacheKey();

        return Cache::rememberForever($key, function () use ($locale) {
            $phpTranslations = [];
            $jsonTranslations = [];

            if (File::exists(resource_path("lang/$locale"))) {
                $phpTranslations = collect(File::allFiles(resource_path("lang/$locale")))
                    ->filter(function ($file) {
                        return $file->getExtension() === "php";
                    })->flatMap(function ($file) {
                        return Arr::dot(File::getRequire($file->getRealPath()));
                    })->toArray();
            }

            if (File::exists(resource_path("lang/$locale.json"))) {
                $jsonTranslations = json_decode(File::get(resource_path("lang/$locale.json")), true);
            }

            return array_merge($phpTranslations, $jsonTranslations);
        });


    }

    public function transletFromFile()
    {
        $key = CacheHelper::getOptionsCacheKey();

        return cache()->rememberForever($key, function () {
            return collect(File::allFiles(base_path('resources/lang/' . app()->getLocale())))
                ->flatMap(function ($file) {
                    return Arr::dot(
                        File::getRequire($file->getRealPath()),
                        $file->getBasename('.' . $file->getExtension()) . '.'
                    );
                });
        });
    }
}
