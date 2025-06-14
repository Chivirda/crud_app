<?php

namespace App\Kernel\Validator;

use App\Kernel\Database\DatabaseInterface;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data = [];

    public function __construct(
        private DatabaseInterface $db
    ) {
    }

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
            "required" => empty($value) ? "Поле «{$field}» обязательно" : false,
            "min" => (mb_strlen($value) < $ruleValue)
                     ? "Поле «{$field}» должно быть не короче $ruleValue символов"
                     : false,
            "max" => (mb_strlen($value) > $ruleValue)
                     ? "Поле «{$field}» должно быть не длиннее $ruleValue символов"
                     : false,
            "email" => (!filter_var($value, FILTER_VALIDATE_EMAIL))
                     ? "Поле «{$field}» должно содержать корректный e-mail"
                     : false,
            "unique" => $this->unique($field, $value, $ruleValue),
            default => false,
        };
    }

    private function unique(string $field, mixed $value, ?string $ruleValue): string|false
    {
        if (empty($value)) {
            return false;
        }

        [$table, $column] = explode(",", $ruleValue);
        $column ??= $field;

        $exists = $this->db->first($table, [$column => $value]);

        return $exists ? "Значение поля «{$field}» уже занято" : false;
    }
}
