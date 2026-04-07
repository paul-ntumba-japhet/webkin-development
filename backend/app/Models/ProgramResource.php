<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'description',
        'resource_type',
        'media_id',
        'external_url',
        'position',
        'is_featured',
        'status',
    ];

    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function media() : BelongsTo { return $this->belongsTo(Media::class); }

}
