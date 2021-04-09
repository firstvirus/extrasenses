<?php

namespace models;

class Extrasense
{
    private $_credibility;
    private $_lastVariant;
    
    public function __construct() {
        $this->_credibility = 0;
    }

    public function credibility($number) {
        if ($this->_lastVariant == $number) {
            $this->_credibility++;
        } else {
            $this->_credibility--;
        }
    }

    public function showCredibility() {
        return $this->_credibility;
    }

    public function getVariant() {
        $this->_lastVariant = random_int(10, 99);
        return $this->_lastVariant;
    }
}
