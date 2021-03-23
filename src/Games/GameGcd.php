<?php

namespace BrainGames\Games\GameGcd;

use function BrainGames\Math\gcd;
use function BrainGames\Math\generateNum;
use function cli\line;

const RULES = 'What is the result of the expression?';

function askQuestion(array $config): string
{
    $num1 = generateNum(1, $config['maxNum']);
    $num2 = generateNum(1, $config['maxNum']);
    line('Question: %s %s', $num1, $num2);

    return (string)gcd($num1, $num2);
}
