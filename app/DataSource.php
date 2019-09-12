<?php

namespace App;

class DataSource {

    public $number;
    public $date;
    public $name;
    public $link;
    public $details;

    public function __construct() {
    }

    public function getNumber(): int {
        return $this->number;
    }

    public function setNumber(int $number) {
        $this->number = $number;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function setDate(string $date) {
        $this->date = $date;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getLink(): string {
        return $this->link;
    }

    public function setLink(?string $link) {
        $this->link = $link;
    }

    public function getDetails(): string {
        return $this->details;
    }

    public function setDetails(?string $details) {
        $this->details = $details;
    }

}
