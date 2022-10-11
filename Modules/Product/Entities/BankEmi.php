<?php

namespace Modules\Product\Entities;

class BankEmi {
    public $bank_name;
    public $bank_short_name;
    public $emis;
    public $cards;

    public function __construct($bank_name, $bank_short_name, $emis, $cards) {
        $this->bank_name = $bank_name;
        $this->bank_short_name = $bank_short_name;
        $this->emis = $emis;
        $this->cards = $cards;
    }
}
