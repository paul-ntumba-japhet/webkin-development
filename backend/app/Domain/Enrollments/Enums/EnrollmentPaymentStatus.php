<?php

namespace App\Domain\Enrollments\Enums;

enum EnrollmentPaymentStatus: string
{
    case UNPAID = 'unpaid';
    case PARTIAL = 'partial';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
}
