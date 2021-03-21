<?php

namespace BrainGames\Games\GameProgression;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function BrainGames\Math\generateNum;
use function cli\line;

define('PROGRESSION_MIN_LENGTH', 5);
define('PROGRESSION_MAX_LENGTH', 10);

/**
 * @param array $game
 * @return void
 */
function configure(array &$game): void
{
    $game = array_merge(
        $game,
        [
            'rules' => 'What number is missing in the progression?',
            'askQuestion' => 'BrainGames\Games\GameProgression\askQuestion'
        ]
    );
}

/**
 * @param array $game
 */
function askQuestion(array &$game): void
{
    $length = generateNum(PROGRESSION_MIN_LENGTH, PROGRESSION_MAX_LENGTH);
    $difference = generateNum(1, getMaxNum($game));
    $start = generateNum(1, getMaxNum($game));

    $progression = [];

    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $difference * $i;
    }

    $key = array_rand($progression);
    $expectedAnswer = (string)$progression[$key];
    $progression[$key] = '..';

    line('Question: %s', implode(' ', $progression));

    $answer = askAnswer();
    validateAnswer($game, $answer, $expectedAnswer);
}
