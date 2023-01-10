<?php

namespace App\Helpers;

use App\Enums\AllowedFileType;

class FileHelpers
{
    
    /**
     * check if isDefaultFile
     * @param mixed $path
     * @return bool
     */
    public static function isDefaultFile($path): Bool
    {
        $defaultFile = [
            'uploads/defaults/avatar.png',
            'uploads/defaults/placeholder.png',
            'uploads/defaults/logo.png',
            'uploads/defaults/banner.png',
            'uploads/defaults/fav_icon.png',
        ];
        

        $trimPath = stristr($path, 'uploads');

        if (in_array($trimPath, $defaultFile)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Filter $fileType
     * @param mixed $file
     * @return bool
     */
    public static function isAllowFileType($path): Bool
    {
        $extension =   pathinfo(
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
     * @param mixed $value
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public static function getUrl($value): string
    {
        if (!empty($value)) {
            $path = stristr($value, 'uploads');

            if (file_exists(public_path($path))) {
                return  url($path);
            }

            return $value;
        } else {
            return url('uploads/defaults/placeholder.png');
        }
    }
    /**
     * Summary of upload
     * @param mixed $request
     * @param mixed $file_name
     * @param mixed $upload_dir
     * @return mixed
     */
    public static function upload($request, $file_name, string $upload_dir): mixed
    {
        try {
            if ($request->hasFile($file_name)) {
                $file = $request->$file_name;
                $filename = time() . '.' . $file->extension();
                $up_path = "uploads/".$upload_dir."/".date('Y-m');
                $filePath = $up_path.'/'.$filename;

                if (! self::isAllowFileType($filePath)) {
                    return false;
                }

                $file->move($up_path, $filename);

                if ($file->getError()) {
                    $request->session()->flash('message', $file->getErrorMessage());
                    return false;
                }

                return $filePath;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Summary of deleteFile
     * @param mixed $value
     * @return bool
     */
    public static function deleteFile($value): bool
    {
        $path = stristr($value, 'uploads');

        if (! self::isAllowFileType($path)) {
            return false;
        }

        if (self::isDefaultFile($path)) {
            return false;
        }

        try {
            if (file_exists(public_path($path))) {
                unlink(public_path($path));
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
