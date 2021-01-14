<?php

namespace Brain\Games\Games\GameEven;

use Exception;

use function cli\line;
use function cli\prompt;

/**
 * @param int $answersToWin
 * @throws Exception
 */
function play(int $answersToWin): void
{
    welcome();
    $name = askName();
    greet($name);
    rules();

    $correctAnswersInRow = 0;
    while ($correctAnswersInRow < $answersToWin) {
        $num = generateNum();
        askQuestion($num);
        $answer = askAnswer();
        if (validateAnswer($num, $answer)) {
            $correctAnswersInRow++;
        } else {
            line('Let\'s try again, %s!', $name);
            return;
        }
    }

    congratulations($name);
}

function welcome(): void
{
    line('Welcome to the Brain Game!');
}

function askName(): string
{
    return prompt('May I have your name?');
}

function greet(string $name): void
{
    line('Hello, %s!', $name);
}

function rules(): void
{
    line('Answer "yes" if the number is even, otherwise answer "no".');
}

function congratulations(string $name): void
{
    line('Congratulations, %s!', $name);
}

/**
 * @param int $num
 */
function askQuestion(int $num): void
{
    line('Question: %s', $num);
}

function validateAnswer(int $num, string $answer): bool
{
    $expectedAnswer = isEven($num) ? 'yes' : 'no';
    $isCorrectAnswer = $expectedAnswer === $answer;

    if ($isCorrectAnswer) {
        line('Correct!');
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
    }

    return $isCorrectAnswer;
}

function askAnswer(): string
{
    return prompt('Your answer');
}

function generateNum(): int
{
    try {
        return random_int(1, PHP_INT_MAX);
    } catch (Exception $exception) {
        return generateNum();
    }
}

function isEven(int $num): bool
{
    return $num % 2 === 0;
}
