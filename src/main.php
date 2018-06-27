<?php
/**
 *
 */
namespace src;

require_once __DIR__ . '/../vendor/autoload.php';

use src\View;
use src\GameUtil;
use src\Player;
use src\Delaer;
use src\Game;

//$view = new View();
$gameUtil = new GameUtil();
$player = new Player();
$dealer = new Dealer($gameUtil);

$gameEndFlg = false;
do {
    $game = new Game($gameUtil, $player, $dealer);
    $game->start();
    $gameEndFlg = $game->gameEndFlg;
} while ($gameEndFlg === false);
