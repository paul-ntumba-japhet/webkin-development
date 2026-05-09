# Remaining backend steps before the Vue frontend

Stack assumption: **Laravel API** (JSON) + **Vue 3 / Vite SPA**. Architecture: **modular monolith**, **layered**, **lightweight DDD** (bounded contexts under `app/Application` + `app/Domain`, infrastructure at the edges).

This document lists what should be in place on the API side so the SPA can be built without constant rework.

---

## 1. Wire DTOs into real application flows

DTOs are inputs; they still need orchestration.

- **Application services / actions** (one class per use case, or small command handlers): validate business rules, load aggregates via repositories, call domain services, persist, dispatch domain events if you use them.
- **Idempotency / concurrency** where money or points are involved (payments, billing periods, point transactions): decide strategy (unique constraints + upserts, or explicit locks) before exposing endpoints.

Until each major flow has a thin **application layer entry point** that accepts a DTO and returns a clear result (model ID, resource payload, or domain outcome), the frontend will depend on ad-hoc controller logic.

---

## 2. HTTP layer: routes, controllers, Form Requests, API Resources

- **Routes**: group by module (`api.php` or `routes/api/*.php` loaded from `bootstrap`). Apply middleware consistently (`auth:sanctum`, `throttle`, optional `EnsureEmailVerified`).
- **Controllers**: stay thin—delegate to application services; no business rules in controllers.
- **Form Requests**: validation rules and authorization (`authorize()`) per endpoint; map validated input to DTOs (`fromRequest` or explicit mapping).
- **API Resources** (`JsonResource`): stable JSON shape for the SPA (relations, naming, pagination meta). Avoid leaking internal DB column names if they differ from public API contracts.

---

## 3. Authentication & authorization for the SPA

- **Sanctum** (or Passport if you need full OAuth): SPA cookie/session or token strategy—pick one and document it for the frontend team.
- **Policies / Gates**: align with your Domain modules (who can publish programs, approve enrollments, review assignments, etc.).
- **Role/permission checks**: mirror what `IdentityAccess` already models; centralize permission strings or enums so Vue can fetch “abilities” or derive UI from the same rules server-side.

---

## 4. Repository & persistence glue

If interfaces live in `app/Domain/*/Repositories`, ensure:

- **Eloquent implementations** exist and are bound in a service provider.
- **Transactions** wrap multi-step writes (enrollment + billing period + first invoice, assignment submission + review, etc.).
- **Query objects / read models** (optional): for list screens with filters, avoid N+1 and giant controllers.

---

## 5. Error handling and API contract

- **Consistent error envelope** (e.g. problem+json or a single `{ message, errors, code }` shape).
- **HTTP status semantics**: 422 for validation, 403 for policy, 409 for conflicts (duplicate enrollment, duplicate payment reference).
- **Locale**: if API messages are user-facing, agree on default locale vs `Accept-Language`.

---

## 6. Cross-cutting concerns

- **Logging**: structured context for payments and auth failures (without logging secrets).
- **Rate limiting**: login, password reset, contact forms, file uploads.
- **File / media uploads**: disk config, max size, MIME allowlist, virus scanning if required; return stable URLs for the SPA.
- **Queues**: emails, notifications, heavy PDF generation—infrastructure ready even if jobs are stubs.

---

## 7. Observability & quality gate

- **Feature tests** for critical paths (register/login, enrollment lifecycle, payment confirmation, assignment submit/review).
- **Contract tests** or OpenAPI (optional but valuable once routes stabilize): frontend can generate clients or mock from the same spec.
- **CI**: `php artisan test`, static analysis (`phpstan`/`larastan`), `pint`—minimum bar before SPA relies on the API.

---

## 8. Developer experience for the frontend team

- **Base URL, versioning**: e.g. `/api/v1`… freeze breaking changes behind version bumps.
- **Pagination & sorting** conventions: query params documented once (`page`, `per_page`, `sort`, `filter`).
- **CORS & Sanctum domains**: `.env` examples for local Vite (`localhost:5173`) and staging.

---

## Appendix — Inventory of application actions

Below is a **full list of command-style actions** (and essential **query actions**) expected for this modular monolith, **independent of your current folder layout**. Names are indicative (`XxxAction`, `HandleX`, `*Command`—pick one convention). Split reads vs writes if you use CQRS-style naming.

### Identity & access

- `RegisterUserAction`
- `LoginUserAction` / `LogoutUserAction`
- `ChangePasswordAction`
- `RequestPasswordResetAction` / `ResetPasswordAction`
- `CreateUserAction` / `UpdateUserAction` / `UpdateUserStatusAction`
- `AssignRolesToUserAction` / `RemoveRolesFromUserAction`
- `CreateRoleAction` / `UpdateRoleAction`
- `GetAuthenticatedUserAction` (or `GetCurrentUserProfileAction`)
- `ListUsersAction` / `GetUserAction` (admin / scoped lists)

### Programs (catalog & content)

- `CreateProgramAction` / `UpdateProgramAction`
- `PublishProgramAction` / `ArchiveProgramAction`
- `CreateProgramModuleAction` / `UpdateProgramModuleAction` / `ReorderProgramModulesAction`
- `CreateLessonAction` / `UpdateLessonAction` / `ReorderLessonsAction`
- `CreateProgramObjectiveAction` / `UpdateProgramObjectiveAction`
- `CreateProgramResourceAction` / `UpdateProgramResourceAction`
- `CreateProgramShowcaseAction` / `UpdateProgramShowcaseAction`
- `CreateProgramCareerOpportunityAction` / `UpdateProgramCareerOpportunityAction`
- `CreateProgramOutcomeProjectAction` / `UpdateProgramOutcomeProjectAction`
- `ListProgramsAction` / `GetProgramAction` / `GetProgramDetailAction` (modules, lessons as needed)

### Cohorts & facilities

- `CreateCohortAction` / `UpdateCohortAction` / `ArchiveCohortAction`
- `AssignProgramToCohortAction`
- `CreateCohortScheduleAction` / `UpdateCohortScheduleAction` / `DeleteCohortScheduleAction`
- `CreateCohortWeeklyScheduleAction` / `UpdateCohortWeeklyScheduleAction` / `DeleteCohortWeeklyScheduleAction`
- `CreateRoomAction` / `UpdateRoomAction` / `DeleteRoomAction`
- `ListCohortsAction` / `GetCohortAction` / `GetCohortScheduleAction`

### Enrollments

- `CreateEnrollmentAction` / `UpdateEnrollmentAction`
- `ApproveEnrollmentAction` / `RejectEnrollmentAction` / `CancelEnrollmentAction`
- `ChangeEnrollmentPaymentStatusAction`
- `ListEnrollmentsAction` / `GetEnrollmentAction`

### Payments

- `CreatePaymentTransactionAction`
- `ConfirmPaymentTransactionAction` / `FailPaymentTransactionAction` / `RefundPaymentTransactionAction`
- `ListPaymentTransactionsAction` / `GetPaymentTransactionAction`

### Billing

- `CreateEnrollmentBillingPeriodAction` / `UpdateEnrollmentBillingPeriodAction` / `CloseBillingPeriodAction`
- `GenerateInvoiceAction` / `UpdateInvoiceAction` / `VoidInvoiceAction` / `MarkInvoiceAsPaidAction`
- `ListEnrollmentBillingPeriodsAction` / `ListInvoicesAction` / `GetInvoiceAction`

### Assignments

- `CreateAssignmentAction` / `UpdateAssignmentAction`
- `PublishAssignmentAction` / `ArchiveAssignmentAction`
- `SubmitAssignmentAction` / `ResubmitAssignmentAction`
- `ReviewAssignmentSubmissionAction` / `UpdateAssignmentReviewAction`
- `ListAssignmentsAction` / `GetAssignmentAction` / `ListSubmissionsAction` / `GetSubmissionAction`

### Curriculum (progress)

- `UpdateStudentProgressAction` / `CompleteLessonProgressAction` / `ResetStudentProgressAction`
- `GetStudentProgressForEnrollmentAction` / `GetLessonProgressAction`

### Attendance

- `MarkAttendanceAction` / `BulkMarkAttendanceAction` / `UpdateAttendanceAction`
- `ListAttendanceForScheduleAction` / `GetAttendanceAction`

### Communication

- `CreateContactRequestAction` / `UpdateContactRequestStatusAction`
- `SendNotificationAction` / `MarkNotificationAsReadAction` / `MarkAllNotificationsAsReadAction`
- `AskStudentQuestionAction` / `AnswerStudentQuestionAction` / `UpdateQuestionAnswerAction`
- `ListNotificationsAction` / `ListStudentQuestionsAction` / `GetStudentQuestionAction`

### Support messaging

- `CreateSupportConversationAction` / `UpdateSupportConversationStatusAction` / `AssignSupportConversationAction`
- `CreateSupportMessageAction` / `MarkSupportMessageAsReadAction`
- `ListSupportConversationsAction` / `GetSupportConversationAction`

### Mentoring

- `CreateMentorshipSessionAction` / `UpdateMentorshipSessionAction`
- `RescheduleMentorshipSessionAction` / `CancelMentorshipSessionAction` / `CompleteMentorshipSessionAction`
- `ListMentorshipSessionsAction` / `GetMentorshipSessionAction`

### Projects (portfolio)

- `CreateStudentProjectAction` / `UpdateStudentProjectAction` / `ArchiveStudentProjectAction`
- `AddProjectMemberAction` / `UpdateProjectMemberRoleAction` / `RemoveProjectMemberAction`
- `ListStudentProjectsAction` / `GetStudentProjectAction`

### Challenges & gamification

- `CreateChallengeAction` / `UpdateChallengeAction` / `PublishChallengeAction` / `ArchiveChallengeAction`
- `SubmitChallengeAction` / `ReviewChallengeSubmissionAction`
- `AwardPointsAction` / `ReversePointsAction`
- `ListChallengesAction` / `GetChallengeAction` / `ListChallengeSubmissionsAction`
- `ListPointTransactionsAction` / `GetUserPointsSummaryAction` (if product needs a leaderboard or balance)

### Leads & testimonials

- `CreateLeadAction` / `UpdateLeadAction` / `QualifyLeadAction` / `ArchiveLeadAction`
- `CreateTestimonialAction` / `UpdateTestimonialAction` / `PublishTestimonialAction` / `ArchiveTestimonialAction`
- `ListLeadsAction` / `GetLeadAction` / `ListTestimonialsAction` / `GetTestimonialAction`

### Media

- `UploadMediaAction` / `UpdateMediaMetadataAction`
- `AttachMediaToEntityAction` / `DetachMediaFromEntityAction` / `DeleteMediaAction`
- `GetMediaAction` / `ResolveMediaUrlAction` (if URLs are signed or derived)

### Platform settings

- `CreateSettingAction` / `UpdateSettingAction` / `BulkUpdateSettingsAction`
- `ListSettingsAction` / `GetPublicSettingsAction` / `GetSettingAction`

### Cross-cutting (optional but common for SPAs)

- `DispatchDomainEventAction` (only if you formalize events out of actions)
- `SendTransactionalEmailAction` / `EnqueueNotificationAction` (if extracted from other actions)

**Note:** Many **read** actions can be implemented as **query services** or repository methods returning DTOs/views; they still belong in the application layer if they orchestrate multiple sources or apply visibility rules.

---

## Suggested order of execution (pragmatic)

1. **Auth + user profile API** (Sanctum, policies, `/me` or equivalent).
2. **Programs & cohorts** (catalog and scheduling drive many screens).
3. **Enrollments + billing + payments** (money paths + tests first).
4. **Assignments + attendance + curriculum progress** (daily student/instructor flows).
5. **Communication, support, mentoring** (parallel tracks once core LMS paths exist).
6. **Projects, challenges, leads, media, platform settings** (growth and marketing surfaces).

---

## Definition of “ready for Vue”

You can move to the SPA when:

- Each bounded context exposes **stable REST endpoints** backed by **application services**, not raw Eloquent in controllers.
- **Authz** is enforced server-side for every mutating route.
- **Critical transactional flows** have tests and predictable error responses.
- **Media and auth** configuration matches how Vite will call the API (CORS, cookies or bearer tokens).

After that, frontend work is mostly UI state, routing, and calling these contracts—not discovering missing rules or unstable payloads mid-build.
