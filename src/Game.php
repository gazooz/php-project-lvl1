<?php

namespace BrainGames\Game;

use function cli\line;
use function cli\prompt;

/**
 * @param $answersToWin
 * @param int $maxNum
 * @return array
 */
function createGame($answersToWin, $maxNum = PHP_INT_MAX): array
{
    return [
        'answersToWin' => $answersToWin,
        'maxNum' => $maxNum,
        'correctAnswersInRow' => 0,
        'isLost' => false,
        'name' => 'Guest',
    ];
}

/**
 * @param $game
 */
function start(&$game): void
{
    welcome();
    askName($game);
    greet($game);
    rules($game);

    while (continueGame($game)) {
        $game['askQuestion']($game);
    }
}

function welcome(): void
{
    line('Welcome to the Brain Game!');
}

/**
 * @param $game
 */
function greet($game): void
{
    line('Hello, %s!', getName($game));
}

/**
 * @param array $game
 */
function rules(array $game)
{
    line($game['rules']);
}

function askAnswer(): string
{
    return prompt('Your answer');
}

/**
 * @param $game
 */
function congratulations($game): void
{
    line('Congratulations, %s!', getName($game));
}

/**
 * @param $game
 */
function sendIncorrectAnswer($game): void
{
    line('Let\'s try again, %s!', getName($game));
}

/**
 * @param $game
 * @return bool
 */
function continueGame($game): bool
{
    if ($game['isLost']) {
        sendIncorrectAnswer($game);
        return false;
    }

    if (getCorrectAnswersInRow($game) >= getAnswersToWin($game)) {
        congratulations($game);
        return false;
    }

    return true;
}

/**
 * @param $game
 */
function askName(&$game): void
{
    setName($game, prompt('May I have your name?'));
}

/**
 * @param $game
 * @param $name
 */
function setName(&$game, $name): void
{
    $game['name'] = (string)$name;
}

/**
 * @param $game
 * @return string
 */
function getName($game): string
{
    return $game['name'];
}

/**
 * @param $game
 * @return int
 */
function getCorrectAnswersInRow($game): int
{
    return $game['correctAnswersInRow'] ?? 0;
}

/**
 * @param $game
 * @return int
 */
function getAnswersToWin($game): int
{
    return $game['answersToWin'] ?? ANSWERS_TO_WIN;
}

/**
 * @param $game
 * @return int
 */
function getMaxNum($game): int
{
    return $game['maxNum'] ?? MAX_NUM;
}

/**
 * @param $game
 * @param $answer
 * @param $expectedAnswer
 * @return void
 */
function validateAnswer(&$game, $answer, $expectedAnswer): void
{
    $isCorrectAnswer = $expectedAnswer == $answer;

    if ($isCorrectAnswer) {
        line('Correct!');
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
    }

    if ($isCorrectAnswer) {
        addCorrectAnswer($game);
    } else {
        addInCorrectAnswer($game);
    }
}

/**
 * @param $game
 */
function addCorrectAnswer(&$game): void
{
    $game['correctAnswersInRow']++;
}

/**
 * @param $game
 */
function addInCorrectAnswer(&$game): void
{

    $game['isLost'] = true;
}
