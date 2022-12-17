<?php

use App\Utils\PropertyAccessor;
use Doctrine\Common\Collections\ArrayCollection;

if (!function_exists('data_get')) {
    /**
     * Get object or array index using dot notation
     * 
     * @see https://symfony.com/doc/current/components/property_access.html#usage
     * @todo Install/use Service container (avoid to 're-instance' some classes)
     * @param object|array $objectOrArray
     * @param string $path
     * @param mixed $default
     * @return mixed
     */
    function data_get($objectOrArray, string $path, $default = null)
    {
        $propertyAcessor = new PropertyAccessor();

        return $propertyAcessor->get($objectOrArray, $path, $default);
    }
}

if (!function_exists('data_set')) {
    /**
     * Set on object/array using dot notation
     * 
     * @see https://symfony.com/doc/current/components/property_access.html#writing-to-arrays
     * @see https://symfony.com/doc/current/components/property_access.html#writing-to-objects
     * @todo Install/use Service container (avoid to 're-instance' some classes)
     * @param object|array $objectOrArray
     * @param string $path
     * @param mixed $default
     * @return mixed
     */
    function data_set($objectOrArray, string $path, $value)
    {
        $propertyAcessor = new PropertyAccessor();

        return $propertyAcessor->set($objectOrArray, $path, $value);
    }
}

if (!function_exists('collection')) {
    /**
     * Create a collection from array
     * 
     * @see https://www.doctrine-project.org/projects/doctrine-collections/en/stable/index.html
     * @param array $arr
     * @return ArrayCollection
     */
    function collection(array $arr)
    {
        return new ArrayCollection($arr);
    }
}
