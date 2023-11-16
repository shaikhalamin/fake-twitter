<?php

namespace App\Services\File;

use Illuminate\Support\Facades\File;

class FileService
{
    public function upload($user, $file, ?array $options = [])
    {
        $fileName = md5($user->username . $user->email) . '.' . $file->getClientOriginalExtension();
        $path = array_key_exists('path', $options) ? $options['path'] : '/uploads/files';
        $this->deleteFile($user->avatar);
        $fileUrl = config('app.url') . ':' . config('app.host_port') . $path . '/' . $fileName;
        $file->move(public_path($path), $fileName);
        return $fileUrl;
    }

    public function deleteFile($fileName)
    {
        $filePath = explode(':', $fileName);
        if (count($filePath) < 3) {
            return false;
        }
        if (File::exists(public_path($filePath[2]))) {
            File::delete(public_path($filePath[1]));
        }

        return true;
    }
}
