<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Commentary extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'user_id',
        'ticket_id',
        'description'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
