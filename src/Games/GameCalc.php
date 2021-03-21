<?php

namespace BrainGames\Games\GameCalc;

use function BrainGames\Game\askAnswer;
use function BrainGames\Game\getMaxNum;
use function BrainGames\Game\validateAnswer;
use function BrainGames\Math\generateAction;
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
            'rules' => 'What is the result of the expression?',
            'askQuestion' => 'BrainGames\Games\GameCalc\askQuestion'
        ]
    );
}

/**
 * @param array $game
 */
function askQuestion(array &$game): void
{
    $num1 = generateNum(1, getMaxNum($game));
    $num2 = generateNum(1, getMaxNum($game));
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
    $expectedAnswer = (string)calcResult($action, $num1, $num2);
    validateAnswer($game, $answer, $expectedAnswer);
}

/**
 * @param string $action
 * @param int $num1
 * @param int $num2
 * @return int|null
 */
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

    return (int)$result;
}
