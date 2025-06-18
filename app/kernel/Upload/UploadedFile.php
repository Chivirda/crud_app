<?php

namespace App\Kernel\Upload;

class UploadedFile implements UploadedFileInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int $error,
        public readonly int $size,
    ) {
    }

    public function move(string $path, string $name = null): string|false
    {
        $storagePath = APP_PATH . "/storage/$path";

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0775, true);
        }

        $fileName  = $name ?? $this->randomFileName();

        $filePath = "$storagePath/$fileName";

        if (move_uploaded_file($this->tmpName, $filePath)) {
            return "$path/$fileName";
        }

        return false;
    }

    public function getExtension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    private function randomFileName(): string
    {
        return hash('sha256', uniqid()) . '.' . $this->getExtension();
    }
}
