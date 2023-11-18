<?php

namespace App\Factories;

use App\Services\Interfaces\FileInterface;
use Illuminate\Support\Str;
use Exception;

class FileFactory
{
    public static function create(string $driver): FileInterface
    {
        $driverClass = 'App\\Services\\UploadDriver\\' . Str::studly($driver);

        if (!class_exists($driverClass)) {
            throw new Exception('UploadDriver class of type driver : ' . $driver . ' not found ');
        }

        return new $driverClass();
    }
}
