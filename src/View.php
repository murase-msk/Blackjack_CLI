<?php
/**
 *
 */
namespace src;

/**
 * 画面の表示に関するクラス
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
     * ディーラー,プレイヤーのハンドを表示する
     * @param array ディーラーのハンド
     * @param array プレイヤーのハンド
     * @return void
     */
    public function bothHand(array $dealerHand, array $playerHand) : void
    {
        $dealerHandString = "";
        foreach ($dealerHand as $key => $hand) {
            if ($hand['isFaceUp'] === true) {
                $dealerHandString .= $hand['mark'] . ":" . $hand['number'] . ', ';
            } else {
                $dealerHandString .= "blank, ";
            }
        }
        $dealerHandString = substr($dealerHandString, 0, -2);
        $playerHandString = "";
        foreach ($playerHand as $key => $hand) {
            $playerHandString .= $hand['mark'] . ":" . $hand['number'] . ', ';
        }
        $playerHandString = substr($playerHandString, 0, -2);
        echo '-------------' . PHP_EOL;
        echo 'Dealer: ' . $dealerHandString . PHP_EOL;
        echo 'Player: ' . $playerHandString . PHP_EOL;
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
     * ディーラーの裏向きのカードを表示する
     *
     * @param array $dealerHand
     * @return void
     */
    public function openBlankCard(array $dealerHand) : void
    {
        foreach ($dealerHand as $key => $card) {
            if ($card['isFaceUp'] === false) {
                echo 'Blank Card: ' . $card['mark'] . ':' . $card['number'] . PHP_EOL;
            }
        }
    }

    /**
     * プレイヤー・ディーラーの手札から結果を表示する
     * @param int
     * @param int
     * @return void
     */
    public function result(int $dealerValue, int $playerValue) : void
    {
        echo 'Dealer:' . $dealerValue . 'Plauer: ' . $playerValue . PHP_EOL;
        if ($dealerValue > $playerValue) {
            echo 'Dealer Win' . PHP_EOL;
        } elseif ($dealerValue < $playerValue) {
            echo 'Player Win' . PHP_EOL;
        } else {
            echo 'Draw' . PHP_EOL;
        }
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
