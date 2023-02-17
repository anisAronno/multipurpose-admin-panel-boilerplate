<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Status: string
{
    use EnumToArray;

    case PUBLISHED = 'Published';
    case INREVIEW = 'Inreview';
    case SUBMIT = 'Submit';
    case PENDING = 'Pending';
    case DRAFT =  'Draft';
    case REJECTED = 'Rejected';
}
