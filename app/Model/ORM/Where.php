<?php

namespace App\Model\ORM;

class Where
{
    public function __construct(public string $column, public Operator $operator , public mixed $value)
    {
    }
}