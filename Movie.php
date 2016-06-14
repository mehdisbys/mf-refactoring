<?php

class Movie
{
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    const CHILDRENS = 2;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $priceCode;

    /**
     * Movie constructor.
     * @param string $title
     * @param int $priceCode
     */
    public function __construct($title, $priceCode)
    {
        $this->title     = $title;
        $this->priceCode = $priceCode;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPriceCode()
    {
        return $this->priceCode;
    }

    /**
     * @param int $priceCode
     */
    public function setPriceCode($priceCode)
    {
        $this->priceCode = $priceCode;
    }

    public function getBasePrice()
    {

        $price = [
            self::REGULAR     => ['base' => 2, 'additional' => ['days' => 2, 'supplement' => 1.5]],
            self::NEW_RELEASE => ['base' => 3, 'additional' => ['days' => 0, 'supplement' => 0]],
            self::CHILDRENS   => ['base' => 1.5, 'additional' => ['days' => 3, 'supplement' => 1.5]],
        ];

        return $price[$this->priceCode];
    }

    public function getPrice()
    {
        return $this->getBasePrice()['base'];
    }

    public function getPaidDays()
    {
        return $this->getBasePrice()['base']['additional']['days'];
    }

    public function getSupplementPerDay()
    {
        return $this->getBasePrice()['base']['additional']['supplement'];
    }

    public function getBasePoints()
    {
        $points = [
            self::REGULAR     => ['base' => 1, 'additional' => ['days' => 0, 'supplement' => 0]],
            self::NEW_RELEASE => ['base' => 1, 'additional' => ['days' => 1, 'supplement' => 1]],
            self::CHILDRENS   => ['base' => 1, 'additional' => ['days' => 0, 'supplement' => 0]],
        ];

        return $points[$this->priceCode];
    }

    public function getPoints()
    {
        return $this->getBasePoints()['base'];
    }

    public function getPointsDays()
    {
        return $this->getBasePoints()['additional']['days'];
    }

    public function getPointsSupplement()
    {
        return $this->getBasePoints()['additional']['supplement'];
    }

    public function getOverdueSupplement(int $daysRented)
    {
        if ($daysRented > $this->getPaidDays()) {
            return ($daysRented - $this->getPaidDays()) * $this->getSupplementPerDay();
        }
        return 0;
    }

    public function getOverduePoints(int $daysRented)
    {
        if ($daysRented > $this->getPointsDays()) {
            return ($daysRented - $this->getPointsSupplement()) * $this->getPointsSupplement();
        }

        return 0;
    }

    public function getTotalFinalPrice(int $daysRented)
    {
        return $this->getPrice() + $this->getOverdueSupplement($daysRented);
    }

    public function getTotalFinalPoints(int $daysRented)
    {
        return $this->getPoints() + $this->getOverduePoints($daysRented);
    }

}