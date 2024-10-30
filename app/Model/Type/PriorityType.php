<?php
declare(strict_types=1);
namespace App\Model\Type;

enum PriorityType : string
{
    case HIGH = 'High';
    case MEDIUM = 'Medium';
    case LOW = 'Low';

}
