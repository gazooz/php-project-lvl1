<?php

namespace BrainGames\Games\GamePrime;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function BrainGames\Math\generateNum;
use function BrainGames\Math\isPrime;
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
            'rules' => 'Answer "yes" if the number is prime, otherwise answer "no".',
            'askQuestion' => 'BrainGames\Games\GamePrime\askQuestion'
        ]
    );
}

/**
 * @param $game
 */
function askQuestion(&$game): void
{
    $num = generateNum(1, getMaxNum($game));
    line('Question: %s', $num);

    $answer = askAnswer();
    $expectedAnswer = isPrime($num) ? 'yes' : 'no';
    validateAnswer($game, $answer, $expectedAnswer);
}
