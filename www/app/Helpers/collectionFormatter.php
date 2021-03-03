<?php

namespace App\Helpers;

/**
 * helper class used to format a collection into 
 * any formate u want.
 * @copyright 2021 Fatora
 * @author Omar Hossam EL-Din Kandil <okandil273@gmail.com>
 */
class collectionFormatter
{
    /**
     * format collection into headers for table usage
     * @param object $collection
     * @return array $headers
     */
    public static function headers(object $collection): array
    {
        if (count($collection) > 0)
            $headers = array_keys($collection->first()->toArray());
        else
            $headers = ['id', 'name'];
        array_push($headers, 'actions');
        foreach ($headers as $key => $header) {

            if ($key === array_key_last($headers))
                $headers[$key] = ['text' => $header, 'value' => $header, "sortable" => false];

            if ($key !== array_key_last($headers))
                $headers[$key] = ['text' => $header, 'value' => $header];
        }
        return $headers;
    }

    /**
     * format collection into rows for table usage
     * @param object $collection
     * @return array $dataTable
     */
    public static function data(object $collection): array
    {
        $dataTable = count($collection) > 0 ? $collection->toArray() : [];
        return $dataTable;
    }
}
