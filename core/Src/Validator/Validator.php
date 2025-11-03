<?php
namespace Src\Validator;

class Validator
{
    protected array $data;   // Данные формы
    protected array $rules;  // Правила валидации
    protected array $errors = []; // Ошибки

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    // Проверка всех правил
    public function fails(): bool
    {
        foreach ($this->rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if ($rule === 'required' && $this->isEmpty($field)) {
                    $this->errors[$field][] = "Поле «{$field}» не может быть пустым";
                }
            }
        }
        return !empty($this->errors);
    }

    // Проверка, пустое ли поле
    protected function isEmpty(string $field): bool
    {
        return !isset($this->data[$field]) || trim($this->data[$field]) === '';
    }

    // Получение ошибок
    public function errors(): array
    {
        return $this->errors;
    }
}
