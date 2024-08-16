<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_number', 'order_event_id', 'order_price', 'order_type', 'order_payment', 'order_info', 'order_created_on', 'order_client_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'order_event_id');
    }
}
