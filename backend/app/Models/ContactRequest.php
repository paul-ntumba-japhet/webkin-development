<?php

namespace App\Models;

use App\Domain\Communication\Enums\ContactRequestSource;
use App\Domain\Communication\Enums\ContactRequestStatus;
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

    protected function casts() : array
    {
        return [
            'handled_by_user_id' => 'integer',
            'handled_at' => 'datetime',
            'status' => ContactRequestStatus::class,
            'source' => ContactRequestSource::class,
        ];
    }


    public function handler() { return $this->belongsTo(User::class, 'handled_by'); }

}
