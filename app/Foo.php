<?php

namespace App;

class Foo
{
    protected $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function hello()
    {
        return $this->bar->hello();
    }
}