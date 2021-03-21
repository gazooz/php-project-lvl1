<?php

namespace BrainGames\Games\GameEven;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function BrainGames\Math\generateNum;
use function BrainGames\Math\isEven;
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
            'rules' => 'Answer "yes" if the number is even, otherwise answer "no".',
            'askQuestion' => 'BrainGames\Games\GameEven\askQuestion'
        ]
    );
}

/**
 * @param array $game
 */
function askQuestion(array &$game): void
{
    $num = generateNum(1, getMaxNum($game));
    line('Question: %s', $num);

    $answer = askAnswer();
    $expectedAnswer = isEven($num) ? 'yes' : 'no';
    validateAnswer($game, $answer, $expectedAnswer);
}
