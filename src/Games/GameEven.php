<?php

namespace BrainGames\Games\GameEven;

use function BrainGames\Math\generateNum;
use function BrainGames\Math\isEven;
use function cli\line;

const RULES = 'What is the result of the expression?';

function askQuestion(array $config): string
{
    $num = generateNum(1, $config['maxNum']);
    line('Question: %s', $num);

    return isEven($num) ? 'yes' : 'no';
}
