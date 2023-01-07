<?php

namespace App\Helpers;

use PhpParser\Node\Expr\Cast\Bool_;

class FileHelpers
{
    public $allowedFileType;
    public function __construct()
    {
        $this->allowedFileType = ["jpeg", "jpg", "png", "gif", "svg", "webp"];
    }
    /**
     * Summary of uploads
     * @param mixed $request
     * @param mixed $file_name
     * @param mixed $upload_dir
     * @return array|string
     */
    public static function upload($request, $file_name, $upload_dir)
    {
        try {
            if ($request->hasFile($file_name)) {
                $file = $request->$file_name;
                $filename = time() . '.' . $file->extension();
                $up_path = "uploads/".$upload_dir."/".date('Y-m');
                $filePath = $up_path.'/'.$filename;

                $isAllowd =  (new self())->isAllowFileType($filePath);

                if (!$isAllowd) {
                    return false;
                }

                $file->move($up_path, $filename);

                if ($file->getError()) {
                    $request->session()->flash('warning', $file->getErrorMessage());

                    return [];
                }

                return $filePath;
            }
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function getUrl($value)
    {
        if ($value !== null) {
            $path = stristr($value, 'uploads');
            return  url($path);
        } else {
            return url('uploads/placeholder.png');
        }
    }

    public static function deleteFile($value)
    {
        $path = stristr($value, 'uploads');

        $isAllowd =  (new self())->isAllowFileType($path);

        if (!$isAllowd) {
            return false;
        }

        $defaultFile = [
            'uploads/users/avatar.png',
            'uploads/placeholder.png',
            'uploads/options/logo.png',
            'uploads/options/banner.png',
            'uploads/options/fav_icon.png',
        ];

        if (in_array($path, $defaultFile)) {
            return false;
        }

        try {
            if (file_exists(public_path($path))) {
                unlink(public_path($path));
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    /**
     * Summary of $fileType
     * @param mixed $file
     * @return bool
     */
    private function isAllowFileType($path): Bool
    {
        $extension =   pathinfo(
            parse_url($path, PHP_URL_PATH),
            PATHINFO_EXTENSION
        );

        if (in_array($extension, $this->allowedFileType)) {
            return true;
        } else {
            return false;
        }
    }
}
