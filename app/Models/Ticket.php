<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $primaryKey = 'ticket_id';
    protected $fillable = ['ticket_event_id', 'ticket_email', 'ticket_phone', 'ticket_price', 'ticket_order_id', 'ticket_order_id', 'ticket_key', 'ticket_ticket_type_id', 'ticket_status', 'ticket_created_on'];
}
