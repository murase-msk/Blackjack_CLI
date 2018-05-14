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
        while (true) {
            // キャッシュ表示.
            $view->cash(-1);
            // ベット処理.
            $view->betOperation();
            // ディーラーは１枚表１枚裏、プレイヤーは２枚とも表.
            $dealer->receiveOneCard($gameUtil->pickOneCard(), true);
            $dealer->receiveOneCard($gameUtil->pickOneCard(), false);
            $player->receiveOneCard($gameUtil->pickOneCard(), true);
            $player->receiveOneCard($gameUtil->pickOneCard(), true);
            // 最初の2枚のカードを表示する.
            $view->bothHand($dealer->hand, $player->hand);
            // プレイヤーの操作.
            $isBurst = false;
            while (true) {
                $nextOperation = $view->operation();
                if ($nextOperation === 'h') {   // ヒット.
                    echo 'Hit ' . PHP_EOL;
                    $isBurst = $player->hit($gameUtil->pickOneCard(), true);
                    if ($isBurst === false) {
                        $view->playerHand($player->hand);
                        continue;
                    } else {
                        break;
                    }
                } elseif ($nextOperation === 's') {
                    echo 'Stand ' . PHP_EOL;
                    break;
                } else {
                    continue;
                }
            }
            // ディーラーの操作（自動）.
            // todo.

            // プレイヤー、ディーラーのカード評価と結果.
            $dealerValue = $dealer->evaluateHand();
            $playerValue = $player->evaluateHand();
            $isPlayerWin = $gameUtil->isPlayerWin(
                $dealer->evaluateHand(),
                $player->evaluateHand()
            );
            if ($isBurst === false) {
                // ディーラーの裏向きのカードを表にして結果を見る.
                $view->openBlankCard($dealer->hand);
                $view->result($dealerValue, $playerValue, $isPlayerWin);
            } else {
                $view->burst($playerValue);
            }
            // 配当処理.
            // todo

            $quitGameFlg = false;
            $continueFlg = false;
            while (true) {
                $nextCommand = $view->isNext();
                if ($nextCommand === 'c') {
                    $continueFlg = true;
                    break;
                } elseif ($nextCommand === 'q') {
                    $quitGameFlg = true;
                    break;
                } else {
                    continue;
                }
            }
            if ($quitGameFlg) {
                break;
            }
            if ($continueFlg) {
                continue;
            }
        }
    } elseif ($command === 'q') {
        break;
    } else {
        continue;
    }
}
