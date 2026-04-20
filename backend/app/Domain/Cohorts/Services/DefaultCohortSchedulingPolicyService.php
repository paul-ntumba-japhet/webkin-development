<?php

namespace App\Domain\Cohorts\Services;

use App\Domain\Cohorts\Services\CohortSchedulingPolicyServiceInterface;
use DomainException;

final class DefaultCohortSchedulingPolicyService implements CohortSchedulingPolicyServiceInterface
{
    public function assertSchedulable(array $rows): void
    {
        foreach ($rows as $row) {
            if (empty($row['day_of_week']) || empty($row['start_time']) || empty($row['end_time'])) {
                throw new DomainException('Chaque créneau doit définir day_of_week, start_time et end_time.');
            }

            if ($row['start_time'] >= $row['end_time']) {
                throw new DomainException('Un créneau possède une heure de fin antérieure ou égale à l’heure de début.');
            }
        }
    }
}
