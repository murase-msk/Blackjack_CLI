<?php
/**
 *
 */
namespace vendor;

use PHPUnit\Framework\TestCase;
use src\Man;
use src\GameUtil;

/**
 * Undocumented class
 */
class GameUtilTest extends TestCase
{
    public function __constroct()
    {
        parent::__constroct();
    }

    /**
     * カードを一枚引く
     *
     * @test
     * @return void
     */
    public function pickOneCard() : void
    {
        $gameUtil = new GameUtil();
        // ハートの２となる乱数(乱数固定).
        srand(5);
        $pickedCard = $gameUtil->pickOneCard();
//        var_dump($pickedCard);
        // ハートの２を取り出す
        $this->assertEquals(
            ['mark' => GameUtil::HEART, 'number' => GameUtil::TWO, 'isFaceUp' => false],
            $pickedCard
        );
        // デッキから取り出せているか確認.
        $this->assertFalse(
            in_array(
                ['mark' => GameUtil::HEART, 'number' => GameUtil::TWO, 'isFaceUp' => false],
                $gameUtil->stock
            )
        );
        return;
    }

    /**
     * プレーヤーが買ったか
     *
     * @test
     * @return void
     */
    public function isPlayerWin() : void
    {
        $gameUtil = new GameUtil();
        $this->assertEquals(-1, $gameUtil->isPlayerWin(1, -1));
        $this->assertEquals(1, $gameUtil->isPlayerWin(1, 23));
        $this->assertEquals(0, $gameUtil->isPlayerWin(23, 23));
        return;
    }
}
