<?php

namespace BrainGames\Games;

use BrainGames\Game;
use Exception;

use function cli\line;

/**
 * Class GameEven
 * @package BrainGames\Games
 */
class GameEven extends Game
{

    private int $questionNum;

    protected function rules(): void
    {
        line('Answer "yes" if the number is even, otherwise answer "no".');
    }

    protected function askQuestion(): void
    {
        $num = $this->generateNum();
        $this->questionNum = $num;
        line('Question: %s', $num);
    }

    /**
     * @param mixed $answer
     * @return bool
     */
    protected function validateAnswer($answer): bool
    {
        $expectedAnswer = $this->isEven($this->questionNum) ? 'yes' : 'no';
        $isCorrectAnswer = $expectedAnswer === $answer;

        if ($isCorrectAnswer) {
            line('Correct!');
        } else {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $expectedAnswer);
        }

        return $isCorrectAnswer;
    }

    protected function isEven(int $num): bool
    {
        return $num % 2 === 0;
    }

    protected function generateNum(): int
    {
        try {
            return random_int(1, $this->maxNum);
        } catch (Exception $exception) {
            return $this->generateNum();
        }
    }
}
