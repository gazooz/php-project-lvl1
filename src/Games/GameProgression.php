<?php

namespace BrainGames\Games\GameProgression;

use function BrainGames\Math\generateNum;
use function cli\line;

const RULES = 'What is the result of the expression?';
const PROGRESSION_MIN_LENGTH = 5;
const PROGRESSION_MAX_LENGTH = 10;

function askQuestion(array $config): string
{
    $length = generateNum(PROGRESSION_MIN_LENGTH, PROGRESSION_MAX_LENGTH);
    $difference = generateNum(1, $config['maxNum']);
    $start = generateNum(1, $config['maxNum']);

    $progression = [];

    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $difference * $i;
    }

    $key = array_rand($progression);
    $expectedAnswer = (string)$progression[$key];
    $progression[$key] = '..';

    line('Question: %s', implode(' ', $progression));

    return $expectedAnswer;
}
