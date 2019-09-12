<?php

namespace App\Interfaces;

interface DataSourceInterface
{
    public function get(array $params);
}