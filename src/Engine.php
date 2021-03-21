<?php

namespace BrainGames\Engine;

use function BrainGames\Game\createGame;
use function BrainGames\Game\start;

function play(): void
{
    $arguments = getopt('', ['game:']);
    $gameName = $arguments['game'] ?? null;
    $gameNamespaces = [
        'calc' => 'BrainGames\Games\GameCalc',
        'even' => 'BrainGames\Games\GameEven',
        'gcd' => 'BrainGames\Games\GameGcd',
        'progression' => 'BrainGames\Games\GameProgression',
        'prime' => 'BrainGames\Games\GamePrime',
    ];

    if (isset($gameName)) {
        $game = createGame(ANSWERS_TO_WIN, MAX_NUM);

        if (isset($gameNamespaces[$gameName])) {
            $configure = $gameNamespaces[$gameName] . '\configure';
            $configure($game);
        }
        start($game);
    }
}
