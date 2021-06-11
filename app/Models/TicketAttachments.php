<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachments extends Model
{
    use HasFactory;
    protected $fillable = ['intraction_id','agent_id','ticket_number', 'file'];
}
