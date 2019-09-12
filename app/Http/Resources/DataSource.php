<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class DataSource extends Resource
{
    private $meta;
    private $data;

    public function __construct($resource)
    {
        $this->meta = [
            'request' => $resource['params'],
            'timestamp' => Carbon::now('UTC')->format('Y-m-d\Th:i:s:mm\Z'),
        ];

        $this->data = $resource['data'];

        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'meta' => $this->meta,
            'data' => $this->data
        ];    
    }
}
