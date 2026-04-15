<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'author_id',
        'answer',
        'is_accepted',
    ];

    protected function casts() : array
    {
        return [
            'question_id' => 'integer',
            'author_id' => 'integer',
            'is_accepted' => 'boolean',
        ];
    }

    public function question() : BelongsTo { return $this->belongsTo(StudentQuestion::class, 'question_id'); }
    public function author() : BelongsTo { return $this->belongsTo(User::class, 'author_id'); }

}
