<?php

namespace App\Helpers;

use App\Enums\AllowedFileType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelpers
{
    /**
     * check if isDefaultFile
     *
     * @param  mixed  $path
     * @return bool
     */
    public static function isDefaultFile($path): bool
    {
        $defaultFile = [
            'images/defaults/avatar.png',
            'images/defaults/placeholder.png',
            'images/defaults/logo.png',
            'images/defaults/banner.png',
            'images/defaults/fav_icon.png',
        ];

        $trimPath = stristr($path, 'images');

        if (in_array($trimPath, $defaultFile)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Filter $fileType
     *
     * @param  mixed  $file
     * @return bool
     */
    public static function isAllowFileType($path): bool
    {
        if (!$path) {
            return false;
        }

        $extension = pathinfo(
            parse_url($path, PHP_URL_PATH),
            PATHINFO_EXTENSION
        );

        if (in_array($extension, AllowedFileType::values())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Summary of get_url_in_content( $content:string )
     *
     * @param  mixed  $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public static function getUrl($value): string
    {
        if (! empty($value)) {
            $path = stristr($value, 'images');

            if (! empty($path) && Storage::disk('local')->exists('public/'.$path)) {
                return Storage::url($path);
            }

            return $value;
        } else {
            return Storage::url('images/defaults/placeholder.png');
        }
    }

    /**
     * Upload the file to the path.
     *
     * @param $file
     * @param $file_path
     * @return mixed
     */
    public static function store($file, $file_path)
    {
        $disk = Storage::disk('local');
        $disk->put('public/'.$file_path, file_get_contents($file));

        return $file_path;
    }

    /**
     * Summary of upload
     *
     * @param  mixed  $request
     * @param  mixed  $file_name
     * @param  mixed  $upload_dir
     * @return mixed
     */
    public static function upload($request, $file_name, string $upload_dir): mixed
    {
        try {
            if ($request->hasFile($file_name)) {
                $file = $request->$file_name;
                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = substr(Str::slug($name), 0, 150).'-'.time().'.'.$file->extension();
                $up_path = 'images/'.$upload_dir.'/'.date('Y-m');
                $filePath = $up_path.'/'.$filename;


                if (! self::isAllowFileType($filePath)) {
                    return false;
                }

                return self::store($file, $filePath);
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Summary of deleteFile
     *
     * @param  mixed  $value
     * @return bool
     */
    public static function deleteFile($value): bool
    {
        $path = stristr($value, 'images');

        if (! self::isAllowFileType($path)) {
            return false;
        }

        if (self::isDefaultFile($path)) {
            return false;
        }

        try {
            if (Storage::disk('local')->exists('public/'.$path)) {
                Storage::disk('local')->delete('public/'.$path);
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
