<?php

namespace BrainGames\Games\GameEven;

use Exception;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function cli\line;

/**
 * @param $game
 * @return void
 */
function configure(&$game): void
{
    $game = array_merge(
        $game,
        [
            'rules' => 'Answer "yes" if the number is even, otherwise answer "no".',
            'askQuestion' => 'BrainGames\Games\GameEven\askQuestion'
        ]
    );
}

/**
 * @param $game
 */
function askQuestion(&$game): void
{
    $num = generateNum(getMaxNum($game));
    line('Question: %s', $num);

    $answer = askAnswer();
    $expectedAnswer = isEven($num) ? 'yes' : 'no';
    validateAnswer($game, $answer, $expectedAnswer);
}

/**
 * @param $maxNum
 * @return int
 */
function generateNum($maxNum): int
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
