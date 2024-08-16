<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiAccessDemand extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'company', 'email', 'city', 'address'];
}
