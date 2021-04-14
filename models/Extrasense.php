<?php

namespace models;

class Extrasense
{
    private $_credibility;
    private $_lastVariant;
    private $_historyVariants;
    
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
        $this->_lastVariant       = random_int(10, 99);
        $this->_historyVariants[] = $this->_lastVariant;
        return $this->_lastVariant;
    }

    public function getHistory() {
        return $this->_historyVariants;
    }
}
