<?php
/**
 *
 */
namespace src;

/**
 * 画面の表示に関するクラス
 *
 * @package Hoge
 * @method
 * @property
 * @uses
 * @version
 *
 * @xample
 * @typedef
 */
class View
{
    /**
     * ウェルカムページの表示する
     * @since
     * @param
     * @return 's':ゲーム画面へ, 'q':ゲーム終了
     * @throws
     *
     */
    public function welcomePage() : string
    {
        echo '$$$$$$$$$$$$$$$$$$$$$$$$$$' . PHP_EOL;
        echo 'Welcome to Blackjack Game' . PHP_EOL;
        echo 'input "s" to start game ' . PHP_EOL;
        echo 'input "q" to quit game ' . PHP_EOL;
        echo '$$$$$$$$$$$$$$$$$$$$$$$$$$' . PHP_EOL;
        $nextOperation = trim(fgets(STDIN));
        return $nextOperation;
    }

    /**
     * 手持ちのお金を表示する
     *
     * @param $cash 手持ちのお金
     * @return void
     */
    public function cash(int $cash) : void
    {
        echo 'Your cash: ' . $cash . PHP_EOL;
    }

    /**
     * ベットする金額の表示
     * @param void
     * @return int ベットする金額
     */
    public function betOperation() : int
    {
        echo 'Input Bet ';
        $bet = trim(fgets(STDIN));
        return $bet;
    }

    /**
     * プレイヤー、ディーラーのハンドを表示する
     * @param void
     * @return void
     */
    public function bothHand() : void
    {
        echo '-------------' . PHP_EOL;
        echo 'Dealer: xxx, xxx' . PHP_EOL;
        echo 'Player: xxx, xxx' . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    /**
     * 操作の説明画面を表示する
     * @param void
     * @return string
     */
    public function operation() : string
    {
        echo '-------------' . PHP_EOL;
        echo 's: Stand, h: Hit, e:Surrender' . PHP_EOL;
        echo '-------------' . PHP_EOL;
        $nextOperation = trim(fgets(STDIN));
        return $nextOperation;
    }

    /**
     * プレイヤー・ディーラーの手札から結果を表示する
     * @param void
     * @return void
     */
    public function result() : void
    {
        echo 'result' . PHP_EOL;
    }

    /**
     * １ゲーム終了後どうするかの表示画面
     *
     * @param
     * @return
     */
    public function isNext() : string
    {
        echo '-------------' . PHP_EOL;
        echo '"o":Once again, "q":Quit game' . PHP_EOL;
        echo '-------------' . PHP_EOL;
        $nextOperation = trim(fgets(STDIN));
        return $nextOperation;
    }
}
