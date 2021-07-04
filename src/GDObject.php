<?php
/*
 * Copyright (c) 2020 - 2021. WOSHIZHAZHA120
 */

namespace GDCN;

/**
 * Class GDObject
 * @package GDObject
 */
class GDObject
{
    /**
     * @var bool
     */
    protected static bool $useKey = true;

    /**
     * @return static
     */
    public static function dontUseKey(): static
    {
        static::$useKey = false;
        return (new static);
    }

    /**
     * @param array $object
     * @param string $glue
     * @return string
     */
    public static function merge(array $object, string $glue): string
    {
        $objects = [];
        foreach ($object as $key => $value) {
            $objects[] = implode($glue, static::$useKey ? [$key, $value] : [$value]);
        }

        return implode($glue, $objects);
    }

    /**
     * @param string $object
     * @param string $delimiter
     * @return array
     */
    public static function split(string $object, string $delimiter): array
    {
        $objects = explode($delimiter, $object);
        for ($i = 0, $iMax = count($objects); $i < $iMax; $i += 2) {
            if (static::$useKey) {
                if (!empty($objects[$i + 1])) {
                    $result[$objects[$i]] = $objects[$i + 1];
                }
            } else {
                $result[] = $objects[$i + 1];
            }
        }

        return $result ?? [];
    }
}