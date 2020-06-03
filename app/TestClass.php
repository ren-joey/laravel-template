<?php

namespace App;

class TestClass {
    protected $value = 0;

    public function increase()
    {
        $this->value += 1;
        return $this->value;
    }
}