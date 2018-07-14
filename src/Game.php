<?php
/**
 *
 */
namespace src;

use src\Man;
use src\View;
use src\GameUtil;

/**
 * ゲームに関するクラス
 */
class Game
{
    private $gameUtil;
    private $player;
    private $dealer;
    public $gameEndFlg;

    public function __construct(GameUtil $gameUtil, Man $player, Man $dealer)
    {
//        parent::__construct();
        $this->gameUtil = $gameUtil;
        $this->player = $player;
        $this->dealer = $dealer;
        $this->gameEndFlg = false;
    }

    public function start() : void
    {
        // メイン画面.
        $command = View::welcomePage();

        if ($command === 's') {
            while (true) {
                // キャッシュ表示.
                View::cash($this->player->cash);
                // ベット処理.
                $this->player->bet = View::betOperation($this->player->cash);
                $this->player->cash -= $this->player->bet;
                // ディーラーは１枚表１枚裏、プレイヤーは２枚とも表.
                $this->dealer->receiveOneCard($this->gameUtil->pickOneCard(), true);
                $this->dealer->receiveOneCard($this->gameUtil->pickOneCard(), false);
                $this->player->receiveOneCard($this->gameUtil->pickOneCard(), true);
                $this->player->receiveOneCard($this->gameUtil->pickOneCard(), true);
                // 最初の2枚のカードを表示する.
                View::bothHand(
                    $this->dealer->hand,
                    $this->player->hand,
                    $this->dealer->evaluateHand(),
                    $this->player->evaluateHand()
                );
                // プレイヤーの操作.
                $isSuccess = true;
                while (true) {
                    $nextOperation = View::operation();
                    if ($nextOperation === 'h') {   // ヒット.
                        echo 'Hit ' . PHP_EOL;
                        $isSuccess = $this->player->hit($this->gameUtil->pickOneCard(), true);
                        if ($isSuccess === true) {
                            View::displayHand($this->player->hand, 'Player', $this->player->evaluateHand());
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
                $playerValue = $this->player->evaluateHand();
                $whoIsWin = 'dealer';
                if ($isSuccess === true) {
                    // ディーラーの操作（自動）.
                    $this->dealer->play($playerValue);
                    // ディーラーのカード評価と結果.
                    $dealerValue = $this->dealer->evaluateHand();
                    $whoIsWin = $this->gameUtil->whoIsWin(
                        $this->dealer->evaluateHand(),
                        $this->player->evaluateHand()
                    );
                    // ディーラーの裏向きのカードを表にして結果を見る.
                    View::openBlankCard($this->dealer->hand);
                    View::result($dealerValue, $playerValue, $whoIsWin);
                } else {
                    View::burst($this->player->hand, 'Player', $this->player->evaluateHand());
                }
                // 配当処理.
                // todo
                $this->player->returnMoney($whoIsWin);

                // コンティニュー処理.
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
                    $this->player->resetHand();
                    $this->dealer->resetHand();
                    continue;
                }
            }
        } elseif ($command === 'q') {
            $this->gameEndFlg = true;
            return;
        }
    }
}
