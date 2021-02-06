<?php

namespace BrainGames;

/**
 * Interface GameInterface
 * @package BrainGames
 */
interface GameInterface
{
    public function start(): void;
    public function withMaxNum(int $num): GameInterface;
    public function withAnswersToWin(int $num): GameInterface;
}
