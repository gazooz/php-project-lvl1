<?php

use BrainGames\Games\GameCalc;
use BrainGames\Games\GameEven;

return [
    'answersToWin' => 3,
    'games' => [
        'even' => GameEven::class,
        'calc' => GameCalc::class
    ],
    'maxNum' => 99
];
