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
     * @param string $datasource Datasource key
     * @param array $params Parameters to filter request
     * @return array Formatted data from datasource
     */
    public function get(string $datasource, array $params);
}