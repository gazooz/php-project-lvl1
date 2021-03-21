<?php

namespace BrainGames\Games\GameCalc;

use Exception;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function BrainGames\Math\generateNum;
use function BrainGames\Math\generateAction;
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
            'rules' => 'What is the result of the expression?',
            'askQuestion' => 'BrainGames\Games\GameCalc\askQuestion'
        ]
    );
}

/**
 * @param $game
 */
function askQuestion(&$game): void
{
    $num1 = generateNum(getMaxNum($game));
    $num2 = generateNum(getMaxNum($game));
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

    $answer = askAnswer();
    $expectedAnswer = calcResult($action, $num1, $num2);
    validateAnswer($game, $answer, $expectedAnswer);
}

/**
 * @param $action
 * @param $num1
 * @param $num2
 * @return int|null
 */
function calcResult($action, $num1, $num2): ?int
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
            $result = null;
    }

    return $result;
}
