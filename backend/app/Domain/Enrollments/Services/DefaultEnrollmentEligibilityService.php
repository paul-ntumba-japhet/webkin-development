<?php

namespace App\Domain\Enrollments\Services;

use App\Domain\Enrollments\Services\EnrollmentEligibilityServiceInterface;
use App\Domain\Enrollments\Repositories\EnrollmentRepositoryInterface;
use App\Domain\Programs\Repositories\ProgramRepositoryInterface;
use App\Domain\Cohorts\Repositories\CohortRepositoryInterface;
use App\Domain\Cohorts\Services\CohortCapacityServiceInterface;
use DomainException;

final class DefaultEnrollmentEligibilityService implements EnrollmentEligibilityServiceInterface
{
    public function __construct(
        private readonly EnrollmentRepositoryInterface $enrollments,
        private readonly ProgramRepositoryInterface $programs,
        private readonly CohortRepositoryInterface $cohorts,
        private readonly CohortCapacityServiceInterface $capacity,
    ) {
    }

    public function assertCanEnroll(int $studentId, int $programId, ?int $cohortId = null): void
    {
        if ($this->enrollments->findActiveForStudentAndProgram($studentId, $programId) !== null) {
            throw new DomainException('L’étudiant possède déjà une inscription active sur ce programme.');
        }

        $program = $this->programs->findById($programId);

        if ($program === null) {
            throw new DomainException('Programme introuvable.');
        }

        if ($cohortId !== null) {
            $cohort = $this->cohorts->findById($cohortId);

            if ($cohort === null || ! $this->capacity->hasAvailableSeat($cohort)) {
                throw new DomainException('La cohorte sélectionnée n’est pas disponible.');
            }
        }
    }
}
