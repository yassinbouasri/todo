<?php

namespace App\Model\ORM;

enum Operator: string
{
    case EQUALS = '=';
    case GREATER = '>';
    case LESS = '<';
    case GREATER_OR_EQUALS = '>=';
    case LESS_OR_EQUALS = '<=';
    case NOT_EQUALS = '!=';
    case LIKE = 'LIKE';
}