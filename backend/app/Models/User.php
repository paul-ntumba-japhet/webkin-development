<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'avatar_media_id',
        'bio',
        'city',
        'status',
        'email_verified_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function avatarMedia() : BelongsTo
    {
        return $this->belongsTo(Media::class, 'avatar_media_id');
    }


    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps()->withPivot('assigned_at');
    }


    public function uploadedMedia() : HasMany
    {
        return $this->hasMany(Media::class, 'uploaded_by');
    }


    public function taughtSchedules() : HasMany
    {
        return $this->hasMany(CohortSchedule::class, 'instructor_id');
    }

    public function enrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }


    public function validatedEnrollments() : HasMany
    {
        return $this->hasMany(Enrollment::class, 'validated_by');
    }

    public function initiatedPayments() : HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'initiated_by_user_id');
    }

    public function recordedPayments() : HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'recorded_by_admin_id');
    }

    public function assignmentSubmissions() : HasMany
    {
        return $this->hasMany(AssignmentSubmission::class, 'student_id');
    }

    public function assignmentReviews() : HasMany
    {
        return $this->hasMany(AssignmentReview::class, 'reviewer_id');
    }


    public function studentProjects() : HasMany
    {
        return $this->hasMany(StudentProject::class, 'student_id');
    }


    public function projectMemberships() : HasMany
    {
        return $this->hasMany(ProjectMember::class, 'user_id');
    }

    public function mentoredSessions() : HasMany
    {
        return $this->hasMany(MentorshipSession::class, 'mentor_id');
    }

    public function mentoringSessionsAsStudent() : HasMany
    {
        return $this->hasMany(MentorshipSession::class, 'student_id');
    }

    public function studentQuestions() : HasMany
    {
        return $this->hasMany(StudentQuestion::class, 'student_id');
    }


    public function questionAnswers() : HasMany
    {
        return $this->hasMany(QuestionAnswer::class, 'author_id');
    }


    public function testimonials() : HasMany
    {
        return $this->hasMany(Testimonial::class, 'student_id');
    }



    public function notifications() : HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function challengeSubmissions() : HasMany
    {
        return $this->hasMany(ChallengeSubmission::class, 'student_id');
    }

    public function reviewedChallengeSubmissions() : HasMany
    {
        return $this->hasMany(ChallengeSubmission::class, 'reviewed_by');
    }

    public function pointTransactions() : HasMany
    {
        return $this->hasMany(PointTransaction::class, 'user_id');
    }

    public function supportConversations() : HasMany { return $this->hasMany(SupportConversation::class, 'student_id'); }
    public function assignedSupportConversations() : HasMany { return $this->hasMany(SupportConversation::class, 'assigned_to'); }
    public function supportMessages() : HasMany { return $this->hasMany(SupportMessage::class, 'sender_id'); }
    public function handledContactRequests() : HasMany { return $this->hasMany(ContactRequest::class, 'handled_by'); }


}
