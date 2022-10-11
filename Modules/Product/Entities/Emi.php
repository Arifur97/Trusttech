<?php

namespace Modules\Product\Entities;

class Emi {
    public $months;
    public $percentage;
    public $overall_cost;

    public function __construct($months, $percentage, $price) {
        $this->months = $months;
        $this->percentage = $percentage;
        $this->overall_cost = $this->get_overall_cost($price);
    }

    public function get_overall_cost($price) {
        return ceil($price + ($this->percentage * $price * 0.01));
    }
}
