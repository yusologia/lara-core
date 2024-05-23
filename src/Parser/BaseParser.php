<?php

namespace Logia\Core\Parser;

class BaseParser
{
    /**
     * @param $collections
     *
     * @return array|null
     */
    public static function get($collections)
    {
        if (!$collections || count($collections) == 0) {
            return null;
        }

        $data = [];
        foreach ($collections as $collection) {
            $data[] = static::first($collection);
        }

        return $data;
    }

    /**
     * @param $data
     *
     * @return array|null
     */
    public static function first($data)
    {
        if (!$data) {
            return null;
        }

        $result = collect($data)->except(['createdAt', 'updatedAt', 'deletedAt'])->toArray();

        return $result + [
                'createdAt' => $data->createdAt?->format('d/m/Y H:i')
            ];
    }

    /**
     * @param $collections
     *
     * @return array|null
     */
    public static function briefs($collections)
    {
        if (!$collections || count($collections) == 0) {
            return null;
        }

        $data = [];
        foreach ($collections as $collection) {
            $data[] = static::brief($collection);
        }

        return $data;
    }

    /**
     * @param $data
     *
     * @return array|null
     */
    public static function brief($data)
    {
        return static::first($data);
    }

}
