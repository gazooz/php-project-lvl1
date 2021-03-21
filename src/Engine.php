<?php

namespace BrainGames\Engine;

use function BrainGames\Game\createGame;
use function BrainGames\Game\start;

function play(string $gameName, array $config): void
{
    $gameNamespaces = [
        'calc' => 'BrainGames\Games\GameCalc',
        'even' => 'BrainGames\Games\GameEven',
        'gcd' => 'BrainGames\Games\GameGcd',
        'progression' => 'BrainGames\Games\GameProgression',
        'prime' => 'BrainGames\Games\GamePrime',
    ];

    $game = createGame($config['answersToWin'], $config['maxNum']);

    if (isset($gameNamespaces[$gameName])) {
        $configure = $gameNamespaces[$gameName] . '\configure';
        if (!is_callable($configure)) {
            return;
        }
        $configure($game);
    }
    start($game);
}
