<?php

namespace App\Kernel\Http;

use App\Kernel\Upload\UploadedFileInterface;
use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function createFromGlobals(): static;
    public function uri(): string;
    public function method(): string;
    public function server(string $key = null): array|string|null;
    public function input(string $key, mixed $default = null): mixed;
    public function file(string $key): ?UploadedFileInterface;
    public function setValidator(ValidatorInterface $validator): void;
    public function validate(array $rules): bool;
    public function errors(): array;
}
