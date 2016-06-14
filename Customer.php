<?php

class Customer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array Rental[]
     */
    private $rentals;

    /**
     * Customer constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    public function getRentals()
    {
        return $this->rentals;
    }

}