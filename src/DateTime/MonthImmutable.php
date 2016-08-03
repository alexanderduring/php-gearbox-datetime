<?php

namespace Gearbox\DateTime;

/**
 * Represents a specific month of a year, e.g. July 2016
 */
class MonthImmutable
{
    /** @var integer */
    private $month;

    /** @var integer */
    private $year;



    /**
     * @param string $monthString Optional description of the month in the format 'YYYY-MM'.
     * @throws Exception
     */
    public function __construct($monthString = null)
    {
        // If constructed without parameters it represents todays month
        if (is_null($monthString)) {
            $monthString = date('Y-m');
        }

        // Split string at '-' into $year and $month
        list($year, $month) = explode('-', $monthString);

        // Make sure that strings have correct length and contain only digits
        if (strlen($year) == 4 && ctype_digit($year) && strlen($month) == 2 && ctype_digit($month)) {
            $this->month = (int) $month;
            $this->year = (int) $year;
        } else {
            throw new Exception('Cannot construct instance of '.__CLASS__.' with parameter "'.$monthString.'".');
        }
    }
    
    
    
    /**
     * Returns true if the given month represents the same month as this one.
     * 
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function equals(MonthImmutable $monthToCompareWith)
    {
        $sameMonthInYear = $monthToCompareWith->getMonthAsNumber() == $this->getMonthAsNumber();
        $sameYear = $monthToCompareWith->getYearAsNumber() == $this->getYearAsNumber();
        $isEqual = $sameMonthInYear && $sameYear;

        return $isEqual;
    }
}
