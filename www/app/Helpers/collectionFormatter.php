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
     * formate collection into headers for table usage
     *
     * @param object $collection
     * @return array
     */
    public static function headers(object $collection): array
    {
        $headers = array_keys($collection->first()->toArray());
        array_push($headers, 'actions');
        foreach ($headers as $key => $header) {

            if ($key === array_key_first($headers))
                $headers[$key] = ['text' => $header,  'align' => "start", 'value' => $header, "sortable" => false];

            if ($key === array_key_last($headers))
                $headers[$key] = ['text' => $header, 'value' => $header, "sortable" => false];

            if ($key !== array_key_first($headers) && $key !== array_key_last($headers))
                $headers[$key] = ['text' => $header, 'value' => $header];
        }
        return $headers;
    }
}
