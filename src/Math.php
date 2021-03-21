<?php

namespace BrainGames\Math;

use Exception;

/**
 * @param int $maxNum
 * @return int
 */
function generateNum(int $maxNum): int
{
    try {
        return random_int(1, $maxNum);
    } catch (Exception $exception) {
        return generateNum($maxNum);
    }
}

function isEven(int $num): bool
{
    return $num % 2 === 0;
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
    return $b ? gcd($b, $a % $b) : $a;
}
