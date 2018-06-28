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
    // public function stand()
    // {
    //     return;
    // }

    /**
     * ヒットする
     * カードを１枚受け取る
     * ２１を超えたらバースト
     *
     * @param array $card 受け取ったカード
     * @param bool $isFaceUp
     * @return bool 成功したか
     */
    public function hit(array $card, bool $isFaceUp) : bool
    {
        $this->receiveOneCard($card, $isFaceUp);
        $isSuccess = $this->evaluateHand() < 0 ? false : true;
        return $isSuccess;
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
        // ACEは21を超えていなければ11, そうでなければ1.
        $handValue = 0;
        foreach ($this->hand as $key => $card) {
            $handValue += $card['number'] > GameUtil::TEN ? GameUtil::TEN : $card['number'];
        }
        // エースを11とみなしてもバーストしなければエースを11とする.
        foreach ($this->hand as $key => $card) {
            if ($card['number'] === GameUtil::ACE && $handValue + 10 <= 21) {
                $handValue += 10;   // 1はすでに足しているので10を足す.
            }
        }
        if ($handValue > 21) {
            return -1;
        }
        return $handValue;
    }

    /**
     * ハンドをリセットする
     *
     * @return void
     */
    public function resetHand() : void
    {
        $this->hand = array();
        $this->isFaceUp = array();
    }
}
