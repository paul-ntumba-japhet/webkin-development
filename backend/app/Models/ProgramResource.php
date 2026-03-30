<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function program() { return $this->belongsTo(Program::class); }
    public function media() { return $this->belongsTo(Media::class); }

}
