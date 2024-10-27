<?php

namespace App\Type;

enum StatusType : string
{
    case COMPLETED = 'Completed';
    case IN_PROGRESS = 'In Progress';
    case PENDING = 'Pending';
}
