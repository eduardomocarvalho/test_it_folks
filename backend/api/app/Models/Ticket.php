<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Ticket extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'title',
        'category_id',
        'user_id',
        'ticket_status_id',
        'description',
        'resolution',
        'path',
        'name_file'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(TicketStatus::class,'ticket_status_id');
    }
}
