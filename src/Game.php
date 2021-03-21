<?php

namespace BrainGames\Game;

use function cli\line;
use function cli\prompt;

/**
 * @param int $answersToWin
 * @param int $maxNum
 * @return array
 */
function createGame(int $answersToWin, int $maxNum = PHP_INT_MAX): array
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
 * @param array $game
 */
function start(array &$game): void
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
 * @param array $game
 */
function greet(array $game): void
{
    line('Hello, %s!', getName($game));
}

/**
 * @param array $game
 */
function rules(array $game): void
{
    line($game['rules']);
}

function askAnswer(): string
{
    return prompt('Your answer');
}

/**
 * @param array $game
 */
function congratulations(array $game): void
{
    line('Congratulations, %s!', getName($game));
}

/**
 * @param array $game
 */
function sendIncorrectAnswer(array $game): void
{
    line('Let\'s try again, %s!', getName($game));
}

/**
 * @param array $game
 * @return bool
 */
function continueGame(array $game): bool
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
 * @param array $game
 */
function askName(array &$game): void
{
    setName($game, prompt('May I have your name?'));
}

/**
 * @param array $game
 * @param string $name
 */
function setName(array &$game, string $name): void
{
    $game['name'] = (string)$name;
}

/**
 * @param array $game
 * @return string
 */
function getName(array $game): string
{
    return $game['name'];
}

/**
 * @param array $game
 * @return int
 */
function getCorrectAnswersInRow(array $game): int
{
    return $game['correctAnswersInRow'] ?? 0;
}

/**
 * @param array $game
 * @return int
 */
function getAnswersToWin(array $game): int
{
    return $game['answersToWin'] ;
}

/**
 * @param array $game
 * @return int
 */
function getMaxNum(array $game): int
{
    return $game['maxNum'];
}

/**
 * @param array $game
 * @param string $answer
 * @param string $expectedAnswer
 * @return void
 */
function validateAnswer(array &$game, string $answer, string $expectedAnswer): void
{
    $isCorrectAnswer = $expectedAnswer === $answer;

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
 * @param array $game
 */
function addCorrectAnswer(array &$game): void
{
    $game['correctAnswersInRow']++;
}

/**
 * @param array $game
 */
function addInCorrectAnswer(array &$game): void
{
    $game['isLost'] = true;
}
