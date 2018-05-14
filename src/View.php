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
     * @return 's':ゲーム画面へ, 'q':ゲーム終了
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
        echo '-------------' . PHP_EOL;
        echo 'Dealer: ' . $this->returnHandText('Dealer', $dealerHand) . PHP_EOL;
        echo 'Player: ' . $this->returnHandText('Player', $playerHand) . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    /**
     * ,プレイヤーのハンドを表示する
     *
     * @param array $playerHand
     * @return void
     */
    public function playerHand(array $playerHand) : void
    {
        echo '-------------' . PHP_EOL;
        echo 'Player: ' . $this->returnHandText('Player', $playerHand) . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    /**
     * ハンドをテキスト形式で返す
     *
     * @param string $name 表示する名前（Dealer or Player）
     * @param array $hand ハンド
     * @return string
     */
    private function returnHandText(string $name, array $oneHand) : string
    {
        $handString = "";
        foreach ($oneHand as $key => $hand) {
            if ($hand['isFaceUp'] === true) {
                $handString .= $hand['mark'] . ":" . $hand['number'] . ', ';
            } else {
                $handString .= "blank, ";
            }
        }
        $handString = substr($handString, 0, -2);
        return $handString;
    }

    /**
     * 操作の説明画面を表示する
     * @param void
     * @return string 入力文字
     */
    public function operation() : string
    {
        echo '-------------' . PHP_EOL;
        echo 's: Stand, h: Hit, e:Surrender' . PHP_EOL;
        echo '-------------' . PHP_EOL;
        echo 'Input your next command: ';
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
     * バーストとなった画面
     *
     * @param integer $playerValue プレイヤーのハンドの合計値
     * @return void
     */
    public function burst(int $playerValue) : void
    {
        echo 'Your hand is burst' . PHP_EOL;
        echo 'Player: ' . $playerValue . PHP_EOL;
    }

    /**
     * プレイヤー・ディーラーの手札から結果を表示する
     *
     * @param integer $dealerValue
     * @param integer $playerValue
     * @param integer $result
     * @return void
     */
    public function result(int $dealerValue, int $playerValue, int $result) : void
    {
        echo 'Dealer:' . $dealerValue . 'Plauer: ' . $playerValue . PHP_EOL;
        if ($result === -1) {
            echo 'Dealer Win' . PHP_EOL;
        } elseif (result === 1) {
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
        echo '"c":Continue, "q":Quit game' . PHP_EOL;
        echo '-------------' . PHP_EOL;
        $nextOperation = trim(fgets(STDIN));
        return $nextOperation;
    }
}
