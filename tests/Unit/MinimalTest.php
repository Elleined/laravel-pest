<?php

use App\Grade;
use Exception;

/**
 * Calculates a letter grade based on a numeric score ranging from 0 to 100.
 *
 * @param  int  $score  The numeric mark to evaluate (must be between 0 and 100).
 * @return Grade The corresponding Grade enum based on the following score tiers:
 *               - `90 - 100`: 'A'
 *               - `80 - 89`: 'B'
 *               - `70 - 79`: 'C'
 *               - `60 - 69`: 'D'
 *               - `0 - 59`: 'F'
 *
 * @throws Exception If the provided score is less than 0 or greater than 100.
 */
function getGrade(int $score): Grade
{
    if ($score < 0 || $score > 100) {
        throw new Exception('Score must be between 0 and 100');
    }

    if ($score >= 90) {
        return Grade::A;
    }
    if ($score >= 80) {
        return Grade::B;
    }
    if ($score >= 70) {
        return Grade::C;
    }
    if ($score >= 60) {
        return Grade::D;
    }

    return Grade::F;
}

describe('MinimalTest', function () {
    describe('Happy paths', function () {
        test('90+ should return A', function () {
            $grade = getGrade(90);
            expect($grade)->toBe(Grade::A);
        });

        test('80+ should return B', function () {
            $grade = getGrade(80);
            expect($grade)->toBe(Grade::B);
        });

        test('70+ should return C', function () {
            $grade = getGrade(70);
            expect($grade)->toBe(Grade::C);
        });

        test('60+ should return D', function () {
            $grade = getGrade(60);
            expect($grade)->toBe(Grade::D);
        });

        test('50+ should return F', function () {
            $grade = getGrade(50);
            expect($grade)->toBe(Grade::F);
        });
    });

    describe('Parameterized tests', function () {
        test('should return A', function (int $num) {
            $grade = getGrade($num);
            expect($grade)->toBe(Grade::A);
        })->with([90, 91, 92, 93, 94, 95, 96, 97, 98, 99]);

        test('should return B', function (int $num) {
            $grade = getGrade($num);
            expect($grade)->toBe(Grade::B);
        })->with([80, 81, 82, 83, 84, 85, 86, 87, 88, 89]);

        test('should return C', function (int $num) {
            $grade = getGrade($num);
            expect($grade)->toBe(Grade::C);
        })->with([70, 71, 72, 73, 74, 75, 76, 77, 78, 79]);

        test('should return D', function (int $num) {
            $grade = getGrade($num);
            expect($grade)->toBe(Grade::D);
        })->with([60, 61, 62, 63, 64, 65, 66, 67, 68, 69]);

        test('should return F', function (int $num) {
            $grade = getGrade($num);
            expect($grade)->toBe(Grade::F);
        })->with([50, 51, 52, 53, 54, 55, 56, 57, 58, 59]);
    });

    describe('Error path testing', function () {
        test('Should throw an error if score: %d', function (int $score) {
            expect(fn () => getGrade($score))->toThrow('Score must be between 0 and 100');
        })->with([-1, 101]);
    });

    describe('Edge case testing', function () {
        test('0 should return F', function () {
            $grade = getGrade(0);
            expect($grade)->toBe(Grade::F);
        });

        test('100 should return A', function () {
            $grade = getGrade(100);
            expect($grade)->toBe(Grade::A);
        });
    });
});
