<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramCareerOpportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'description',
        'position',
    ];

    protected function casts() : array
    {
        return [
            'program_id' => 'integer',
            'position' => 'integer',
        ];
    }
    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
}
