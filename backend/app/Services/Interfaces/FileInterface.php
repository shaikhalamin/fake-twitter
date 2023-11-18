<?php

namespace App\Services\Interfaces;

interface FileInterface
{
    public function upload($file, $options = []);

    public function destroy($id);
}
