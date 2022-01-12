<?php

namespace src\Promotion;

abstract class Promotion {

    public $id;
    public $name;
    public $note;
    abstract protected function process($orders);

}