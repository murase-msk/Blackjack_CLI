<?php
/**
 *
 */
namespace vendor;

use PHPUnit\Framework\TestCase;
use src\Man;
use src\Player;
use src\Dealer;
use src\GameUtil;
use src\View;
use src\Game;

/**
 * Undocumented class
 * @testdox Gameクラスのテスト
 */
class GameTest extends TestCase
{
    public function __constroct()
    {
        parent::__constroct();
    }

    /**
     * スタート処理のテスト(スタンド→終了)
     * @test
     * @testdox スタート処理のテスト(スタンド→終了)
     *
     * @return void
     */
    public function start() : void
    {
        $expectedOutputString = <<<"EOF"
$$$$$$$$$$$$$$$$$$$$$$$$$$
Welcome to Blackjack Game
input "s" to start game 
input "q" to quit game 
$$$$$$$$$$$$$$$$$$$$$$$$$$
Your cash: 100
Input Bet -------------
Dealer:heart:2, blank
Player:diamond:5, club:J (total 15)
-------------
-------------
s: Stand, h: Hit, e:Surrender
-------------
Input your next command: Stand 
-------------
Dealer: total 8 :heart:2, diamond:6
-------------
Hit 
-------------
Dealer: total 12 :heart:2, diamond:6, spade:4
-------------
Hit 
-------------
Dealer: total 20 :heart:2, diamond:6, spade:4, spade:8
-------------
Dealer:20 Plauer: 15
Dealer Win
-------------
"c":Continue, "q":Quit game
-------------

EOF;
        // 乱数固定.
        srand(5);

        // /** ベット入力（テスト用） */
        // /** ゲームスタートの入力コマンド（テスト用） */
        // /** スタンド・ヒット入力（テスト用） */
        // /** ゲームを継続するかの入力コマンド（テスト用） */
        View::setTestParam('10', 's', 's', 'q');
        $gameUtil = new GameUtil();
        $player = new Player();
        $dealer = new Dealer($gameUtil);
        $game = new Game($gameUtil, $player, $dealer);
        ob_start();
        $game->start();
        $stdout = ob_get_clean();
        $this->assertEquals($expectedOutputString, $stdout);
        return;
    }
    
    /**
     * スタート処理のテスト2(ヒット*2(バースト)→終了)
     * @test
     * @testdox スタート処理のテスト2(ヒット*2(バースト)→終了)
     *
     * @return void
     */
    public function start2() : void
    {
        $expectedOutputString = <<<"EOF"
$$$$$$$$$$$$$$$$$$$$$$$$$$
Welcome to Blackjack Game
input "s" to start game 
input "q" to quit game 
$$$$$$$$$$$$$$$$$$$$$$$$$$
Your cash: 100
Input Bet -------------
Dealer:heart:2, blank
Player:diamond:5, club:J (total 15)
-------------
-------------
s: Stand, h: Hit, e:Surrender
-------------
Input your next command: Hit 
-------------
Player: total 19 :diamond:5, club:J, spade:4
-------------
-------------
s: Stand, h: Hit, e:Surrender
-------------
Input your next command: Hit 
Your hand is burst
-------------
Player: total burst :diamond:5, club:J, spade:4, spade:8
-------------
-------------
"c":Continue, "q":Quit game
-------------

EOF;
        // 乱数固定.
        srand(5);

        // /** ベット入力（テスト用） */
        // /** ゲームスタートの入力コマンド（テスト用） */
        // /** スタンド・ヒット入力（テスト用） */
        // /** ゲームを継続するかの入力コマンド（テスト用） */
        View::setTestParam('10', 's', 'h', 'q');
        $gameUtil = new GameUtil();
        $player = new Player();
        $dealer = new Dealer($gameUtil);
        $game = new Game($gameUtil, $player, $dealer);
        ob_start();
        $game->start();
        $stdout = ob_get_clean();
        $this->assertEquals($expectedOutputString, $stdout);
        return;
    }
}
