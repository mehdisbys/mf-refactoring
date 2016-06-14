<?php


class SimplePrinter implements StatementPrinterInterface
{
    /** @var string */
    private $customerName;

    /** @var  array StatementLine[] */
    private $statementLines;

    /** @var  float */
    private $totalPrice;

    /** @var  float */
    private $totalPoints;


    /**
     * @param string $customerName
     * @param array $statementLines
     * @param float $totalPrice
     * @param float $totalPoints
     */
    public function init(string $customerName, array $statementLines, float $totalPrice, float $totalPoints)
    {
        $this->customerName   = $customerName;
        $this->statementLines = $statementLines;
        $this->totalPrice     = $totalPrice;
        $this->totalPoints    = $totalPoints;
    }

    public function header()
    {
        return "Rental Record for " . $this->customerName . "\n";
    }

    public function body()
    {
        $body = '';
        foreach ($this->statementLines as $item) {
            $body .= "\t" . $item->getTitle() . "\t" . (string)$item->getMovieTotalPrice() . "\n";
        }

        return $body;
    }

    public function footer()
    {
        $footer = "Amount owed is " . (string)$this->totalPrice . "\n";
        $footer .= "You earned " . (string)$this->totalPoints . " frequent renter points";
        return $footer;
    }

    public function statement()
    {
        return implode(PHP_EOL, [$this->body(), $this->header(), $this->footer()]);
    }

}