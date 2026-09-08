<?php

namespace App\Enums;

use Exception;

/**
 * Represents the possible letter grades.
 */
enum Grade {
    case A;
    case B;
    case C;
    case D;
    case F;
}

/**
 * Calculates a letter grade based on a numeric score ranging from 0 to 100.
 *
 * @param int $score The numeric mark to evaluate (must be between 0 and 100).
 * @return Grade The corresponding Grade enum based on the following score tiers:
 * - `90 - 100`: 'A'
 * - `80 - 89`: 'B'
 * - `70 - 79`: 'C'
 * - `60 - 69`: 'D'
 * - `0 - 59`: 'F'
 *
 * @throws Exception If the provided score is less than 0 or greater than 100.
 */
function getGrade(int $score): Grade
{
    if ($score < 0 || $score > 100) {
        throw new Exception('Score must be between 0 and 100');
    }

    if ($score >= 90) return Grade::A;
    if ($score >= 80) return Grade::B;
    if ($score >= 70) return Grade::C;
    if ($score >= 60) return Grade::D;

    return Grade::F;
}

test('example', function () {
    // Test implementation here
});