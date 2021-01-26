<?php

namespace BrainGames;

/**
 * Interface GameInterface
 * @package BrainGames
 */
interface GameInterface
{
    /**
     * @param int $answersToWin
     */
    public function startGame(int $answersToWin): void;
}
