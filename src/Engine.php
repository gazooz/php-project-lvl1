<?php

namespace BrainGames\Engine;

use function BrainGames\Game\createGame;
use function BrainGames\Game\start;

function play(): void
{
    $gameNamespaces = [
        'calc' => 'BrainGames\Games\GameCalc',
        'even' => 'BrainGames\Games\GameEven',
        'gcd' => 'BrainGames\Games\GameGcd',
        'progression' => 'BrainGames\Games\GameProgression',
        'prime' => 'BrainGames\Games\GamePrime',
    ];

    $arguments = getopt('', ['game:']);

    if (isset($arguments['game'])) {
        $gameName = $arguments['game'];
    } else {
        return;
    }

    if (isset($gameName)) {
        $game = createGame(ANSWERS_TO_WIN, MAX_NUM);

        if (isset($gameNamespaces[$gameName])) {
            $configure = $gameNamespaces[$gameName] . '\configure';
            if (!is_callable($configure)) {
                return;
            }
            $configure($game);
        }
        start($game);
    }
}
