<?php

namespace BrainGames\Games\GameCalc;

use function BrainGames\Math\generateAction;
use function BrainGames\Math\generateNum;
use function cli\line;

const RULES = 'What is the result of the expression?';

function askQuestion($config): string
{
    $num1 = generateNum(1, $config['maxNum']);
    $num2 = generateNum(1, $config['maxNum']);
    $action = generateAction();
    $questionString = implode(
        ' ',
        [
            $num1,
            $action,
            $num2,
        ]
    );
    line('Question: %s', $questionString);

    return (string)calcResult($action, $num1, $num2);
}

function calcResult(string $action, int $num1, int $num2): ?int
{
    switch ($action) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        default:
            return null;
    }

    return $result;
}
