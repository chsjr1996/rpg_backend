<?php

namespace App\Utils;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Throwable;

class PropertyAccessor
{
    private $builder;

    public function __construct()
    {
        $this->builder = PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->enableExceptionOnInvalidPropertyPath()
            ->getPropertyAccessor();
    }

    public function get($objectOrArray, string $path, $default = null)
    {
        try {
            return $this->builder->getValue($objectOrArray, $path);
        } catch (Throwable $e) {
            return $default;
        }
    }

    public function set($objectOrArray, $path, $value): bool
    {
        try {
            $this->builder->setValue($objectOrArray, $path, $value);
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }
}