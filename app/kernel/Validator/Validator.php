<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $field => $rule) {
            $localRules = $rule;

            foreach ($localRules as $rule) {
                $rule = explode(":", $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this->validateField($field, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$field][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function validateField(string $field, string $ruleName, ?string $ruleValue): string|false
    {
        $value = $this->data[$field];

        return match ($ruleName) {
            "required" => empty($value) ? "Field $field is required" : false,
            "min" => (mb_strlen($value) < $ruleValue) ? "Field $field must be at leeast $ruleValue characters" : false,
            "max" => (mb_strlen($value) > $ruleValue) ? "Field $field must be at most $ruleValue characters" : false,
            "email" => (! filter_var($value, FILTER_VALIDATE_EMAIL)) ? "Field $field must be a valid email" : false,
            default => false,
        };
    }
}
