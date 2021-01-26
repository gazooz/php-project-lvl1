<?php

namespace BrainGames;

/**
 * Class Engine
 * @package BrainGames
 */
class Engine
{
    private int $answersToWin;
    private array $games;

    public function __construct(array $config)
    {
        foreach ($config as $param => $value) {
            if (property_exists($this, $param)) {
                $this->$param = $value;
            }
        }
    }

    public function play(): void
    {
        $arguments = getopt('', ['game:']);
        $gameName = $arguments['game'] ?? null;

        if (isset($gameName, $this->games[$gameName]) && class_exists($gameClass = $this->games[$gameName])) {
            /** @var GameInterface $game */
            $game = new $gameClass();
            $game->startGame($this->answersToWin);
        }
    }
}
