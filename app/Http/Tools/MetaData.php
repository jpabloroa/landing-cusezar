<?php

namespace App\Http\Tools;

use Illuminate\Support\Facades\Log;

class MetaData
{
    private $keys;

    public function __construct($keys = [
        'opencagedata' => 'd8d023fba5ad4c6d904081ee638c0d2d'
    ])
    {
        $this->keys = $keys;
    }

    public function getFormattedLocation($lat = '', $lng = '')
    {
        try {
            // filtro &no_annotations=1 => sin anotaciones
            $obj = json_decode(file_get_contents('https://api.opencagedata.com/geocode/v1/json?q=' . $lat . '+' . $lng . '&key=' . $this->keys['opencagedata'] . '&language=es'));
        } catch (\Exception $e) {
            Log::debug('Error: ' . $e->getMessage());
        }
        return (array)$obj->results[0];
    }
}
