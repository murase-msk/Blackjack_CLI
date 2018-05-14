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

$view = new View();
$gameUtil = new GameUtil();
$player = new Player();
$dealer = new Dealer();

while (true) {
    // メイン画面.
    $command = $view->welcomePage();

    if ($command === 's') {
        // .
        $view->cash(-1);
        // .
        $view->betOperation();
        // ディーラーは１枚表１枚裏、プレイヤーは２枚とも表.
        $dealer->receiveOneCard($gameUtil->pickOneCard(), true);
        $dealer->receiveOneCard($gameUtil->pickOneCard(), false);
        $player->receiveOneCard($gameUtil->pickOneCard(), true);
        $player->receiveOneCard($gameUtil->pickOneCard(), true);
        // .
        $view->bothHand($dealer->hand, $player->hand);
        // .
//        $view->operation();
        // ディーラーの裏向きのカードを表にして結果を見る.
        $view->openBlankCard($dealer->hand);
        $view->result($dealer->evaluateHand(), $player->evaluateHand());
        $nextCommand = $view->isNext();
        if ($nextCommand === 'o') {
            continue;
        }
        break;
    } elseif ($command === 'q') {
        break;
    }
}
