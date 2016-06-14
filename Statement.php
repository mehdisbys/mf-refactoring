<?php


class Statement
{

    private $customer;

    private $rental;

    private $detailledStatement = [];

    private $totalPrice;

    private $totalPoints;

    /**
     * Statement constructor.
     * @param Customer $customer
     * @param array $rental
     */
    public function __construct(Customer $customer, array $rental)
    {
        $this->customer = $customer;
        $this->rental   = $rental;
    }

    public function processStatement()
    {
        /** @var array $rentals */
        $rentals                  = $this->customer->getRentals();
        $this->detailledStatement = [];
        $this->totalPrice         = 0;
        $this->totalPoints        = 0;

        /** @var Rental $item */
        foreach ($rentals as $item) {
            $daysRented                 = $item->getDaysRented();
            $price                      = $item->getMovie()->getTotalFinalPrice($daysRented);
            $points                     = $item->getMovie()->getTotalFinalPoints($daysRented);
            $this->detailledStatement[] = new StatementLine($price, $points, $item->getMovie()->getTitle());
            $this->addPriceAndPoints($price, $points);
        }
        return $this->detailledStatement;
    }

    private function addPriceAndPoints(float $price, float $points)
    {
        $this->totalPrice += $price;
        $this->totalPoints += $points;
    }

    public function printStatement(StatementPrinterInterface $printer)
    {
        $printer->init($this->customer->getName(), $this->detailledStatement, $this->totalPrice, $this->totalPoints);
        return $printer->statement();
    }

}