<?php
declare(strict_types=1);
namespace App\Model\Type;

enum StatusType : string
{
    case COMPLETED = 'Completed';
    case IN_PROGRESS = 'In Progress';
    case PENDING = 'Pending';
    case NONE = '';
}
