<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

/**
 * DataSource resource
 * 
 * @package App\Http\Resources
 */
class DataSource extends Resource
{
    /**
     * @var $meta
     */
    private $meta;

    /**
     * @var $data
     */
    private $data;

    public function __construct($resource)
    {
        // Set meta data
        $this->meta = [
            'request' => $resource['params'],
            'timestamp' => Carbon::now('UTC')->format('Y-m-d\Th:i:s:mm\Z'),
        ];

        // Set data
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
