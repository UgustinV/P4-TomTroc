<?php

abstract class AbstractEntity
{

    public function __construct(array $data = [])
    {
        if(!empty($data)) {
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            // Convert snake_case to camelCase
            $camelCaseKey = $this->snakeToCamelCase($key);
            $method = 'set' . ucfirst($camelCaseKey);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    private function snakeToCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }
}