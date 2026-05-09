# Remaining DTOs to Add

This file lists the DTOs that are still missing in `app/Application` (beyond current `IdentityAccess` and `Programs` DTOs), based on existing Eloquent models in `app/Models` and database migrations in `database/migrations`.

## Coverage status

- **Already covered:** `IdentityAccess`, `Programs`
- **Still missing:** Attendance, Assignments, Billing, Challenges, Cohorts, Communication, Curriculum, Enrollments, Leads, Media, Mentoring, Payments, Platform, Projects, SupportMessaging

---

## 1) Attendance

**Model references**
- `app/Models/Attendance.php`

**Migration references**
- `database/migrations/2026_03_28_192943_create_attendances_table.php`

**DTOs to add**
- `MarkAttendanceData`
- `BulkMarkAttendanceData`
- `UpdateAttendanceData`

---

## 2) Assignments

**Model references**
- `app/Models/Assignment.php`
- `app/Models/AssignmentSubmission.php`
- `app/Models/AssignmentReview.php`

**Migration references**
- `database/migrations/2026_03_28_192946_create_assignments_table.php`
- `database/migrations/2026_03_28_192947_create_assignment_submissions_table.php`
- `database/migrations/2026_03_28_192948_create_assignment_reviews_table.php`

**DTOs to add**
- `CreateAssignmentData`
- `UpdateAssignmentData`
- `PublishAssignmentData`
- `ArchiveAssignmentData`
- `SubmitAssignmentData`
- `ResubmitAssignmentData`
- `ReviewAssignmentSubmissionData`
- `UpdateAssignmentReviewData`

---

## 3) Billing

**Model references**
- `app/Models/EnrollmentBillingPeriod.php`
- `app/Models/Invoice.php`

**Migration references**
- `database/migrations/2026_03_28_183424_create_enrollment_billing_periods_table.php`
- `database/migrations/2026_03_28_183426_create_invoices_table.php`

**DTOs to add**
- `CreateEnrollmentBillingPeriodData`
- `UpdateEnrollmentBillingPeriodData`
- `CloseBillingPeriodData`
- `GenerateInvoiceData`
- `UpdateInvoiceData`
- `VoidInvoiceData`
- `MarkInvoiceAsPaidData`

---

## 4) Challenges

**Model references**
- `app/Models/Challenge.php`
- `app/Models/ChallengeSubmission.php`
- `app/Models/PointTransaction.php`

**Migration references**
- `database/migrations/2026_03_28_204528_create_challenges_table.php`
- `database/migrations/2026_03_28_204530_create_challenge_submissions_table.php`
- `database/migrations/2026_03_28_204531_create_point_transactions_table.php`

**DTOs to add**
- `CreateChallengeData`
- `UpdateChallengeData`
- `PublishChallengeData`
- `ArchiveChallengeData`
- `SubmitChallengeData`
- `ReviewChallengeSubmissionData`
- `AwardPointsData`
- `ReversePointsData`

---

## 5) Cohorts

**Model references**
- `app/Models/Cohort.php`
- `app/Models/CohortSchedule.php`
- `app/Models/CohortWeeklySchedule.php`
- `app/Models/Room.php`

**Migration references**
- `database/migrations/2026_03_28_174137_create_cohorts_table.php`
- `database/migrations/2026_03_29_122347_create_cohort_schedules_table.php`
- `database/migrations/2026_03_28_174138_create_cohort_weekly_schedules_table.php`
- `database/migrations/2026_03_28_174130_create_rooms_table.php`

**DTOs to add**
- `CreateCohortData`
- `UpdateCohortData`
- `ArchiveCohortData`
- `AssignProgramToCohortData`
- `CreateCohortScheduleData`
- `UpdateCohortScheduleData`
- `CreateCohortWeeklyScheduleData`
- `UpdateCohortWeeklyScheduleData`
- `CreateRoomData`
- `UpdateRoomData`

---

## 6) Communication

**Model references**
- `app/Models/ContactRequest.php`
- `app/Models/Notification.php`
- `app/Models/StudentQuestion.php`
- `app/Models/QuestionAnswer.php`

**Migration references**
- `database/migrations/2026_03_28_204523_create_contact_requests_table.php`
- `database/migrations/2026_03_28_204526_create_notifications_table.php`
- `database/migrations/2026_03_28_192952_create_student_questions_table.php`
- `database/migrations/2026_03_28_192953_create_question_answers_table.php`

**DTOs to add**
- `CreateContactRequestData`
- `UpdateContactRequestStatusData`
- `SendNotificationData`
- `MarkNotificationAsReadData`
- `AskStudentQuestionData`
- `AnswerStudentQuestionData`
- `UpdateQuestionAnswerData`

---

## 7) Curriculum

**Model references**
- `app/Models/StudentProgress.php`

**Migration references**
- `database/migrations/2026_03_28_192944_create_student_progress_table.php`

**DTOs to add**
- `UpdateStudentProgressData`
- `CompleteLessonProgressData`
- `ResetStudentProgressData`

---

## 8) Enrollments

**Model references**
- `app/Models/Enrollment.php`

**Migration references**
- `database/migrations/2026_03_28_183423_create_enrollments_table.php`

**DTOs to add**
- `CreateEnrollmentData`
- `UpdateEnrollmentData`
- `ApproveEnrollmentData`
- `RejectEnrollmentData`
- `CancelEnrollmentData`
- `ChangeEnrollmentPaymentStatusData`

---

## 9) Leads

**Model references**
- `app/Models/Lead.php`
- `app/Models/Testimonial.php`

**Migration references**
- `database/migrations/2026_03_28_204520_create_leads_table.php`
- `database/migrations/2026_03_28_204525_create_testimonials_table.php`

**DTOs to add**
- `CreateLeadData`
- `UpdateLeadData`
- `QualifyLeadData`
- `ArchiveLeadData`
- `CreateTestimonialData`
- `UpdateTestimonialData`
- `PublishTestimonialData`
- `ArchiveTestimonialData`

---

## 10) Media

**Model references**
- `app/Models/Media.php`

**Migration references**
- `database/migrations/2026_03_28_161058_create_media_table.php`

**DTOs to add**
- `UploadMediaData`
- `UpdateMediaMetadataData`
- `AttachMediaToEntityData`
- `DetachMediaFromEntityData`
- `DeleteMediaData`

---

## 11) Mentoring

**Model references**
- `app/Models/MentorshipSession.php`

**Migration references**
- `database/migrations/2026_03_28_192951_create_mentorship_sessions_table.php`

**DTOs to add**
- `CreateMentorshipSessionData`
- `UpdateMentorshipSessionData`
- `RescheduleMentorshipSessionData`
- `CancelMentorshipSessionData`
- `CompleteMentorshipSessionData`

---

## 12) Payments

**Model references**
- `app/Models/PaymentTransaction.php`

**Migration references**
- `database/migrations/2026_03_28_183425_create_payment_transactions_table.php`

**DTOs to add**
- `CreatePaymentTransactionData`
- `ConfirmPaymentTransactionData`
- `FailPaymentTransactionData`
- `RefundPaymentTransactionData`

---

## 13) Platform

**Model references**
- `app/Models/Setting.php`

**Migration references**
- `database/migrations/2026_03_28_204537_create_settings_table.php`

**DTOs to add**
- `CreateSettingData`
- `UpdateSettingData`
- `BulkUpdateSettingsData`

---

## 14) Projects

**Model references**
- `app/Models/StudentProject.php`
- `app/Models/ProjectMember.php`

**Migration references**
- `database/migrations/2026_03_28_192949_create_student_projects_table.php`
- `database/migrations/2026_03_28_192950_create_project_members_table.php`

**DTOs to add**
- `CreateStudentProjectData`
- `UpdateStudentProjectData`
- `ArchiveStudentProjectData`
- `AddProjectMemberData`
- `UpdateProjectMemberRoleData`
- `RemoveProjectMemberData`

---

## 15) SupportMessaging

**Model references**
- `app/Models/SupportConversation.php`
- `app/Models/SupportMessage.php`

**Migration references**
- `database/migrations/2026_03_28_204534_create_support_conversations_table.php`
- `database/migrations/2026_03_28_204535_create_support_messages_table.php`

**DTOs to add**
- `CreateSupportConversationData`
- `UpdateSupportConversationStatusData`
- `AssignSupportConversationData`
- `CreateSupportMessageData`
- `MarkSupportMessageAsReadData`

---

## Suggested directory structure

Create DTO folders to match bounded contexts, similar to existing style:

- `app/Application/Attendance/DTOs`
- `app/Application/Assignments/DTOs`
- `app/Application/Billing/DTOs`
- `app/Application/Challenges/DTOs`
- `app/Application/Cohorts/DTOs`
- `app/Application/Communication/DTOs`
- `app/Application/Curriculum/DTOs`
- `app/Application/Enrollments/DTOs`
- `app/Application/Leads/DTOs`
- `app/Application/Media/DTOs`
- `app/Application/Mentoring/DTOs`
- `app/Application/Payments/DTOs`
- `app/Application/Platform/DTOs`
- `app/Application/Projects/DTOs`
- `app/Application/SupportMessaging/DTOs`

## Recommended implementation order

1. **Core transactional flow:** `Enrollments`, `Payments`, `Billing`
2. **Learning flow:** `Cohorts`, `Assignments`, `Curriculum`, `Attendance`
3. **Engagement flow:** `Communication`, `SupportMessaging`, `Mentoring`
4. **Portfolio & growth:** `Projects`, `Challenges`, `Leads`, `Media`, `Platform`

