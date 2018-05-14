<?php
/**
 *
 */
namespace src;

/**
 * ゲーム中の各種機能
 */
class GameUtil
{
    /** @var array{
     *      @type array{
     *          'mark': string マーク
     *          'number': int 数字
     *          'isFaceUp': bool 表であるか
     *          }
     *      } 1デッキ内のカード*/
    const ONE_DECK = [
        ['mark' => 'club', 'number' => 1, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 2, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 3, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 4, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 5, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 6, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 7, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 8, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 9, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 10, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 11, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 12, 'isFaceUp' => false],
        ['mark' => 'club', 'number' => 13, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 1, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 2, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 3, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 4, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 5, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 6, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 7, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 8, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 9, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 10, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 11, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 12, 'isFaceUp' => false],
        ['mark' => 'diamond', 'number' => 13, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 1, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 2, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 3, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 4, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 5, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 6, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 7, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 8, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 9, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 10, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 11, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 12, 'isFaceUp' => false],
        ['mark' => 'heart', 'number' => 13, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 1, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 2, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 3, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 4, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 5, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 6, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 7, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 8, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 9, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 10, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 11, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 12, 'isFaceUp' => false],
        ['mark' => 'spade', 'number' => 13, 'isFaceUp' => false],
    ];

    /** @var string[] 山札*/
    public $stock = array();

    public function __construct()
    {
        $this->stock = array_merge($this->stock, self::ONE_DECK);
    }

    /**
     * カードを１枚取り出す
     *
     * @return array{
     *          'mark': string マーク
     *          'number': int 数字
     *          'isFaceUp': bool 表であるか
     *          }
     */
    public function pickOneCard() : array
    {
        $pickIndex = rand(0, count($this->stock));
        $pickCard = $this->stock[$pickIndex];
        array_splice($this->stock, $pickIndex, 1);
//        var_dump($pickCard);
        return $pickCard;
    }
}
