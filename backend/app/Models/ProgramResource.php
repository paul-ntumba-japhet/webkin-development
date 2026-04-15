<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Programs\Enums\ProgramResourceType;
use App\Domain\Programs\Enums\ProgramResourceStatus;

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

    protected function casts(): array
    {
        return [
            'program_id' => 'integer',
            'media_id' => 'integer',
            'position' => 'integer',
            'is_featured' => 'boolean',
            'resource_type' => ProgramResourceType::class,
            'status' => ProgramResourceStatus::class,
        ];
    }



    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function media() : BelongsTo { return $this->belongsTo(Media::class); }

}
