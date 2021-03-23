<?php

namespace BrainGames\Engine;

use function BrainGames\Game\start;
use function cli\line;

use const BrainGames\Config\CONFIG;

function play(string $gameName): void
{
    $gameName = 'Game' . ucwords($gameName);
    $gameNamespace = "BrainGames\\Games\\{$gameName}";
    $config = CONFIG;
    if (!defined("{$gameNamespace}\\RULES") || !function_exists("{$gameNamespace}\\askQuestion")) {
        line('Game not found');
        return;
    }
    $config['rules'] = constant("{$gameNamespace}\\RULES");
    $config['question'] = "{$gameNamespace}\\askQuestion";
    start($config);
}
