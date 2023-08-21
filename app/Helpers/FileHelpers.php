<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelpers
{
    private static $fileTypeFolders = [
        'images' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'],
        'videos' => ['mp4', 'webm', 'ogg', 'mpeg', 'wav', 'mkv'],
        'csv' => ['csv'],
        'excel' => ['xls', 'xlsx'],
        'pdf' => ['pdf'],
        'text' => ['text'],
        'documents' => ['doc', 'docx'],
        'files' => ['zip', 'rar', 'gz', 'tar'],
     ];


    public static function getUrl($value, $disk = null): string
    {
        $storageDisk = !is_null($disk) ? $disk : Storage::getDefaultDriver();

        if (! empty($value)) {
            $fileExtension = pathinfo(parse_url($value, PHP_URL_PATH), PATHINFO_EXTENSION);
            $fileTypeFolder = static::getFileTypeFolder($fileExtension);
            $path = stristr($value, $fileTypeFolder);

            if(self::isDefaultFile($value) && Storage::disk($storageDisk)->exists('public/'.$value)) {
                return Storage::url($value);

            } elseif (! empty($path) && Storage::disk($storageDisk)->exists('public/'.$path)) {
                return Storage::url($path);
            } else {
                return $value;
            }



        } else {
            return Storage::url(static::findDefaultsFolderPath().'/placeholder.png');
        }
    }

    public static function upload($request, $file_name, string $upload_dir, $disk = null)
    {
        try {
            if ($request->hasFile($file_name)) {
                $file = $request->$file_name;
                $extension = $file->extension();
                $filename = time().'.'.$extension;
                $fileTypeFolder = static::getFileTypeFolder($extension);
                $up_path = $fileTypeFolder.'/'.$upload_dir.'/'.date('Y-m');
                $filePath = $up_path.'/'.$filename;

                if (! static::isAllowFileType($filePath)) {
                    return false;
                }

                return static::store($file, $filePath, $disk);
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function deleteFile($value, $disk = null): bool
    {
        $path = stristr($value, 'images');

        if (! static::isAllowFileType($path) || static::isDefaultFile($path)) {
            return false;
        }

        $storageDisk = !is_null($disk) ? $disk : Storage::getDefaultDriver();

        try {
            if (Storage::disk($storageDisk)->exists('public/'.$path)) {
                Storage::disk($storageDisk)->delete('public/'.$path);
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function isAllowFileType($path = ''): bool
    {
        $extension = pathinfo(
            parse_url($path, PHP_URL_PATH),
            PATHINFO_EXTENSION
        );

        $allowedExtensions = array_merge(...array_values(static::$fileTypeFolders));

        return in_array($extension, $allowedExtensions);
    }
    public static function getDefaultImage(): string
    {
        return Storage::url('defaults/placeholder.png');
    }


    private static function isDefaultFile($path): bool
    {
        $disk = Storage::disk('public');

        $defaultFolderPath = static::findDefaultsFolderPath();

        $defaultFiles = $disk->files($defaultFolderPath);

        $trimPath = stristr($path, $defaultFolderPath);

        return in_array($trimPath, $defaultFiles);
    }

    private static function store($file, $file_path, $disk)
    {
        $storageDisk = !is_null($disk) && !empty($disk) ? $disk : Storage::getDefaultDriver();

        $disk = Storage::disk($storageDisk);
        $disk->put('public/'.$file_path, file_get_contents($file));

        return $file_path;
    }

    private static function findDefaultsFolderPath(): ?string
    {
        $directories = Storage::disk('public')->allDirectories();
        $defaultsFolder = array_filter($directories, fn ($directory) => Str::contains($directory, 'defaults'));

        return count($defaultsFolder) > 0 ? reset($defaultsFolder) : null;
    }

    private static function getFileTypeFolder($extension)
    {
        foreach (static::$fileTypeFolders as $folder => $extensions) {
            if (in_array($extension, $extensions)) {
                return $folder;
            }
        }

        return 'others';
    }
}
