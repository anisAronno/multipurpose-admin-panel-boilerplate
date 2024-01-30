<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AllowedFileType: string
{
    use EnumToArray;

    case TEXT = 'text';
    case JPEG = 'jpeg';
    case JPG = 'jpg';
    case PNG = 'png';
    case GIF = 'gif';
    case SVG = 'svg';
    case WEBP = 'webp';
    case PDF = 'pdf';
    case DOCUMENT = 'document';
    case MPEG = 'mpeg';
    case WAV = 'wav';
    case OGG = 'ogg';
    case MP4 = 'mp4';
    case ZIP = 'zip';
    case WEBM = 'webm';
    case CSV = 'csv';
    case XLS = 'xls';
    case XLSX = 'xlsx';
}
