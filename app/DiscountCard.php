<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sqits\UserStamps\Concerns\HasUserStamps;

class DiscountCard extends Model
{
    use SoftDeletes,
        HasUserStamps;
}
