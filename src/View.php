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
    /**テストコード実行中であるか */
    static private $isTest = false;
    /** ベット入力（テスト用） */
    static private $testInputBet;
    /** ゲームスタートの入力コマンド（テスト用） */
    static private $testInputOperationWelcome;
    /** スタンド・ヒット入力（テスト用） */
    static private $testInputOperation;
    /** ゲームを継続するかの入力コマンド（テスト用） */
    static private $testInputOperationContinue;
    /**
     * Undocumented function
     */
    public function __construct()
    {
        return;
    }

    /**
     * ウェルカムページの表示する
     * @return 's':ゲーム画面へ, 'q':ゲーム終了
     */
    public static function welcomePage() : string
    {
        if (!View::$isTest) {
            echo exec('clear');
        }
        echo '$$$$$$$$$$$$$$$$$$$$$$$$$$' . PHP_EOL;
        echo 'Welcome to Blackjack Game' . PHP_EOL;
        echo 'input "s" to start game ' . PHP_EOL;
        echo 'input "q" to quit game ' . PHP_EOL;
        echo '$$$$$$$$$$$$$$$$$$$$$$$$$$' . PHP_EOL;
        $nextOperation =
            !View::$isTest ? trim(fgets(STDIN)) : View::$testInputOperationWelcome;
        return $nextOperation;
    }

    /**
     * 手持ちのお金を表示する
     *
     * @param $cash 手持ちのお金
     * @return void
     */
    public static function cash(int $cash) : void
    {
        if (!View::$isTest) {
            echo exec('clear');
        }
        echo 'Your cash: ' . $cash . PHP_EOL;
    }

    /**
     * ベットする金額の表示
     * @param void
     * @return int ベットする金額
     */
    public static function betOperation(int $cash) : int
    {
        $bet = 0;
        while (true) {
            echo 'Input Bet ';
            $bet = !View::$isTest ? trim(fgets(STDIN)) : View::$testInputBet;
            if (!ctype_digit($bet)) {
                echo 'Your input is invalid' . PHP_EOL;
            } elseif (intval($bet) > $cash) {
                echo 'Your max bet is ' . $cash . PHP_EOL;
            } else {
                break;
            }
        }
        return $bet;
    }

    /**
     * ディーラー,プレイヤーのハンドを表示する
     * @param array ディーラーのハンド
     * @param array プレイヤーのハンド
     * @param int ディーラーのハンド合計値
     * @param int プレイヤーのハンド合計値
     * @return void
     */
    public static function bothHand(
        array $dealerHand,
        array $playerHand,
        int $dealerTotal,
        int $playerTotal
    ) : void {
        echo '-------------' . PHP_EOL;
        echo 'Dealer:' . View::returnHandText($dealerHand) . PHP_EOL;
        echo 'Player:' . View::returnHandText($playerHand) . ' (total ' . $playerTotal . ')' . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    /**
     * ,ハンドを表示する
     *
     * @param array $playerHand
     * @param string プレイヤー or ディーラー
     * @param int ハンドの合計値
     * @return void
     */
    public static function displayHand(array $hand, string $name, int $total) : void
    {
        echo '-------------' . PHP_EOL;
        echo '' . $name . ': total ' . $total . ' :' . View::returnHandText($hand) . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }

    /**
     * ハンドをテキスト形式で返す
     *
     * @param string $name 表示する名前（Dealer or Player）
     * @param array $hand ハンド
     * @return string
     */
    private static function returnHandText(array $oneHand) : string
    {
        $handString = "";
        foreach ($oneHand as $key => $hand) {
            if ($hand['isFaceUp'] === true) {
                switch ($hand['number']) {
                    case GameUtil::ACE:
                        $hand['number'] = 'A';
                        break;
                    case GameUtil::JACK:
                        $hand['number'] = 'J';
                        break;
                    case GameUtil::QUEEN:
                        $hand['number'] = 'Q';
                        break;
                    case GameUtil::KING:
                        $hand['number'] = 'K';
                        break;
                }
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
    public static function operation() : string
    {
        echo '-------------' . PHP_EOL;
        echo 's: Stand, h: Hit, e:Surrender' . PHP_EOL;
        echo '-------------' . PHP_EOL;
        echo 'Input your next command: ';
        $nextOperation =
            !View::$isTest ? trim(fgets(STDIN)) : View::$testInputOperation;
        return $nextOperation;
    }

    /**
     * ディーラーの裏向きのカードを表示する
     *
     * @param array $dealerHand
     * @return void
     */
    public static function openBlankCard(array $dealerHand) : void
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
    public static function burst(int $playerValue) : void
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
    public static function result(int $dealerValue, int $playerValue, string $result) : void
    {
        if ($dealerValue === -1) {
            $dealerValue = 'Burst';
        } elseif ($playerValue === -1) {
            $playerValue = 'Burst';
        }
        echo 'Dealer:' . $dealerValue . ' Plauer: ' . $playerValue . PHP_EOL;
        if ($result === 'dealer') {
            echo 'Dealer Win' . PHP_EOL;
        } elseif ($result === 'player') {
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
    public static function isNext() : string
    {
        echo '-------------' . PHP_EOL;
        echo '"c":Continue, "q":Quit game' . PHP_EOL;
        echo '-------------' . PHP_EOL;
        $nextOperation =
            !View::$isTest ? trim(fgets(STDIN)) : View::$testInputOperationContinue;
        return $nextOperation;
    }

    /**
     * テストコード用のパラメータセット
     */
    public static function setTestParam(
        int $testInputBet,
        string $testInputOperationWelcome,
        string $testInputOperation,
        string $testInputOperationContinue
    ) : void {
    // /** ベット入力（テスト用） */
    // /** ゲームスタートの入力コマンド（テスト用） */
    // /** スタンド・ヒット入力（テスト用） */
    // /** ゲームを継続するかの入力コマンド（テスト用） */

    /**テストコード実行中であるか */
        View::$isTest = true;
        /**テストコード用プロパティー */
        View::$testInputBet = $testInputBet;
        View::$testInputOperationWelcome = $testInputOperationWelcome;
        View::$testInputOperation = $testInputOperation;
        View::$testInputOperationContinue = $testInputOperationContinue;
        return;
    }
}
