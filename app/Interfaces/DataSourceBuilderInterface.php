<?php

namespace App\Interfaces;

/**
 * DataSourceBuilder interface
 * 
 * @package App\Interfaces
 */
interface DataSourceBuilderInterface
{
    /**
     * Map API data to DataSource object
     * 
     * @param $data Data to map to DataSource object
     * @return \App\DataSource
     */
    public function map($data): \App\DataSource;
}