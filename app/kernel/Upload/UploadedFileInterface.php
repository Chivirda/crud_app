<?php

namespace App\Kernel\Upload;

interface UploadedFileInterface
{
    public function move(string $path, string $name = null): string|false;
    public function getExtension(): string;
}
