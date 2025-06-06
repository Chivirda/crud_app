<?php

namespace App\Kernel\Validator;

interface ValidatorInterface
{
    public function validate(array $data, array $rules): bool;
    public function getErrors(): array;
}
