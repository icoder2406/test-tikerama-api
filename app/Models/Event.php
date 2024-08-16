<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_id';
    protected $fillable = ['event_category', 'event_title', 'event_description', 'event_date', 'event_image', 'event_city', 'event_address', 'event_status', 'event_created_on'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_event_id', 'event_id');
    }
}
