<?php

namespace BrainGames\Math;

use Exception;

/**
 * @param int $minNum
 * @param int $maxNum
 * @return int
 */
function generateNum(int $minNum, int $maxNum): int
{
    try {
        return random_int($minNum, $maxNum);
    } catch (Exception $exception) {
        return generateNum($minNum, $maxNum);
    }
}

function isEven(int $num): bool
{
    return $num % 2 === 0;
}

function isPrime(int $num): bool
{
    if ($num === 1) {
        return false;
    }

    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i === 0) {
            return false;
        }
    }
    return true;
}


function generateAction(): string
{
    $availableActions = [
        '+',
        '-',
        '*',
    ];
    try {
        return $availableActions[random_int(0, count($availableActions) - 1)];
    } catch (Exception $exception) {
        return generateAction();
    }
}

/**
 * @param int $a
 * @param int $b
 * @return int
 */
function gcd(int $a, int $b): int
{
    return (bool)$b ? gcd($b, $a % $b) : $a;
}
