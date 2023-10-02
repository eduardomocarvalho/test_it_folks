<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TicketStatus.
 *
 * @package namespace App\Models;
 */
class TicketStatus extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'name',
    ];
}
