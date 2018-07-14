<?php
/**
 *
 */
namespace src;

use src\Man;

/**
 * プレイヤに関するクラス
 */
class Player extends Man
{
    /** @var int デフォルトの所持金 */
    private const DEFAULT_CASH = 100;
    /** @var int 所持金 */
    public $cash = 0;
    /** @var int 現在のベット金額 */
    public $bet = 0;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
        $this->cash = Player::DEFAULT_CASH;
    }

    // /**
    //  * サレンダーする
    //  *
    //  * @return void
    //  */
    // public function surrender() : void
    // {
    //     return;
    // }

    /**
     * 配当処理
     *
     * @param string $whoIsWin　誰が勝ったか('player' or 'dealer' or 'draw')
     * @return void
     */
    public function returnMoney(string $whoIsWin) : void
    {
        if ($whoIsWin === 'player') {
            $this->cash += $this->bet*2;
        } elseif ($whoIsWin === 'dealer') {
        } elseif ($whoIsWin === 'draw') {
            $this->cash += $this->bet;
            return;
        } else {
            throw new Exception('エラー');
        }
        return;
    }
}
