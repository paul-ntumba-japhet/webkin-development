<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'subject',
        'message',
        'source',
        'status',
        'handled_by_user_id',
        'handled_at',
        'notes',
    ];

    public function handler() { return $this->belongsTo(User::class, 'handled_by'); }

}
