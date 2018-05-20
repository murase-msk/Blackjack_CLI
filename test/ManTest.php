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
class ManTest extends TestCase
{
    public function __constroct()
    {
        parent::__constroct();
    }

    /**
     *
     */
    // public function setUp()
    // {
    //     $this->man = new Man();
    //     $this->assertEquals(10, 10);
    // }

    /**
     * ヒットテスト
     *
     * @test
     */
    public function hit()
    {
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::DIAMOND, 'number' => GameUtil::NINE, 'isFaceUp' => false], true);
        $this->assertEquals(
            true,
            $man->hit(['mark' => GameUtil::CLUB, 'number' => GameUtil::ACE, 'isFaceUp' => false], true)
        );
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::DIAMOND, 'number' => GameUtil::NINE, 'isFaceUp' => false], true);
        $this->assertEquals(
            false,
            $man->hit(['mark' => GameUtil::CLUB, 'number' => GameUtil::NINE, 'isFaceUp' => false], true)
        );
    }

    /**
     * カード受け取りテスト
     *
     * @test
     */
    public function receiveOneCard()
    {
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => 1, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::DIAMOND, 'number' => 2, 'isFaceUp' => false], true);
        $this->assertEquals(
            ['mark' => GameUtil::CLUB, 'number' => 1, 'isFaceUp' => true],
            $man->hand[0]
        );
        $this->assertEquals(
            ['mark' => GameUtil::DIAMOND, 'number' => 2, 'isFaceUp' => true],
            $man->hand[1]
        );
    }

    /**
     * カード評価テスト
     *
     * @test
     */
    public function evaluateHand()
    {
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::TWO, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::ACE, 'isFaceUp' => false], true);
        $this->assertEquals(13, $man->evaluateHand());
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::ACE, 'isFaceUp' => false], true);
        $this->assertEquals(21, $man->evaluateHand());
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::KING, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::ACE, 'isFaceUp' => false], true);
        $this->assertEquals(21, $man->evaluateHand());
        $man = new Man();
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::KING, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false], true);
        $man->receiveOneCard(['mark' => GameUtil::CLUB, 'number' => GameUtil::SEVEN, 'isFaceUp' => false], true);
        $this->assertEquals(-1, $man->evaluateHand());
    }
}
