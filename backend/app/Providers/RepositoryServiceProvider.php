<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Domain\IdentityAccess\Repositories\UserRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\IdentityAccess\EloquentUserRepository::class);
        $this->app->bind(\App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\IdentityAccess\EloquentRoleRepository::class);
        $this->app->bind(\App\Domain\IdentityAccess\Repositories\PermissionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\IdentityAccess\EloquentPermissionRepository::class);
        $this->app->bind(\App\Domain\Programs\Repositories\ProgramRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Programs\EloquentProgramRepository::class);
        $this->app->bind(\App\Domain\Programs\Repositories\ProgramModuleRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Programs\EloquentProgramModuleRepository::class);
        $this->app->bind(\App\Domain\Programs\Repositories\ProgramShowcaseRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Programs\EloquentProgramShowcaseRepository::class);
        $this->app->bind(\App\Domain\Cohorts\Repositories\CohortRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Cohorts\EloquentCohortRepository::class);
        $this->app->bind(\App\Domain\Cohorts\Repositories\CohortScheduleRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Cohorts\EloquentCohortScheduleRepository::class);
        $this->app->bind(\App\Domain\Cohorts\Repositories\RoomRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Cohorts\EloquentRoomRepository::class);
        $this->app->bind(\App\Domain\Curriculum\Repositories\LessonRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Curriculum\EloquentLessonRepository::class);
        $this->app->bind(\App\Domain\Curriculum\Repositories\LessonResourceRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Curriculum\EloquentLessonResourceRepository::class);
        $this->app->bind(\App\Domain\Curriculum\Repositories\StudentProgressRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Curriculum\EloquentStudentProgressRepository::class);
        $this->app->bind(\App\Domain\Enrollments\Repositories\EnrollmentRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Enrollments\EloquentEnrollmentRepository::class);
        $this->app->bind(\App\Domain\Billing\Repositories\EnrollmentBillingPeriodRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Billing\EloquentEnrollmentBillingPeriodRepository::class);
        $this->app->bind(\App\Domain\Billing\Repositories\InvoiceRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Billing\EloquentInvoiceRepository::class);
        $this->app->bind(\App\Domain\Payments\Repositories\PaymentTransactionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Payments\EloquentPaymentTransactionRepository::class);
        $this->app->bind(\App\Domain\Assignments\Repositories\AssignmentRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Assignments\EloquentAssignmentRepository::class);
        $this->app->bind(\App\Domain\Assignments\Repositories\AssignmentSubmissionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Assignments\EloquentAssignmentSubmissionRepository::class);
        $this->app->bind(\App\Domain\Projects\Repositories\StudentProjectRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Projects\EloquentStudentProjectRepository::class);
        $this->app->bind(\App\Domain\Projects\Repositories\ProjectMemberRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Projects\EloquentProjectMemberRepository::class);
        $this->app->bind(\App\Domain\Media\Repositories\MediaRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Media\EloquentMediaRepository::class);
        $this->app->bind(\App\Domain\SupportMessaging\Repositories\SupportConversationRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\SupportMessaging\EloquentSupportConversationRepository::class);
        $this->app->bind(\App\Domain\SupportMessaging\Repositories\SupportMessageRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\SupportMessaging\EloquentSupportMessageRepository::class);
        $this->app->bind(\App\Domain\Challenges\Repositories\ChallengeRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Challenges\EloquentChallengeRepository::class);
        $this->app->bind(\App\Domain\Challenges\Repositories\ChallengeSubmissionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Challenges\EloquentChallengeSubmissionRepository::class);
        $this->app->bind(\App\Domain\Challenges\Repositories\PointTransactionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Challenges\EloquentPointTransactionRepository::class);
        $this->app->bind(\App\Domain\Communication\Repositories\ContactRequestRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Communication\EloquentContactRequestRepository::class);
        $this->app->bind(\App\Domain\Communication\Repositories\NotificationRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Communication\EloquentNotificationRepository::class);
        $this->app->bind(\App\Domain\Communication\Repositories\StudentQuestionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Communication\EloquentStudentQuestionRepository::class);
        $this->app->bind(\App\Domain\Mentoring\Repositories\MentorshipSessionRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Mentoring\EloquentMentorshipSessionRepository::class);
        $this->app->bind(\App\Domain\Attendance\Repositories\AttendanceRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Attendance\EloquentAttendanceRepository::class);
        $this->app->bind(\App\Domain\Leads\Repositories\LeadRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Leads\EloquentLeadRepository::class);
        $this->app->bind(\App\Domain\Platform\Repositories\SettingRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Platform\EloquentSettingRepository::class);
        $this->app->bind(\App\Domain\Platform\Repositories\TestimonialRepositoryInterface::class, \App\Infrastructure\Persistence\Repositories\Platform\EloquentTestimonialRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
