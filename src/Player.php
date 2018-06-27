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
    private const DEFAULT_CASH = 100;
    public $cash = 0;
    public $bet = 0;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        parent::__construct();
        $this->cash = Player::DEFAULT_CASH;
    }

    // /**
    //  * キャッシュをベットする
    //  *
    //  * @return void
    //  */
    // public function bet(int $playerBet) : boolean
    // {
    //     $this->bet = $playerBet;
    //     $this->cash -= $playerBet;
    // }

    /**
     * サレンダーする
     *
     * @return void
     */
    public function surrender() : void
    {
        return;
    }

    /**
     * ベット金の処理
     */
    public function returnMoney() : void
    {
        return;
    }
}
