<?php

namespace App\Builders;

use App\Interfaces\DataSourceBuilderInterface;

class DataSourceBuilder {

    public function build(DataSourceBuilderInterface $datasource, $data) {
        return $datasource->map($data);
    }
}