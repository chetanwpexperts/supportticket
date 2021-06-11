<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intractions extends Model
{
    use HasFactory;
    protected $fillable = ['agent_id', 'ticket_number', 'notes', 'intraction_id', 'internal_notes', 'assignedTo', 'assignedBy'];
}
