<?php

namespace BrainGames\Games;

use BrainGames\Game;
use Exception;

use function cli\line;

/**
 * Class GameEven
 * @package BrainGames\Games
 */
class GameCalc extends Game
{

    private int $questionNum1;
    private int $questionNum2;
    private string $questionAction;
    private array $availableActions = [
        '+',
        '-',
        '*'
    ];

    protected function rules(): void
    {
        line('Answer "yes" if the number is even, otherwise answer "no".');
    }

    protected function askQuestion(): void
    {
        $this->questionNum1 = $this->generateNum();
        $this->questionNum2 = $this->generateNum();
        $this->questionAction = $this->generateAction();
        $questionString = implode(
            ' ',
            [
                $this->questionNum1,
                $this->questionAction,
                $this->questionNum2,
            ]
        );
        line('Question: %s', $questionString);
    }

    /**
     * @param mixed $answer
     * @return bool
     */
    protected function validateAnswer($answer): bool
    {
        $expectedAnswer = $this->calcResult();
        $isCorrectAnswer = $expectedAnswer === (int) $answer;

        if ($isCorrectAnswer) {
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
        }

        return $isCorrectAnswer;
    }

    protected function calcResult(): ?int
    {
        switch ($this->questionAction) {
            case '+':
                $result = $this->questionNum1 + $this->questionNum2;
                break;
            case '-':
                $result = $this->questionNum1 - $this->questionNum2;
                break;
            case '*':
                $result = $this->questionNum1 * $this->questionNum2;
                break;
            default:
                $result = null;
        }

        return $result;
    }

    protected function generateNum(): int
    {
        try {
            return random_int(1, $this->maxNum);
        } catch (Exception $exception) {
            return $this->generateNum();
        }
    }

    protected function generateAction(): string
    {
        try {
            return $this->availableActions[random_int(0, count($this->availableActions) - 1)];
        } catch (Exception $exception) {
            return $this->generateAction();
        }
    }
}
