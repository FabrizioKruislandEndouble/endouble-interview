<?php

namespace App\Interfaces;

/**
 * DataSource interface
 * 
 * @package App\Interfaces
 */
interface DataSourceInterface
{
    /**
     * Retrieve the formatted data from a datasource
     * 
     * @param array $params Parameters to filter request
     * @return array Formatted data from datasource
     */
    public function get(array $params);
}