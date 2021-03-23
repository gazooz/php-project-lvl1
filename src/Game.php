<?php

namespace BrainGames\Game;

use function cli\line;
use function cli\prompt;

function start(array $config): void
{
    $answersToWin = $config['answersToWin'];
    $rules = $config['rules'];
    $question = $config['question'];
    $correctAnswersInRow = 0;

    welcome();

    $name = askName();
    greet($name);

    sendRules($rules);

    while ($answersToWin > $correctAnswersInRow) {
        $expectedAnswer = $question($config);
        $answer = askAnswer();
        if (validateAnswer($answer, $expectedAnswer)) {
            $correctAnswersInRow++;
        } else {
            sendIncorrectAnswer($name);
            return;
        }
    }

    congratulations($name);
}

function welcome(): void
{
    line('Welcome to the Brain Game!');
}

function greet(string $name): void
{
    line('Hello, %s!', $name);
}

function sendRules(string $rules): void
{
    line($rules);
}

function askAnswer(): string
{
    return prompt('Your answer');
}

function congratulations(string $name): void
{
    line('Congratulations, %s!', $name);
}

function sendIncorrectAnswer(string $name): void
{
    line('Let\'s try again, %s!', $name);
}

function askName(): string
{
    return prompt('May I have your name?');
}

function validateAnswer(string $answer, string $expectedAnswer): bool
{
    $isCorrectAnswer = $expectedAnswer === $answer;

    if ($isCorrectAnswer) {
        line('Correct!');
        return true;
    }

    line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
    return false;
}
