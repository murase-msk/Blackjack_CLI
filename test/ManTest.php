<?php
/**
 *
 */
namespace vendor;

use PHPUnit\Framework\TestCase;
use src\Man;

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
     * カード受け取りテスト
     *
     * @test
     */
    public function receiveOneCard()
    {
        $man = new Man();
        $man->receiveOneCard(
            ['mark' => 'club', 'number' => 1, 'isFaceUp' => false],
            true
        );
        $man->receiveOneCard(
            ['mark' => 'diamond', 'number' => 2, 'isFaceUp' => false],
            true
        );
        $this->assertEquals(
            ['mark' => 'club', 'number' => 1, 'isFaceUp' => true],
            $man->hand[0]
        );
        $this->assertEquals(
            ['mark' => 'diamond', 'number' => 2, 'isFaceUp' => true],
            $man->hand[1]
        );
    }
}
