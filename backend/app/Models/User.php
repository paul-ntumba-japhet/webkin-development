<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    public function avatarMedia()
    {
        return $this->belongsTo(Media::class, 'avatar_media_id');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps()->withPivot('assigned_at');
    }


    public function uploadedMedia()
    {
        return $this->hasMany(Media::class, 'uploaded_by');
    }


    public function taughtSchedules()
    {
        return $this->hasMany(CohortSchedule::class, 'instructor_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }


    public function validatedEnrollments()
    {
        return $this->hasMany(Enrollment::class, 'validated_by');
    }

    public function initiatedPayments()
    {
        return $this->hasMany(PaymentTransaction::class, 'initiated_by_user_id');
    }

    public function recordedPayments()
    {
        return $this->hasMany(PaymentTransaction::class, 'recorded_by_admin_id');
    }

    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'student_id');
    }

    public function assignmentReviews()
    {
        return $this->hasMany(AssignmentReview::class, 'reviewer_id');
    }


    public function studentProjects()
    {
        return $this->hasMany(StudentProject::class, 'student_id');
    }


    public function projectMemberships()
    {
        return $this->hasMany(ProjectMember::class, 'user_id');
    }

    public function mentoredSessions()
    {
        return $this->hasMany(MentorshipSession::class, 'mentor_id');
    }

    public function mentoringSessionsAsStudent()
    {
        return $this->hasMany(MentorshipSession::class, 'student_id');
    }

    public function studentQuestions()
    {
        return $this->hasMany(StudentQuestion::class, 'student_id');
    }


    public function questionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class, 'author_id');
    }


    public function testimonials()
    {
        return $this->hasMany(Testimonial::class, 'student_id');
    }



    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function challengeSubmissions()
    {
        return $this->hasMany(ChallengeSubmission::class, 'student_id');
    }

    public function reviewedChallengeSubmissions()
    {
        return $this->hasMany(ChallengeSubmission::class, 'reviewed_by');
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class, 'user_id');
    }

}
