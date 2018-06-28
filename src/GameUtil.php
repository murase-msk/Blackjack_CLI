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
    const CLUB = 'club';
    const DIAMOND = 'diamond';
    const HEART = 'heart';
    const SPADE = 'spade';
    const ACE = 1;
    const TWO = 2;
    const THREE = 3;
    const FOUR = 4;
    const FIVE = 5;
    const SIX = 6;
    const SEVEN = 7;
    const EIGHT = 8;
    const NINE = 9;
    const TEN = 10;
    const JACK = 11;
    const QUEEN = 12;
    const KING = 13;
    /** @var array{
     *      @type array{
     *          'mark': string マーク
     *          'number': int 数字
     *          'isFaceUp': bool 表であるか
     *          }
     *      } 1デッキ内のカード*/
    const ONE_DECK = [
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::ACE, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::TWO, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::THREE, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::FOUR, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::FIVE, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::SIX, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::SEVEN, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::EIGHT, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::NINE, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::TEN, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::JACK, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::QUEEN, 'isFaceUp' => false],
        ['mark' => GameUtil::CLUB, 'number' => GameUtil::KING, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::ACE, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::TWO, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::THREE, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::FOUR, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::FIVE, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::SIX, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::SEVEN, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::EIGHT, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::NINE, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::TEN, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::JACK, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::QUEEN, 'isFaceUp' => false],
        ['mark' => GameUtil::DIAMOND, 'number' => GameUtil::KING, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::ACE, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::TWO, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::THREE, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::FOUR, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::FIVE, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::SIX, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::SEVEN, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::EIGHT, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::NINE, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::TEN, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::JACK, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::QUEEN, 'isFaceUp' => false],
        ['mark' => GameUtil::HEART, 'number' => GameUtil::KING, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::ACE, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::TWO, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::THREE, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::FOUR, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::FIVE, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::SIX, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::SEVEN, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::EIGHT, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::NINE, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::TEN, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::JACK, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::QUEEN, 'isFaceUp' => false],
        ['mark' => GameUtil::SPADE, 'number' => GameUtil::KING, 'isFaceUp' => false],
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
        $pickIndex = rand(0, count($this->stock) - 1);
        $pickCard = $this->stock[$pickIndex];
        array_splice($this->stock, $pickIndex, 1);
//        var_dump($pickCard);
        return $pickCard;
    }

    /**
     * プレイヤー側が勝利したか
     *
     * @param integer $playerValue
     * @param integer $dealerValue
     * @return string dealer:ディーラー勝利, player:プレイヤー勝利, draw:引き分け
     */
    public function whoIsWin(int $dealerValue, int $playerValue) : string
    {
        if ($dealerValue > $playerValue) {
            return 'dealer';
        } elseif ($dealerValue < $playerValue) {
            return 'player';
        } else {
            return 'draw';
        }
    }
}
