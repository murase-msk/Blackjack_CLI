<?php
/**
 *
 */
namespace src;

/**
 * プレイヤーとディーラーの親クラス
 */
class Man
{
    /** @var array{
     *      @type array{
     *          'mark': string マーク
     *          'number': int 数字
     *          'isFaceUp': bool 表であるか
     *          }
     *      } 手持ちのカード*/
    public $hand;
    
    public function __construct()
    {
        $this->hand = array();
        $this->isFaceUp = array();
    }

    /**
     * スタンドする
     *
     * @return void
     */
    public function stand()
    {
        return;
    }

    /**
     * ヒットする
     * カードを１枚受け取る
     * ２１を超えたらバースト
     *
     * @return bool
     */
    public function hit(array $card) : boolean
    {
        $this->hand[] = $card;
        $isBurst = evaluateHand() < 0 ? true : false;
        return $isBurst;
    }

    /**
     * カードを1枚受け取る
     *
     * @param string $card
     * @param boolean $isFaceUp
     * @return void
     */
    public function receiveOneCard(array $card, bool $isFaceUp) : void
    {
        $card['isFaceUp'] = $isFaceUp;
        $this->hand[] = $card;
        return;
    }

    /**
     * 現在のカード状態を確認する
     *
     * @return int 現在のハンドの合計値を返す。バーストであれば-1
     */
    public function evaluateHand() : int
    {
        $handValue = 0;
        foreach ($this->hand as $key => $card) {
            $handValue += $card['number'] > 10 ? 10 : $card['number'];
        }
        if ($handValue > 21) {
            return -1;
        }
        return $handValue;
    }
}
