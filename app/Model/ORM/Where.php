<?php

namespace App\Model\ORM;

class Where
{

    public string $column;
    public Operator $operator;
    public mixed $value;
    public function __construct(string $column,  Operator $operator ,  mixed $value)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
    }


}