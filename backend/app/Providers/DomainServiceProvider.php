<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Domain\IdentityAccess\Services\PasswordHasherServiceInterface::class, \App\Domain\IdentityAccess\Services\BcryptPasswordHasher::class);
        $this->app->bind(\App\Domain\IdentityAccess\Services\PermissionResolverInterface::class, \App\Domain\IdentityAccess\Services\DefaultPermissionResolver::class);
        $this->app->bind(\App\Domain\IdentityAccess\Services\RoleAssignmentServiceInterface::class, \App\Domain\IdentityAccess\Services\DefaultRoleAssignmentService::class);
        $this->app->bind(\App\Domain\Programs\Services\ProgramPublishingPolicyServiceInterface::class, \App\Domain\Programs\Services\DefaultProgramPublishingPolicyService::class);
        $this->app->bind(\App\Domain\Programs\Services\ProgramCatalogServiceInterface::class, \App\Domain\Programs\Services\DefaultProgramCatalogService::class);
        $this->app->bind(\App\Domain\Cohorts\Services\CohortCapacityServiceInterface::class, \App\Domain\Cohorts\Services\DefaultCohortCapacityService::class);
        $this->app->bind(\App\Domain\Cohorts\Services\CohortSchedulingPolicyServiceInterface::class, \App\Domain\Cohorts\Services\DefaultCohortSchedulingPolicyService::class);
        $this->app->bind(\App\Domain\Curriculum\Services\LessonCompletionServiceInterface::class, \App\Domain\Curriculum\Services\DefaultLessonCompletionService::class);
        $this->app->bind(\App\Domain\Curriculum\Services\CurriculumReleasePolicyServiceInterface::class, \App\Domain\Curriculum\Services\DefaultCurriculumReleasePolicyService::class);
        $this->app->bind(\App\Domain\Enrollments\Services\EnrollmentEligibilityServiceInterface::class, \App\Domain\Enrollments\Services\DefaultEnrollmentEligibilityService::class);
        $this->app->bind(\App\Domain\Enrollments\Services\EnrollmentLifecycleServiceInterface::class, \App\Domain\Enrollments\Services\DefaultEnrollmentLifecycleService::class);
        $this->app->bind(\App\Domain\Billing\Services\InvoiceReferenceGeneratorInterface::class, \App\Domain\Billing\Services\TimestampInvoiceReferenceGenerator::class);
        $this->app->bind(\App\Domain\Billing\Services\BillingPeriodSchedulerInterface::class, \App\Domain\Billing\Services\DefaultBillingPeriodScheduler::class);
        $this->app->bind(\App\Domain\Payments\Services\PaymentLifecycleServiceInterface::class, \App\Application\Payments\Services\DefaultPaymentLifecycleService::class);
        $this->app->bind(\App\Domain\Payments\Services\PaymentMethodAvailabilityServiceInterface::class, \App\Domain\Payments\Services\DefaultPaymentMethodAvailabilityService::class);
        $this->app->bind(\App\Domain\Assignments\Services\AssignmentSubmissionPolicyServiceInterface::class, \App\Domain\Assignments\Services\DefaultAssignmentSubmissionPolicyService::class);
        $this->app->bind(\App\Domain\Assignments\Services\AssignmentReviewWorkflowServiceInterface::class, \App\Domain\Assignments\Services\DefaultAssignmentReviewWorkflowService::class);
        $this->app->bind(\App\Domain\Projects\Services\ProjectMembershipPolicyServiceInterface::class, \App\Domain\Projects\Services\DefaultProjectMembershipPolicyService::class);
        $this->app->bind(\App\Domain\Projects\Services\ProjectProgressServiceInterface::class, \App\Domain\Projects\Services\DefaultProjectProgressService::class);
        $this->app->bind(\App\Domain\Media\Services\MediaPathGeneratorInterface::class, \App\Domain\Media\Services\DefaultMediaPathGenerator::class);
        $this->app->bind(\App\Domain\Media\Services\MediaOwnershipPolicyServiceInterface::class, \App\Domain\Media\Services\DefaultMediaOwnershipPolicyService::class);
        $this->app->bind(\App\Domain\SupportMessaging\Services\SupportRoutingServiceInterface::class, \App\Domain\SupportMessaging\Services\DefaultSupportRoutingService::class);
        $this->app->bind(\App\Domain\SupportMessaging\Services\SupportConversationPolicyServiceInterface::class, \App\Domain\SupportMessaging\Services\DefaultSupportConversationPolicyService::class);
        $this->app->bind(\App\Domain\Challenges\Services\ChallengeSubmissionPolicyServiceInterface::class, \App\Domain\Challenges\Services\DefaultChallengeSubmissionPolicyService::class);
        $this->app->bind(\App\Domain\Challenges\Services\PointAwardPolicyServiceInterface::class, \App\Domain\Challenges\Services\DefaultPointAwardPolicyService::class);
        $this->app->bind(\App\Domain\Communication\Services\NotificationDispatcherInterface::class, \App\Infrastructure\Notifications\Services\DefaultNotificationDispatcher::class);
        $this->app->bind(\App\Domain\Communication\Services\StudentQuestionWorkflowServiceInterface::class, \App\Domain\Communication\Services\DefaultStudentQuestionWorkflowService::class);
        $this->app->bind(\App\Domain\Mentoring\Services\MentorshipSchedulingPolicyInterface::class, \App\Domain\Mentoring\Services\DefaultMentorshipSchedulingPolicyService::class);
        $this->app->bind(\App\Domain\Attendance\Services\AttendancePolicyServiceInterface::class, \App\Domain\Attendance\Services\DefaultAttendancePolicyService::class);
        $this->app->bind(\App\Domain\Leads\Services\LeadScoringServiceInterface::class, \App\Domain\Leads\Services\DefaultLeadScoringService::class);
        $this->app->bind(\App\Domain\Platform\Services\SettingsResolverInterface::class, \App\Domain\Platform\Services\CachedSettingsResolver::class);
    }
}
