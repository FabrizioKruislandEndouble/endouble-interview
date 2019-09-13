<?php

namespace App\Builders;

use App\Interfaces\DataSourceBuilderInterface;

/**
 * DataSource object builder
 * 
 * @package App\Builders
 */
class DataSourceBuilder {

    /**
     * Build a DataSource object based on a specific datasource interface
     * 
     * @param DataSourceBuilderInterface $datasource
     * @param $data Data which should be used to build datasource object
     */
    public function build(DataSourceBuilderInterface $datasource, $data): \App\DataSource {
        return $datasource->map($data);
    }
}