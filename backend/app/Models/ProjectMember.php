<?php

namespace App\Models;

use App\Domain\Assignments\Enums\ProjectMemberRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'role_in_project',
    ];

    protected function casts() : array
    {
        return [
            'project_id' => 'integer',
            'user_id' => 'integer',
            'role_in_project' => ProjectMemberRole::class,
        ];
    }

    public function project() : BelongsTo { return $this->belongsTo(StudentProject::class, 'project_id'); }
    public function user() : BelongsTo { return $this->belongsTo(User::class); }

}
