<?php

namespace App\Services;

class FileServices
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
            return  url($value);
        } else {
            return url('uploads/placeholder.png');
        }
    }

    public static function deleteFile($value)
    {
        $path = stristr($value, 'uploads');

        $defaultFile = ['uploads/users/avatar.png','uploads/placeholder.png'];

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
