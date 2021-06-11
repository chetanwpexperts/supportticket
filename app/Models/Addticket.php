<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addticket extends Model
{
    use HasFactory;
    protected $fillable = ['ticket_number', 'order_number', 'user_id', 'call_type', 'product_id','phone', 'email', 'subject', 'notes', 'internal_notes','department_id','open', 'close', 'assign'];
}
