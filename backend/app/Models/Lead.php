<?php

namespace App\Models;

use App\Domain\Leads\Enums\LeadSource;
use App\Domain\Leads\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected function casts() : array
    {
        return [
            'interest_program_id' => 'integer',
            'source' => LeadSource::class,
            'status' => LeadStatus::class,
        ];
    }

    public function program() : BelongsTo { return $this->belongsTo(Program::class, 'interest_program_id'); }
}
