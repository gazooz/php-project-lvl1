<?php

namespace BrainGames;

use function cli\line;
use function cli\prompt;

/**
 * Class GameCalc
 * @package BrainGames\Games
 */
abstract class Game implements GameInterface
{
    protected int $maxNum = PHP_INT_MAX;
    protected int $answersToWin = 1;
    protected int $correctAnswersInRow = 0;
    protected string $name = 'Guest';

    abstract protected function rules(): void;
    abstract protected function askQuestion(): void;

    /**
     * @param mixed $answer
     * @return bool
     */
    abstract protected function validateAnswer($answer): bool;

    public function start(): void
    {
        $this->welcome();
        $this->askName();
        $this->greet();
        $this->rules();

        while ($this->correctAnswersInRow < $this->answersToWin) {
            $this->askQuestion();
            $answer = $this->askAnswer();
            if ($this->validateAnswer($answer)) {
                $this->correctAnswersInRow++;
            } else {
                $this->sendIncorrectAnswer();
                return;
            }
        }

        $this->congratulations();
    }

    public function withMaxNum(int $num): Game
    {
        $this->maxNum = $num;
        return $this;
    }

    public function withAnswersToWin(int $num): Game
    {
        $this->answersToWin = $num;
        return $this;
    }

    protected function welcome(): void
    {
        line('Welcome to the Brain Game!');
    }

    protected function askName(): void
    {
        $this->name = prompt('May I have your name?');
    }

    protected function greet(): void
    {
        line('Hello, %s!', $this->name);
    }

    protected function congratulations(): void
    {
        line('Congratulations, %s!', $this->name);
    }

    protected function askAnswer(): string
    {
        return prompt('Your answer');
    }

    protected function sendIncorrectAnswer(): void
    {
        line('Let\'s try again, %s!', $this->name);
    }
}