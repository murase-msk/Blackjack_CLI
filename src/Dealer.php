<?php
/**
 *
 */
namespace src;

use src\Man;
use src\View;
use src\GameUtil;

/**
 * ディーラーに関するクラス
 */
class Dealer extends Man
{
    private $gameUtil;

    public function __construct(GameUtil $gameUtil)
    {
        parent::__construct();
        $this->gameUtil = $gameUtil;
    }

    /**
     * ディーラーの操作
     *
     * @return void
     */
    public function play(int $playerValue)
    {
        // 裏向きのカードを面に向ける.
        $this->hand[count($this->hand) - 1]['isFaceUp'] = true;
        View::displayHand($this->hand, 'Dealer', $this->evaluateHand());
        // ハンドの評価.
        // ハンドがプレイヤーより大きくなるまでヒットする.
        while ($this->evaluateHand() < $playerValue) {
            echo 'Hit ' . PHP_EOL;
            $isSuccess = $this->hit($this->gameUtil->pickOneCard(), true);
            View::displayHand($this->hand, 'Dealer', $this->evaluateHand());
            if ($isSuccess === true) {
                continue;
            } elseif ($isSuccess === false) {
                break;
            }
        }
    }
}
