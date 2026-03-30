<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'interest_program_id',
        'source',
        'message',
        'status',
    ];

    public function program() { return $this->belongsTo(Program::class, 'interest_program_id'); }
}
