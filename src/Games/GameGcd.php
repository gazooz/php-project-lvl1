<?php

namespace BrainGames\Games\GameGcd;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function BrainGames\Math\gcd;
use function BrainGames\Math\generateNum;
use function cli\line;

/**
 * @param array $game
 * @return void
 */
function configure(array &$game): void
{
    $game = array_merge(
        $game,
        [
            'rules' => 'Find the greatest common divisor of given numbers.',
            'askQuestion' => 'BrainGames\Games\GameGcd\askQuestion'
        ]
    );
}

/**
 * @param $game
 */
function askQuestion(&$game): void
{
    $num1 = generateNum(1, getMaxNum($game));
    $num2 = generateNum(1, getMaxNum($game));
    line('Question: %s %s', $num1, $num2);

    $answer = askAnswer();
    $expectedAnswer = (string)gcd($num1, $num2);
    validateAnswer($game, $answer, $expectedAnswer);
}
