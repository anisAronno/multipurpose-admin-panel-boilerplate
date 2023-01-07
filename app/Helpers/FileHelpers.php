<?php

namespace App\Helpers;

class FileHelpers
{
    public static function upload($request, $file_name, $upload_dir)
    {
        try {
            if ($request->hasFile($file_name)) {
                $file = $request->$file_name;
                $filename = time() . '.' . $file->extension();
                $up_path = "uploads/".$upload_dir."/".date('Y-m');
                $filePath = $up_path.'/'.$filename;
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

        $defaultFile = [
            'uploads/users/avatar.png',
            'uploads/placeholder.png',
            'uploads/settings/logo.png',
            'uploads/settings/banner.png',
            'uploads/settings/fav_icon.png',
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
}
