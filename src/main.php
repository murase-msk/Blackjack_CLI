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

//$view = new View();
$gameUtil = new GameUtil();
$player = new Player();
$dealer = new Dealer($gameUtil);

while (true) {
    // メイン画面.
    $command = View::welcomePage();

    if ($command === 's') {
        while (true) {
            // キャッシュ表示.
            View::cash(-1);
            // ベット処理.
            View::betOperation();
            // ディーラーは１枚表１枚裏、プレイヤーは２枚とも表.
            $dealer->receiveOneCard($gameUtil->pickOneCard(), true);
            $dealer->receiveOneCard($gameUtil->pickOneCard(), false);
            $player->receiveOneCard($gameUtil->pickOneCard(), true);
            $player->receiveOneCard($gameUtil->pickOneCard(), true);
            // 最初の2枚のカードを表示する.
            View::bothHand(
                $dealer->hand,
                $player->hand,
                $dealer->evaluateHand(),
                $player->evaluateHand()
            );
            // プレイヤーの操作.
            $isSuccess = true;
            while (true) {
                $nextOperation = View::operation();
                if ($nextOperation === 'h') {   // ヒット.
                    echo 'Hit ' . PHP_EOL;
                    $isSuccess = $player->hit($gameUtil->pickOneCard(), true);
                    if ($isSuccess === true) {
                        View::displayHand($player->hand, 'Player', $player->evaluateHand());
                        continue;
                    } else {
                        break;
                    }
                } elseif ($nextOperation === 's') { // スタンド.
                    echo 'Stand ' . PHP_EOL;
                    break;
                } else {
                    continue;
                }
            }
            if ($isSuccess === true) {
                $playerValue = $player->evaluateHand();
                // ディーラーの操作（自動）.
                $dealer->play($playerValue);
                // ディーラーのカード評価と結果.
                $dealerValue = $dealer->evaluateHand();
                $isPlayerWin = $gameUtil->isPlayerWin(
                    $dealer->evaluateHand(),
                    $player->evaluateHand()
                );
                // ディーラーの裏向きのカードを表にして結果を見る.
                View::openBlankCard($dealer->hand);
                View::result($dealerValue, $playerValue, $isPlayerWin);
            } else {
                View::burst($playerValue);
            }
            // 配当処理.
            // todo

            $quitGameFlg = false;
            $continueFlg = false;
            while (true) {
                $nextCommand = View::isNext();
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
                // 初期化処理.
                $player = new Player();
                $dealer = new Dealer($gameUtil);
                continue;
            }
        }
    } elseif ($command === 'q') {
        break;
    } else {
        continue;
    }
}
