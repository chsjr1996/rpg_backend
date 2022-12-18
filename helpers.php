<?php

use Doctrine\Common\Collections\ArrayCollection;
use Dotenv\Dotenv;
use Symfony\Component\PropertyAccess\PropertyAccess;

if (!function_exists('load_envs')) {
    /**
     * Load .env file
     */
    function load_envs()
    {
        (Dotenv::createImmutable(__DIR__))->load();
    }
}

if (!function_exists('env')) {
    function env($name, $default = null)
    {
        try {
            return $_ENV[$name];
        } catch (\Throwable $e) {
            return $default;
        }
    }
}

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
        try {
            $propertyAcessor = PropertyAccess::createPropertyAccessor();

            return $propertyAcessor->getValue($objectOrArray, $path);
        } catch (\Throwable $e) {
            return $default;
        }
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
     * @return bool False if value cannot be set
     */
    function data_set($objectOrArray, string $path, $value)
    {
        try {
            $propertyAcessor = PropertyAccess::createPropertyAccessor();
            $propertyAcessor->setValue($objectOrArray, $path, $value);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
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

if (!function_exists('get_fixture')) {
    /**
     * Get fixture file data content
     * 
     * 
     */
    function get_fixture(string $fixtureName, $toArray = false)
    {
        try {
            $data = json_decode(file_get_contents(__DIR__ . "/fixtures/{$fixtureName}"));

            if ($toArray) {
                return (array) $data;
            }

            return $data;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
