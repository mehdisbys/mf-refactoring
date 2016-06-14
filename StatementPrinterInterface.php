<?php


interface StatementPrinterInterface
{

    public function init(string $customerName, array $statementLines, float $totalPrice, float $totalPoints);

    public function header();

    public function body();

    public function footer();

    public function statement();

}