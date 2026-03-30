<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'author_id',
        'answer',
        'is_accepted',
    ];

    public function question() { return $this->belongsTo(StudentQuestion::class, 'question_id'); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }

}
