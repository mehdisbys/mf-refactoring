<?php



class StatementLine
{

    private $movieTotalPrice;
    private $movieTotalPoints;
    private $movieTitle;

    /**
     * StatementLine constructor.
     * @param $movieTotalPrice
     * @param $movieTotalPoints
     * @param $movieTitle
     */
    public function __construct(int $movieTotalPrice, int $movieTotalPoints, string $movieTitle)
    {
        $this->movieTotalPrice  = $movieTotalPrice;
        $this->movieTotalPoints = $movieTotalPoints;
        $this->movieTitle       = $movieTitle;
    }

    /**
     * @return int
     */
    public function getMovieTotalPrice()
    {
        return $this->movieTotalPrice;
    }

    /**
     * @return int
     */
    public function getMovieTotalPoints()
    {
        return $this->movieTotalPoints;
    }

    /**
     * @return string
     */
    public function getMovieTitle()
    {
        return $this->movieTitle;
    }
}