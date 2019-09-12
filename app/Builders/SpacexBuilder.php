<?php

namespace App\Builders;

use App\DataSource;
use App\Interfaces\DataSourceBuilderInterface;
use Carbon\Carbon;

class SpacexBuilder implements DataSourceBuilderInterface {

    protected $datasource;

    public function __construct() {
        $this->datasource = new DataSource();
    }

    public function map($data) {
        $this->datasource->setNumber($data->flight_number);
        $this->datasource->setDate($this->buildDate($data->launch_date_utc));
        $this->datasource->setName($data->mission_name);
        $this->datasource->setLink($data->links->article_link);
        $this->datasource->setDetails($data->details);

        return $this->datasource;
    }

    public function buildDate(string $date) {
        return date("Y-m-d", strtotime($date));
    }
}