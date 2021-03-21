<?php

namespace BrainGames;

use function BrainGames\Game\createGame;
use function BrainGames\Game\start;
use function cli\line;

function play(): void
{
    $arguments = getopt('', ['game:']);
    $gameName = $arguments['game'] ?? null;

    if (isset($gameName)) {
        $game = createGame(ANSWERS_TO_WIN, MAX_NUM);
        switch ($gameName) {
            case 'calc':
                Games\GameCalc\configure($game);
                break;
            case 'even':
                Games\GameEven\configure($game);
                break;
            case 'gcd':
                Games\GameGcd\configure($game);
                break;
            default:
                line('Game not found');
                return;
        }
        start($game);
    }
}
